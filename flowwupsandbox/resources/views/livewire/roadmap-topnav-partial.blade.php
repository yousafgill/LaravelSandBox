<div class="navbar navbar-expand-md navbar-light">
    <div class="navbar-brand">
        <!-- <a href="{{url('/roadmap')}}" class="d-inline-block">
            <img src="/theme/global_assets/images/logo_dark.png" alt="">
        </a>
        -->
        @if(isset($company))
            <a href="{{url('/dashboard')}}" class="d-inline-block">
            <h4 class="text-default">{{$company->name}}</h4>
            </a>
        @else
            <a href="{{url('/roadmap')}}" class="d-inline-block">
            <!-- <img src="/theme/global_assets/images/logo_dark.png" alt=""> -->
            <h4 class="text-default">{{session('tenant')->name}}</h4>
            </a>
        @endif
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-secondary-toggle" type="button">
            <i class="icon-transmission"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-right-toggle" type="button">
            <i class="icon-more"></i>
        </button>

    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <!-- <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-secondary-toggle d-none d-md-block">
                    <i class="icon-transmission"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-right-toggle d-none d-md-block">
                    <i class="icon-indent-decrease2"></i>
                </a>
            </li>


          

        </ul> -->

        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    Text link
                </a>
            </li> -->

          
            @guest
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link" data-toggle="modal" data-target="#modal-tabbed">
                    Login / Signup
                </a>
            </li>
            @else
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('publicuser.changepassword')}}" class="dropdown-item"><i class="icon-user-plus"></i>{{ __('Profile') }}</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item"><i class="icon-switch2"></i> {{ __('Logout') }}</a>
                </form>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>