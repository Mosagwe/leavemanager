<?php

namespace App\Console\Commands;

use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ForfeitLeaveDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leavedays:forfeit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forfeit leave days when rolling over the year';

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
        $leavebalances = LeaveBalance::all();
        $leave_requests = LeaveRequest::where('is_archived', '=', 0)->get();
        $count = 0;

        foreach ($leavebalances as $leavebalance) {
            if (isset($leavebalance->employee)) {
                if (!$leavebalance->employee->is_active) {
                    continue;
                }
            }

            if (isset($leavebalance->leaveType)) {
                if ($leavebalance->balance > 0 && $leavebalance->leaveType->name == 'Annual Leave') {
                    DB::table('forfeited_leavedays')->insert([
                        'user_id' => $leavebalance->user_id,
                        'no_of_days' => $leavebalance->balance,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                $leavebalance->balance = ($leavebalance->leaveType->maximum_days == -1) ? -1 : $leavebalance->leaveType->maximum_days;
                $leavebalance->save();
                $count++;
            }
        }

        //change archive status of leave requests
        foreach ($leave_requests as $leave_request) {
            $leave_request->is_archived = 1;
            $leave_request->save();
        }

        $this->info($count . ' leave balances were updated');

    }
}
