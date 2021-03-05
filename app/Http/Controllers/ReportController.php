<?php

namespace App\Http\Controllers;

use App\DataTables\LeaveBalanceReportDataTable;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function leaveBalances()
    {
       /* $leaveRequests= DB::table('leave_requests')
            ->join('users', 'leave_requests.user_id', '=', 'users.id')
            ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
            ->join('leave_balances', 'leave_balances.leave_type_id', '=', 'leave_types.id')
            ->where('leave_requests.status','=','7')
            ->where('leave_requests.leave_type_id','=','1')
            //->where('users.id','=','leave_balances.user_id')
            ->select('users.name','leave_balances.balance',DB::raw('SUM(number_of_days) as total') )
            ->groupBy('leave_requests.user_id','users.name','leave_balances.balance')
            ->get();
        return $leaveRequests;*/

      $leaveRequests=DB::select("select u.name empname,lt.name leaveType,lb.balance, sum(number_of_days) total from leave_requests lr
                        join users u on lr.user_id=u.id
                        join leave_types lt on lt.id=lr.leave_type_id
                        join leave_balances lb on u.id=lb.user_id and lb.leave_type_id=lr.leave_type_id
                        where status=7 and lr.leave_type_id=1
                        group by lr.user_id, u.name,lt.name,lb.balance");

        return view('app.reports.approvedleaves',compact('leaveRequests'));
    }
}
