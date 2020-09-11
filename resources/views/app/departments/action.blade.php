<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item"
           href="{{ route('departments.edit', ['department' => $department->id]) }}">
            <i class="fa fa-edit"></i>
            Edit
        </a>
        <a data-action="delete" data-form="#form{{$department->id}}" class="dropdown-item" href="#">
            <i class="fa fa-trash"></i>
            Delete
        </a>
        <form action="{{ route('departments.destroy',['department' => $department->id]) }}" method="post"
              id="form{{$department->id}}">
            @csrf()
            @method('DELETE')
        </form>
    </div>
</div>
