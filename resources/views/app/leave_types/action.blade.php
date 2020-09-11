<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item"
           href="{{ route('leave-types.edit', ['leave_type' => $leaveType->id]) }}">
            <i class="fa fa-edit"></i>
            Edit
        </a>
        <a data-action="delete" data-form="#form{{$leaveType->id}}" class="dropdown-item" href="#">
            <i class="fa fa-trash"></i>
            Delete
        </a>
        <form action="{{ route('leave-types.destroy',['leave_type' => $leaveType->id]) }}" method="post"
              id="form{{$leaveType->id}}">
            @csrf()
            @method('DELETE')
        </form>
    </div>
</div>
