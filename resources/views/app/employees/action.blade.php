<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        @can('update', \App\Models\User::class)
            <a class="dropdown-item"
               href="{{ route('employees.edit', ['employee' => $user->id]) }}">
                <i class="fa fa-edit"></i>
                Edit
            </a>
            @if($user->is_active==\App\Models\User::ACTIVE)
                <a class="dropdown-item"
                   href="{{ route('employee.changestatus',$user->id) }}">
                    <i class="fa fa-lock"></i>
                    Disable
                </a>
            @elseif($user->is_active==\App\Models\User::DEACTIVATED)
                <a class="dropdown-item"
                   href="{{ route('employee.changestatus',$user->id) }}">
                    <i class="fa fa-lock-open"></i>
                    Enable
                </a>
            @endif
        @endcan
        @can('deactivate', \App\Models\User::class)
            <a data-action="delete" data-form="#form{{$user->id}}" class="dropdown-item" href="#">
                <i class="fa fa-trash"></i>
                Delete
            </a>
            <form action="{{ route('employees.destroy',['employee' => $user->id]) }}" method="post"
                  id="form{{$user->id}}">
                @csrf()
                @method('DELETE')
            </form>
        @endcan
    </div>
</div>
