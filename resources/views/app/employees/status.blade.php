@if($user->is_active==\App\Models\User::ACTIVE)
    <span class="badge badge-success">Active</span>
@elseif($user->is_active==\App\Models\User::DEACTIVATED)
    <span class="badge badge-danger">Inactive</span>
@endif
