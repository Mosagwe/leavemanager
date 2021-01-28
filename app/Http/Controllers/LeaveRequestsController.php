<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use App\Models\LeaveRequest;
use App\DataTables\ApprovedLeaveRequestsDataTable;
use App\DataTables\RecommendedLeaveRequestsDataTable;
use App\DataTables\PendingLeaveRequestsDataTable;
use App\Notifications\LeaveRequestApprovalNotification;
use App\Notifications\LeaveRequestApprovedNotification;
use App\Notifications\LeaveRequestDeclinedNotification;
use App\Notifications\LeaveRequestRecommendedNotification;
use App\Notifications\HrLeaveApprovalNotification;
use App\Notifications\SupervisorLeaveApprovedNotification;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LeaveRequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pending(PendingLeaveRequestsDataTable $dataTable)
    {
        return $dataTable->render('app.leave.requests.pending');
    }

    public function recommended(RecommendedLeaveRequestsDataTable $dataTable)
    {
        return $dataTable->render('app.leave.requests.recommended');
    }

    public function approved(ApprovedLeaveRequestsDataTable $dataTable)
    {
        return $dataTable->render('app.leave.requests.approved');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['action' => 'required']);

        $leaveRequest = LeaveRequest::findOrFail($id);

        if ($request->action == 'RECOMMEND') {
            $leaveRequest->update([
                'status' => LeaveRequest::PENDING_APPROVAL,
                'recommended_by' => \Auth::user()->id,
            ]);

            Notification::send($leaveRequest->applicant, new LeaveRequestRecommendedNotification($leaveRequest));
            Notification::send(User::approvers(), new LeaveRequestApprovalNotification($leaveRequest));
        }

        if ($request->action == 'APPROVE') {
            $leaveBalance = $leaveRequest->applicant->leaveTypeBalance($leaveRequest->leave_type_id);
            $leaveBalance->update([
                'balance' => $leaveBalance->balance - $leaveRequest->number_of_days
            ]);

            $leaveRequest->update([
                'status' => LeaveRequest::APPROVED,
                'approved_by' => \Auth::user()->id,
            ]);

            Notification::send($leaveRequest->applicant, new LeaveRequestApprovedNotification($leaveRequest));
            Notification::send($leaveRequest->applicant->supervisors($leaveRequest->applicant->department_id), new SupervisorLeaveApprovedNotification($leaveRequest));
            Notification::send(User::hr(), new HrLeaveApprovalNotification($leaveRequest));

            Alert::success('Success', 'record processed successfully');

            return redirect(route('leave-requests.recommended'));

        }


        Alert::success('Success', 'record processed successfully');

        return redirect(route('leave-requests.pending'));
    }

    public function recommendAll(Request $request)
    {
        $leaveRequests=LeaveRequest::find($request->ids);

        foreach($leaveRequests as $leaveRequest)
        {
            $leaveRequest->update([
                'status' => LeaveRequest::PENDING_APPROVAL,
                'recommended_by' => \Auth::user()->id,
            ]);

            Notification::send($leaveRequest->applicant, new LeaveRequestRecommendedNotification($leaveRequest));
            Notification::send(User::approvers(), new LeaveRequestApprovalNotification($leaveRequest));
        }

        return new JsonResponse([
            'success' => true,
            'number' => $leaveRequests->count()
        ]);
    }

    public function approveAll(Request $request)
    {
        $leaveRequests=LeaveRequest::find($request->ids);
        foreach ($leaveRequests as $leaveRequest)
        {
            $leaveBalance = $leaveRequest->applicant->leaveTypeBalance($leaveRequest->leave_type_id);
            $leaveBalance->update([
                'balance' => $leaveBalance->balance - $leaveRequest->number_of_days
            ]);

            $leaveRequest->update([
                'status' => LeaveRequest::APPROVED,
                'approved_by' => \Auth::user()->id,
            ]);

            Notification::send($leaveRequest->applicant, new LeaveRequestApprovedNotification($leaveRequest));
            Notification::send($leaveRequest->applicant->supervisors($leaveRequest->applicant->department_id), new SupervisorLeaveApprovedNotification($leaveRequest));
            Notification::send(User::hr(), new HrLeaveApprovalNotification($leaveRequest));
        }

        return new JsonResponse([
            'success' => true,
            'number' => $leaveRequests->count()
        ]);

    }

    public function destroy(Request $request)
    {

        $leaveRequest = LeaveRequest::findOrFail($request->leaveRequest);


        $leaveRequest->update([
            'status' => LeaveRequest::DECLINED,
            'recommended_by' => \Auth::user()->id,
            'decline_reason'=>$request->reason
        ]);

        Notification::send($leaveRequest->applicant, new LeaveRequestDeclinedNotification($leaveRequest, $request->reason));


        Alert::success('Success', 'Record processed successfully');

        return redirect(route('leave-requests.pending'));
    }
}
