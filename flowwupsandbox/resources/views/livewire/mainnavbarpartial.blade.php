<div class="navbar navbar-expand-md navbar-light">
    <div class="navbar-brand">
        <a href="{{url('/')}}" class="d-inline-block">
            @if(isset($company))
            <h4 class="text-default">{{$company->name}}</h4>
            @else
            <img src="/theme/global_assets/images/logo_dark.png" alt="">
            @endif
        </a>
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
        <ul class="navbar-nav">
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
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    Text link
                </a>
            </li> -->

            <!-- <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link">
                    <i class="icon-bell2"></i>
                    <span class="d-md-none ml-2">Notifications</span>
                    <span class="badge badge-mark border-white ml-auto ml-md-0"></span>
                </a>
            </li> -->

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="icon-user-plus"></i>{{ __('Profile') }}</a>
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('api-tokens.index') }}" class="dropdown-item"><i class="icon-atom"></i> {{ __('API Tokens') }}</a>
                    @endif


                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <!-- Team Settings -->
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="dropdown-item"><i class="icon-cog5"></i> {{ __('Team Settings') }}</a>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <a href="{{ route('teams.create') }}" class="dropdown-item"><i class="icon-user-plus"></i> {{ __('Create New Team') }}</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    <!-- Team Switcher -->
                    <div class="dropdown-header">My Teams</div>
                    @foreach (Auth::user()->allTeams() as $team)
                    <!-- d- is added extra to break -->
                    <x-jet-switchable-team :team="$team" />
                    @endforeach

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('billing') }}" class="dropdown-item"><i class="icon-credit-card"></i> {{ __('Billing') }}</a>
                    <!-- Team Billing -->
                    <div class="dropdown-divider"></div>
                    @endif
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item"><i class="icon-switch2"></i> {{ __('Logout') }}</a>
                    </form>
                    <!-- <a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a> -->
                </div>
            </li>
        </ul>
    </div>
</div>