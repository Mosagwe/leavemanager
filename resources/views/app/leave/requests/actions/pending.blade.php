<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        @if($leaveRequest->status == \App\Models\LeaveRequest::PENDING_RECOMMENDATION)
            @can('recommend', \App\Models\LeaveRequest::class)
                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                    document.getElementById('recommendForm{{$leaveRequest->id}}').submit();">
                    <i class="fa fa-check-circle"></i>
                    Recommend
                </a>
                <form action="{{ route('leave-requests.update',['id' => $leaveRequest->id]) }}" method="post"
                      id="recommendForm{{$leaveRequest->id}}">
                    <input type="hidden" name="action" value="RECOMMEND">
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
