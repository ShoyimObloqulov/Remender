{{--Left sidebar--}}
<nav class="mt-2">

    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            @canany([
              'permission.show',
              'roles.show',
              'user.show'
           ])
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''}}">
                    <i class="fas fa-users-cog"></i>
                    <p>
                        @lang('cruds.userManagement.title')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'block':'none'}};">
                    @can('permission.show')
                        <li class="nav-item">
                            <a href="{{ route('permissionIndex') }}" class="nav-link {{ Request::is('permission*') ? "active":'' }}">
                                <i class="fas fa-key"></i>
                                <p> @lang('cruds.permission.title_singular')</p>
                            </a>
                        </li>
                    @endcan

                    @can('roles.show')
                        <li class="nav-item">
                            <a href="{{ route('roleIndex') }}" class="nav-link {{ Request::is('role*') ? "active":'' }}">
                                <i class="fas fa-user-lock"></i>
                                <p> @lang('cruds.role.fields.roles')</p>
                            </a>
                        </li>
                    @endcan

                    @can('user.show')
                        <li class="nav-item">
                            <a href="{{ route('userIndex') }}" class="nav-link {{ Request::is('user*') ? "active":'' }}">
                                <i class="fas fa-user-friends"></i>
                                <p> @lang('cruds.user.title')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @can('api-user.view')
            <li class="nav-item">
                <a href="{{ route('api-userIndex') }}" class="nav-link {{ Request::is('api-users*') ? "active":'' }}">
                    <i class="fas fa-cog"></i>
                    <sub><i class="fas fa-child"></i></sub>
                    <p> API-@lang('cruds.user.title')</p>
                </a>
            </li>
        @endcan
        @can('remenders.show')
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ (Request::is('remenders*')) ? 'active':''}}">
                    <i class="fas fa-user-clock"></i>
                    <p>
                        @lang('cruds.remenders.title')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ (Request::is('remenders*')) ? 'block':'none'}};">
                    @can('remenders.show')
                        <li class="nav-item">
                            <a href="{{ route('remenders.index') }}" class="nav-link {{ Request::is('remenders') ? "active":'' }}">
                                <i class="fas fa-eye"></i>
                                <p> @lang('cruds.remenders.eye')</p>
                            </a>
                        </li>
                    @endcan

                    @can('remenders.create')
                        <li class="nav-item">
                            <a href="{{ route('remenders.create') }}" class="nav-link {{ Request::is('remenders/create') ? "active":'' }}">
                                <i class="fas fa-plus"></i>
                                <p>  @lang('cruds.remenders.create')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('guests.index')
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ (Request::is('guests*')) ? 'active':''}}">
                    <i class="fas fa-suitcase"></i>
                    <p>
                        @lang('cruds.guests.title')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ (Request::is('guests*')) ? 'block':'none'}};">
                    @can('guests.show')
                        <li class="nav-item">
                            <a href="{{ route('guests.index') }}" class="nav-link {{ Request::is('guests') ? "active":'' }}">
                                <i class="fas fa-eye"></i>
                                <p> @lang('cruds.guests.eye')</p>
                            </a>
                        </li>
                    @endcan

                    @can('guests.create')
                        <li class="nav-item">
                            <a href="{{ route('guests.create') }}" class="nav-link {{ Request::is('guests/create') ? "active":'' }}">
                                <i class="fas fa-plus"></i>
                                <p>  @lang('cruds.guests.create')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('states.index')
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link {{ (Request::is('states*')) ? 'active':''}}">
                    <i class="fas fa-door-open"></i>
                    <p>
                        @lang('cruds.states.title')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ (Request::is('states*')) ? 'block':'none'}};">
                    @can('states.show')
                        <li class="nav-item">
                            <a href="{{ route('states.index') }}" class="nav-link {{ Request::is('states') ? "active":'' }}">
                                <i class="fas fa-eye"></i>
                                <p> @lang('cruds.states.eye')</p>
                            </a>
                        </li>
                    @endcan

                    @can('states.create')
                        <li class="nav-item">
                            <a href="{{ route('states.create') }}" class="nav-link {{ Request::is('states/create') ? "active":'' }}">
                                <i class="fas fa-plus"></i>
                                <p>  @lang('cruds.states.create')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="" class="nav-link">
            <i class="fas fa-palette"></i>
            <p>
                @lang('global.theme')
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
            <ul class="nav nav-treeview" style="display: none">
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'default']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p class="text">Default {{ auth()->user()->theme == 'default' ? '✅':'' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'light']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-white"></i>
                        <p>Light {{ auth()->user()->theme == 'light' ? '✅':'' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'dark']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-gray"></i>
                        <p>Dark {{ auth()->user()->theme == 'dark' ? '✅':'' }}</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
{{--    @can('card.main')--}}

{{--    @endcan--}}
</nav>
