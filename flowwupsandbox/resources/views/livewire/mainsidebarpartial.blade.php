<div class="sidebar sidebar-light sidebar-main border-0 sidebar-shadow sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{ Auth::user()->profile_photo_url }}" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{Auth::user()->name}}</div>
                        <div class="font-size-xs opacity-50">
                            <!-- <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA -->
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item-divider"></li>
                <li class="nav-item mb-2">
                    <a href="{{url('/dashboard')}}" class="nav-link ">
                        <i class="icon-home4"></i>
                        <span> Home </span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{url('/dashboard/posts/-1')}}" class="nav-link ">
                        <i class="icon-bubble-lines4"></i>
                        <span> Feedback </span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{url('/dashboard/boards')}}" class="nav-link ">
                        <i class="icon-stack"></i>
                        <span> Boards </span>
                    </a>
                </li>
                <!--BEGIN: Settings -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-gear"></i> <span>Settings</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Settings" style="display: none;">
                        <li class="nav-item"><a href="{{ route('profile.show') }}" class="nav-link active"><i class="icon-user-lock"></i>Profile</a></li>
                        <li class="nav-item"><a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="nav-link"><i class="icon-collaboration"></i>Team Settings</a></li>
                        <!-- <li class="nav-item"><a href="#" class="nav-link"><i class="icon-user-plus"></i>Add Team Member</a></li> -->
                        <li class="nav-item"><a href="{{ route('billing') }}" class="nav-link"><i class="icon-credit-card"></i>Billing</a></li>
                        <li class="nav-item-divider"></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="nav-link"><i class="icon-switch"></i>Logout</a></li>
                        </form>
                        
                        <!-- <li class="nav-item"><a href="#" class="nav-link disabled">Clean <span class="badge bg-transparent align-self-center ml-auto">Coming soon</span></a></li> -->
                    </ul>
                </li>

                <!--END: Settings -->
            </ul>
        </div>
    </div>
    <!-- /sidebar content -->
</div>