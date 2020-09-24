<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark sidenav sidenav-bar accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('applications.index') }}">
        <div class="sidebar-brand-text mx-3">
           <font style="color:#000;">Huduma </font><font style="color:#fa3333;">Kenya </font><font style="color:#009933;">Secretariat </font>
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <hr class="sidebar-divider">
    @can('view-Any', \App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Employees</span>
            </a>
        </li>
    @endcan
    <div class="sidebar-heading">
        Leave Applications
    </div>
    @can('recommend', \App\Models\LeaveRequest::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leave-requests.pending') }}">
                <i class="fas fa-clock"></i>
                <span>Pending</span>
                @if($pendingCount)
                    <span class="badge badge-warning">{{ $pendingCount }}</span>
                @endif
            </a>
        </li>
    @endcan
    @can('approve', \App\Models\LeaveRequest::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leave-requests.recommended') }}">
                <i class="fas fa-check-double"></i>
                <span>Recommended</span>
                @if($pendingApprovalCount)
                    <span class="badge badge-warning">{{ $pendingApprovalCount }}</span>
                @endif
            </a>
        </li>
    @endcan
    @can('view-approved', \App\Models\LeaveRequest::class)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leave-requests.approved') }}">
                <i class="fas fa-check-circle"></i>
                <span>Approved</span>
                @if($approvedCount)
                    <span class="badge badge-warning">{{ $approvedCount }}</span>
                @endif
            </a>
        </li>
    @endcan
    @if(\Illuminate\Support\Facades\Auth::user()->isAdministrator())
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Configurations
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('departments.index') }}">
                <i class="fas fa-desktop"></i>
                <span>Departments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index') }}">
                <i class="fas fa-user-cog"></i>
                <span>Roles</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('leave-types.index') }}">
                <i class="fas fa-clock"></i>
                <span>Leave Types</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('holidays.index') }}">
                <i class="fa fa-umbrella-beach"></i>
                <span>Holidays</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employment-types.index') }}">
                <i class="fa fa-pen-fancy"></i>
                <span>Employment Types</span>
            </a>
        </li>
    @endcan
    <div class="sidebar-heading">
        {{ Auth::user()->name }}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('applications.index') }}">
            <i class="fas fa-edit"></i>
            <span>My Leave Applications</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('inplace.index') }}">
            <i class="fas fa-user"></i>
            <span>Inplace Requests</span>
            @if($pendinginplaceCount)
                <span class="badge badge-warning">{{ $pendinginplaceCount }}</span>
            @endif
        </a>
    </li>
</ul>
