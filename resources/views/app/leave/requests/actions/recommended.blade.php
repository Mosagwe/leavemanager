<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        @if($leaveRequest->status == \App\Models\LeaveRequest::PENDING_APPROVAL)
            @can('approve', \App\Models\LeaveRequest::class)
                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                    document.getElementById('approveForm{{$leaveRequest->id}}').submit();">
                    <i class="fa fa-check-circle"></i>
                    Approve
                </a>
                <form action="{{ route('leave-requests.update',['id' => $leaveRequest->id]) }}" method="post"
                      id="approveForm{{$leaveRequest->id}}">
                    <input type="hidden" name="action" value="APPROVE">
                    @csrf()
                    @method('PUT')
                </form>
            @endcan
        @endif
        @if(Auth::user()->can('recommend', \App\Models\LeaveRequest::class) ||
                Auth::user()->can('approve', \App\Models\LeaveRequest::class))
            <a data-toggle="modal" data-target="#declineModal" data-id="{{ $leaveRequest->id }}" class="dropdown-item"
               href="#">
                <i class="fa fa-trash"></i>
                Decline
            </a>
        @endcan
    </div>
</div>
