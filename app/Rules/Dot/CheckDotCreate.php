<?php

namespace App\Rules\Dot;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\DotRepositoryInterface;
use Carbon\Carbon;

class CheckDotCreate implements Rule
{
    protected $message;
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
        $dotRepo = app()->make(DotRepositoryInterface::class);
        $time_start = request()->get('time_start');
        $time_end = request()->get('time_end');
        $dateNow = Carbon::now();
        $date_start = new Carbon($time_start);
        $date_end = new Carbon($time_end);
   
        if( $dateNow > $date_start){
            $this->message = 'Không nhập thời gian quá khứ';
            return false;
        }

        $nam_batdau=explode('-',$time_start);
        $nam_start=end($nam_batdau);

        $nam_ketthuc=explode('-',$time_end);
        $nam_end=end($nam_ketthuc);

        if($nam_start != $nam_end){
            $this->message = 'Chỉ nhập cùng năm';
            return false;
        }

        $checkTimeExist = $dotRepo->getAll();
        foreach($checkTimeExist as $dot){
            $dot_start_have = new Carbon($dot->time_start);
            $dot_end_have = new Carbon($dot->time_end);
            if( $date_start > $dot_start_have){
                if($date_start < $dot_end_have){
                    $this->message = 'Có khoảng thời gian đã đăng kí';
                    return false;
                }
            }else if($date_start < $dot_start_have){
                if($date_end > $dot_start_have){
                    $this->message = 'Có khoảng thời gian đã đăng kí';
                    return false;
                }
            }
        }
            
    
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
