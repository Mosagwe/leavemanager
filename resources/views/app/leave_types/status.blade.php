@if($leaveType->can_use_partially)
    <span class="badge badge-success">
        <i class="fa fa-check"></i>
    </span>
@else
    <span class="badge badge-danger">
        &times;
    </span>
@endif
