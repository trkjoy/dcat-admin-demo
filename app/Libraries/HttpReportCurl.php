<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

/**
 * 數據上報發送http 請求
 */
class HttpReportCurl implements IHttpCurl
{
    private $alias;
    private $secret;
    private $host;
    private $timestamp;
    private $data = null;
    private $error = null;
    private $token = null;

    public function __construct(){
        $config = config('services.report');
        $this->alias = $config['alias']??null;
        $this->secret = $config['secret']??null;
        $this->host = $config['host']??null;
    }
    //重置
    private function clear(){
        $this->timestamp = null;
        $this->data = null;
        $this->error = null;
        $this->token = null;
    }

    public function verify(array $data): bool
    {
        if ($this->alias == null){
            $this->error = trans('admin.report_alias_empty');
            return false;
        }
        if ($this->secret == null){
            $this->error = trans('admin.report_secret_empty');
            return false;
        }
        if ($this->host == null){
            $this->error = trans('admin.report_host_empty');
            return false;
        }
        if ($data == null){
            $this->error = trans('admin.report_data_empty');
            return false;
        }
        $this->data = $data;
        return true;
    }

    public function sign(): bool
    {
        $this->timestamp = time();
//        $data = json_encode($this->data, JSON_UNESCAPED_UNICODE);
        $data = json_encode($this->data);
        $sign = md5(sprintf("%s_%s_%s_%s", $this->alias, $this->timestamp, $data, $this->secret));
        $this->token = base64_encode(sprintf("%s_%s_%s", $this->alias, $this->timestamp, $sign));
        return true;
    }

    public function submit(array $data): array
    {
        //验证数据
        $this->verify($data);
        //签名
        $this->sign();
        //记录错误信息
        $error = $this->error;
        if (!empty($this->error)){
            Log::error(__METHOD__.":submit:error",[]);
            return ['code'=>-201,'msg'=>$error];
        }
        if ($this->report()){
            $this->clear();
            return ['code'=>200,'msg'=>'ok'];
        }else{
            $this->clear();
            return ['code'=>-202,'msg'=>$error];
        }
    }

    private function report(): bool
    {
        $options = [
            'timeout' => 10,
            'json' => ($this->data),
            'headers' => [
                'Content-Type' => 'application/json',
                'Connection' => 'close',
                'Authorization' => $this->token,
            ]
        ];
        try{
            $result = (new Client())->request("POST", $this->host,$options);
            $contents = $result->getBody()->getContents();
            if ($result->getStatusCode() == 200){
                Log::info(__METHOD__.":submit:success",[$contents,$this->host,$this->alias,$this->data]);
                return true;
            }else{
                Log::info(__METHOD__.":submit:fail",[$contents,$this->host,$this->alias,$this->data]);
                return false;
            }
        } catch (GuzzleException $e) {
            Log::info(__METHOD__.":submit:exception",[
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ]);
        }
        return false;
    }
}
