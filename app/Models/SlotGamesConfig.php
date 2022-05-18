<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SlotGamesConfig
 *
 * @property int $id
 * @property int $gid 游戏id
 * @property string $gname 游戏名称
 * @property int $sort 排序id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereGname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlotGamesConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SlotGamesConfig extends Model
{
	
    protected $table = 'slot_games_config';
    
}
