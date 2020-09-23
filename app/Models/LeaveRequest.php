<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

class LeaveRequest extends BaseModel
{
    const PENDING_INPLACE = 0;

    const PENDING_RECOMMENDATION = 1;

    const PENDING_APPROVAL = 2;

    const WITHDRAWN = 3;

    const DECLINED = 4;

    const INPLACE_DECLINED = 5;

    const RECALLED = 6;

    const APPROVED = 7;

    protected $dates = [
        'start_at',
        'end_at'
    ];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function employeInplace()
    {
        return $this->belongsTo(User::class, 'employee_inplace')->withDefault();
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class)->withDefault();
    }

    public static function activeRequests()
    {
        return self::where(function ($query) {
            $query->whereUserId(Auth::user()->id)->orWhere('employee_inplace', Auth::user()->id);
        })->where('status', '<>', self::WITHDRAWN)
            ->where('status', '<>', self::DECLINED)
            ->where('status', '<>', self::RECALLED)
            ->where('status', '<>', self::INPLACE_DECLINED)
            ->where(function ($query) {
                $query->whereDate('start_at', '>', today()->format('Y-m-d'))
                    ->orWhereDate('end_at', '>', today()->format('Y-m-d'));
            });
    }

    public function scopePending($query){
        return $query->where('status',self::PENDING_RECOMMENDATION);
    }
    public function scopePendinginplace($query){
        return $query->where('status',self::PENDING_INPLACE);
    }
}
