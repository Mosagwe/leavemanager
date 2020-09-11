<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item"
           href="{{ route('employment-types.edit', ['employment_type' => $employmentType->id]) }}">
            <i class="fa fa-edit"></i>
            Edit
        </a>
        <a data-action="delete" data-form="#form{{$employmentType->id}}" class="dropdown-item" href="#">
            <i class="fa fa-trash"></i>
            Delete
        </a>
        <form action="{{ route('employment-types.destroy',['employment_type' => $employmentType->id]) }}" method="post"
              id="form{{$employmentType->id}}">
            @csrf()
            @method('DELETE')
        </form>
    </div>
</div>
