<li class="nav-item {{ request()->is('roles') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('rpm.role.list') }}">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>User Roles</span></a>
</li>

<li class="nav-item {{ request()->is('permission*') ? 'active' : '' }}">
    <a aria-controls="permissionMenu" aria-expanded="true" class="nav-link collapsed" data-target="#permissionMenu"
       data-toggle="collapse" href="#">
        <i class="fas fa-list-ol"></i>
        <span>Permissions</span>
    </a>
    <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionSidebar" id="permissionMenu">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Permissions:</h6>
            <a class="collapse-item {{ request()->is('permission-groups') ? 'active' : '' }}"
               href="{{ route('rpm.permission-group.list') }}">Permission Groups</a>
            <a class="collapse-item {{ request()->is('permissions') ? 'active' : '' }}" href="">Permissions</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
