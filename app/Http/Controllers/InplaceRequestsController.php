<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Notifications\InplaceRequestAcceptedNotification;
use App\Notifications\InplaceRequestDeclinedNotification;
use App\Notifications\LeaveRequestApprovalNotification;
use App\Notifications\LeaveRequestRecommendationNotification;
use Illuminate\Http\Request;
use App\DataTables\InplaceRequestsDataTable as InplaceRequests;
use Illuminate\Support\Facades\Notification;
use Auth;

class InplaceRequestsController extends Controller
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

    public function index(InplaceRequests $dataTable)
    {
        return $dataTable->render('app.leave.inplace.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['choice' => 'required']);

        $leaveRequest = LeaveRequest::findOrFail($id);


        if ($request->choice == 'ACCEPT') {

            return $this->changeLeaveRequestStatus($leaveRequest);
        }

        $leaveRequest->update([
            'status' => LeaveRequest::INPLACE_DECLINED
        ]);

        Notification::send($leaveRequest->applicant, new InplaceRequestDeclinedNotification($leaveRequest));


        Alert::success('Success', 'Record updated successfully');
        

        return redirect(route('inplace.index'));
    }

    private function changeLeaveRequestStatus(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->applicant->isSupervisor() || $leaveRequest->applicant->departmentHasApprover()) {
            $leaveRequest->update([
                'status' => LeaveRequest::PENDING_APPROVAL
            ]);
           

            Notification::send($leaveRequest->applicant, new InplaceRequestAcceptedNotification($leaveRequest));

            Notification::send(User::approvers(), new LeaveRequestApprovalNotification($leaveRequest));

            Alert::success('Success', 'Record updated successfully');

            return redirect(route('inplace.index'));
        }

        $leaveRequest->update([
            'status' => LeaveRequest::PENDING_RECOMMENDATION
        ]);

        Notification::send($leaveRequest->applicant, new InplaceRequestAcceptedNotification($leaveRequest));

        Notification::send(User::supervisors(), new LeaveRequestRecommendationNotification($leaveRequest));

        Alert::success('Success', 'Record updated successfully');

        return redirect(route('inplace.index'));
    }
}
