<?php

namespace App\Rules;

use App\Models\SlotGameUser;
use Illuminate\Contracts\Validation\Rule;

class RegisterUnique implements Rule
{
    protected $attributes = null;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $query = SlotGameUser::query();
        if (!empty($this->attributes)) {
            $tmp = 0;
            foreach ($this->attributes as $column => $attribute) {
                if (empty($tmp)) {
                    $query->where($column, $attribute);
                } else {
                    $query->orwhere($column, $attribute);
                }
                $tmp = $tmp + 1;
            }
        }
        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('admin.validation.register_unique');
    }
}
