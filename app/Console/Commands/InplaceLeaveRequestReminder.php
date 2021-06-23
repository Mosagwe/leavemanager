<?php

namespace App\Console\Commands;

use App\Models\LeaveRequest;
use App\Notifications\InplaceRequestDeadline;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class InplaceLeaveRequestReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inplace:deadline_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind Inplace staff to accept or decline Leave Request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Reminder started'.Carbon::now());

        $leaveRequests = LeaveRequest::whereDate('created_at','<',Carbon::now()->subDays(7))
                        ->where('status','=',0)
                        ->where('is_archived','=',0)
                        ->get();

        foreach ($leaveRequests as $leaveRequest) {
            Notification::send($leaveRequest->employeeInplace, new InplaceRequestDeadline($leaveRequest));
        }
        $this->info('Process successful at '.Carbon::now());
    }
}
