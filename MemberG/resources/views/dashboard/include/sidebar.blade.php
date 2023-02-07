<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="">
            <span class="align-middle">
                <img src="{{asset('assets/1648607872_favicon.png')}}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Member G</span>
            </span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Dashboard
            </li>
            @if (Auth::user()->id_role==1)
            <li class="sidebar-item {{(request()->is('dashboard')) ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('dasboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @endif

            <li class="sidebar-item {{(request()->is('profile')) ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('profile')}}">
                    <i class="align-middle" data-feather="info"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-header ">
                Adminisistrasi
            </li>


            <li class="sidebar-item {{(request()->is('members')) ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('members.index')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Member</span>
                </a>
            </li>
            @if (Auth::user()->id_role==1)

            <li class="sidebar-header">
                Setting
            </li>


            <li class="sidebar-item {{(request()->is('account')) ? 'active' : ''}}">
                <a class="sidebar-link" href="{{route('account.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
