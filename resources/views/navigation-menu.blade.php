<div class="iq-top-navbar">
    <div class="container">
        <div class="iq-navbar-custom">
            <div class="d-flex align-items-center justify-content-between">
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                    <i class="ri-menu-line wrapper-menu"></i>
                    <a href="index.html" class="header-logo">
                        <img src="/assets/images/loader.gif" class="img-fluid rounded-normal light-logo" alt="logo">
                        <img src="/assets/images/logo-white.png" class="img-fluid rounded-normal darkmode-logo" alt="logo">
                    </a>
                </div>
                <div class="iq-menu-horizontal">
                    <nav class="iq-sidebar-menu">
                        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                            <a href="index.html" class="header-logo">
                                <img src="/assets/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                            </a>
                            <div class="iq-menu-bt-sidebar">
                                <i class="las la-bars wrapper-menu"></i>
                            </div>
                        </div>
                        <ul id="iq-sidebar-toggle" class="iq-menu d-flex">
                                            @if(Auth::user()->role=='pm')
                                            <li class=" ">
                                                <a href="{{route('dashboard')}}" class="">
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="{{route('reservations.salle')}}" class="">
                                                    <span>List Rooms</span>
                                                </a>
                                            </li>
                                                @elseif (Auth::user()->role=='worker')
                                                <li class=" ">
                                                    <a href="{{route('dashboard')}}" class="">
                                                        <span>Dashboard</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="{{route('reservations.salle')}}" class="">
                                                        <span>List Rooms</span>
                                                    </a>
                                                </li>
                                                @else
                                                <li class=" ">
                                                    <a href="{{route('dashboard')}}" class="">
                                                        <span>Dashboard</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="{{route('users.show')}}" class="">
                                                        <span>User managment</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="{{route('reservations.salle')}}" class="">
                                                        <span>Reservation management</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="{{route('salles.show')}}" class="">
                                                        <span>Room Management</span>
                                                    </a>
                                                </li>
                                                @endif
                        </ul>
                    </nav>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="change-mode">
                        <div class="custom-control custom-switch custom-switch-icon custom-control-indivne">
                            <div class="custom-switch-inner">
                                <p class="mb-0"> </p>
                                <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                    <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                    <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">
                            @if(Auth::user()->role=='admin')
                            @livewire('notification.navbar')
                            @endif
                            <li class="caption-content">
                                <a href="#" class="search-toggle dropdown-toggle d-flex align-items-center" id="dropdownMenuButton3" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img src="{{asset(Auth::user()->profile_photo_url)}}" class="avatar-40 img-fluid rounded" alt="user">
                                    <div class="caption ml-3">
                                        <h6 class="mb-0 line-height">{{Auth::user()->name}}<i class="las la-angle-down ml-3"></i></h6>
                                    </div>
                                </a>
                                <div class="iq-sub-dropdown dropdown-menu user-dropdown" aria-labelledby="dropdownMenuButton3">
                                    <div class="card m-0">
                                        <div class="card-body p-0">
                                            <div class="py-3">
                                                <a href="{{route('profile.show')}}" class="iq-sub-card">
                                                    <div class="media align-items-center">
                                                        <i class="ri-user-line mr-3"></i>
                                                        <h6>Account Settings</h6>
                                                    </div>
                                                </a>
                                            </div>

                                            <form action="{{route('logout')}}" method="POST">
                                                @csrf
                                            <button class="right-ic p-3 border-top btn-block position-relative text-center" type="submit">
                                                 Logout
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

