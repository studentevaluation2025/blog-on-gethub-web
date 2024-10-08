<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item {{ collect(['role.index', 'users.index', 'user_permissions.index'])->contains(Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{ collect(['role.index', 'users.index', 'user_permissions.index'])->contains(Route::currentRouteName()) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">

          <!-- Roles Menu Item -->
          <li class="{{ Route::currentRouteName() == 'role.index' ? 'active' : '' }}">
            <a href="{{ route('role.index') }}" style="{{ Route::currentRouteName() == 'role.index' ? 'font-weight:bold; color:#007bff;' : '' }}">
              <i class="bi bi-circle"></i><span>Roles</span>
            </a>
          </li>

          <!-- Users Menu Item -->
          <li class="{{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" style="{{ Route::currentRouteName() == 'users.index' ? 'font-weight:bold; color:#007bff;' : '' }}">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>

          <!-- User Permissions Menu Item -->
          <li class="{{ Route::currentRouteName() == 'user_permissions.index' ? 'active' : '' }}">
            <a href="{{ route('user_permissions.index') }}" style="{{ Route::currentRouteName() == 'user_permissions.index' ? 'font-weight:bold; color:#007bff;' : '' }}">
              <i class="bi bi-circle"></i><span>User Permissions</span>
            </a>
          </li>
        </ul>
      </li><!-- End User Management Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('category.index') }}">
          <i class="bi bi-tags"></i>
          <span>Category</span>
        </a>
      </li><!-- End Category Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('post.index') }}">
          <i class="bi bi-file-earmark-text"></i>
          <span>Post</span>
        </a>
      </li><!-- End Post Nav -->

    </ul>
</aside><!-- End Sidebar-->
