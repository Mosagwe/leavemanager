@if($leaveRequest->status == \App\Models\LeaveRequest::PENDING_INPLACE)
    <span class="badge badge-warning">Pending Inplace</span>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::PENDING_RECOMMENDATION)
    <span class="badge badge-warning">Pending Recommendation</span>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::INPLACE_DECLINED)
    <span class="badge badge-danger">Inplace Declined</span>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::PENDING_APPROVAL)
    <label class="badge badge-warning">Pending Approval</label>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::DECLINED)
    <label class="badge badge-danger">Declined</label>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::RECALLED)
    <label class="badge badge-info">Recalled</label>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::WITHDRAWN)
    <label class="badge badge-danger">Withdrawn</label>
@elseif($leaveRequest->status == \App\Models\LeaveRequest::APPROVED)
    <label class="badge badge-success">Approved</label>
@endif
