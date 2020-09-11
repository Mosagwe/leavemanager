@if($leaveRequest->status != \App\Models\LeaveRequest::WITHDRAWN && $leaveRequest->status != \App\Models\LeaveRequest::APPROVED)
    <div class="dropdown">
        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Action
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item"
               href="{{ route('applications.edit', ['application' => $leaveRequest->id]) }}">
                <i class="fa fa-edit"></i>
                Edit
            </a>
            <a data-action="withdraw" data-form="#form{{$leaveRequest->id}}" class="dropdown-item" href="#">
                <i class="fa fa-trash"></i>
                Withdraw
            </a>
            <form action="{{ route('applications.destroy',['application' => $leaveRequest->id]) }}" method="post"
                  id="form{{$leaveRequest->id}}">
                @csrf()
                @method('DELETE')
            </form>
        </div>
    </div>
@endif
