<?php

namespace App\Rules\PheDuyet;

use Illuminate\Contracts\Validation\Rule;

class CheckRoleUserPheDuyetRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
        // return auth()->user()->email === 'pheduyet@fpt.edu.vn';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tài khoản của bạn không có quyền phê duyệt!';
    }
}
