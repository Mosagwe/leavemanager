<?php

namespace App\Providers;

use App\Events\EmployeeCreated;
use App\Events\EmployeeUpdated;
use App\Events\LeaveTypeCreated;
use App\Events\LeaveTypeUpdated;
use App\Listeners\UpdateEmployeeLeaveTypes;
use App\Listeners\UpdateEmployeesLeaveTypes;
use App\Listeners\AttachCreatedEmployeeToLeaveTypes;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmployeeCreated::class => [
            AttachCreatedEmployeeToLeaveTypes::class
        ],
        EmployeeUpdated::class => [
            UpdateEmployeeLeaveTypes::class
        ],
        LeaveTypeCreated::class => [
            UpdateEmployeesLeaveTypes::class
        ],
        LeaveTypeUpdated::class => [
            UpdateEmployeesLeaveTypes::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
