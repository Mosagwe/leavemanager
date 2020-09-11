<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" onclick="event.preventDefault();
            document.getElementById('acceptForm{{$leaveRequest->id}}').submit();">
            <i class="fa fa-check-circle"></i>
            Accept
        </a>
        <form action="{{ route('inplace.update',['inplace' => $leaveRequest->id]) }}" method="post"
              id="acceptForm{{$leaveRequest->id}}">
            <input type="hidden" name="choice" value="ACCEPT">
            @csrf()
            @method('PUT')
        </form>
        <a class="dropdown-item" href="#" onclick="event.preventDefault();
            document.getElementById('declineForm{{$leaveRequest->id}}').submit();">
            <i class="fa fa-trash"></i>
            Decline
        </a>
        <form action="{{ route('inplace.update',['inplace' => $leaveRequest->id]) }}" method="post"
              id="declineForm{{$leaveRequest->id}}">
            <input type="hidden" name="choice" value="DECLINE">
            @csrf()
            @method('PUT')
        </form>
    </div>
</div>
