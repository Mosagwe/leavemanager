<?php

namespace App\Http\Controllers;

use App\DataTables\LeaveBalanceReportDataTable;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function leaveBalances()
    {

        $leaveRequests=DB::select("select u.name empname,lt.name leaveType,lb.balance, sum(number_of_days) total from leave_requests lr
                        join users u on lr.user_id=u.id
                        join leave_types lt on lt.id=lr.leave_type_id
                        join leave_balances lb on u.id=lb.user_id
                        where status=7
                        group by lr.user_id, u.name,lt.name,lb.balance");

        return view('app.reports.approvedleaves',compact('leaveRequests'));
    }
}