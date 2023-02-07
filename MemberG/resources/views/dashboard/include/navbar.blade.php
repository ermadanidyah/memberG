<nav class="navbar navbar-expand navbar-light navbar-bg ">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">


                </a>
                @if (Auth::user()->id_role==1)
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item text-danger" href="/logout-admin"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                    </div>
                @else
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item text-danger" href="/logout-member"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                    </div>
                @endif
            </li>
        </ul>
    </div>
</nav>
