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
        <!-- <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-secondary-toggle" type="button">
            <i class="icon-transmission"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-right-toggle" type="button">
            <i class="icon-more"></i>
        </button> -->
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <!-- <li class="nav-item">
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
            </li> -->
            <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="navbar-nav-link d-none d-md-block">
                    <i class="icon-home4"></i>
                    <!-- <span> Home </span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/dashboard/posts/-1')}}" class="navbar-nav-link d-none d-md-block">
                    <i class="icon-bubble-lines4"></i>
                    <!-- <span> Feedback </span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/dashboard/boards')}}" class="nav-link navbar-nav-link d-none d-md-block">
                    <i class="icon-stack"></i>
                    <!-- <span> Boards </span> -->
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                @if (auth()->user()->plan_mode =='Trial')
                <a href="#" class="navbar-nav-link bg-danger">
                    Your Trial Period will end in {{auth()->user()->free_trial_days_left}} days
                </a>
                @elseif(auth()->user()->plan_mode =='Subscription')
                <!-- <a href="#" class="navbar-nav-link bg-success">
                    Your successfully subscribed till {{auth()->user()->plan_until->toFormattedDateString()}}
                </a> -->
                @elseif(auth()->user()->plan_mode =='Cancelled')
                <a href="#" class="navbar-nav-link bg-warning">
                    You have cancelled your plan, your plan will end till  {{auth()->user()->plan_until->toFormattedDateString()}}
                </a>
                @endif
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    Text link
                </a>
            </li>

            <li class="nav-item dropdown">
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
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="dropdown-item"><i class="icon-cog5"></i> {{ __('Team Settings') }}</a>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <a href="{{ route('teams.create') }}" class="dropdown-item"><i class="icon-user-plus"></i> {{ __('Create New Team') }}</a>
                    @endcan
                        <div class="dropdown-divider"></div>
                    <!-- Team Switcher -->
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

@if (auth()->check() && auth()->user()->plan_mode=="Trial" && auth()->user()->free_trial_days_left <= 0) <!-- Modal -->
    <div class="modal NO-fade" tabindex="-1" role="dialog" style="display: block">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Upgrade Plan</h3>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Your Free Trial is over. Please choose plan to continue.
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-group mb-3">
                                <div class="card">
                                    <div class="card-body text-center px-0">
                                        <h4 class="mt-2 mb-3">Choose a Plan</h4>
                                        <h1 class="pricing-table-price"><span class="mr-1"></span></h1>
                                        <ul class="pricing-table-list list-unstyled mb-3">
                                            <li><strong></strong> </li>
                                            <li><strong>Total Teams </strong> </li>
                                            <li><strong>Total Active Boards </strong> </li>
                                            <li><strong>Tracked Users</strong></li>
                                            <li><strong>Active Team Members</strong> </li>
                                            <li><strong>Daily Backups</strong> </li>
                                            <li><strong>24/7 Support</strong> </li>
                                        </ul>
                                        <!-- <a href="#" class="btn bg-danger-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Purchase</a> -->
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center px-0">
                                        <h4 class="mt-2 mb-3">Starter</h4>
                                        <h1 class="pricing-table-price"><span class="mr-1">$</span>25
                                        </h1>

                                        <ul class="pricing-table-list list-unstyled mb-3">
                                            <li><strong></strong> </li>
                                            <li><strong>1</strong> </li>
                                            <li><strong>5</strong> </li>
                                            <li><strong>250</strong> </li>
                                            <li><strong>3</strong> </li>
                                            <li><strong><i class="icon-cancel-square2 text-danger"></i></strong> </li>
                                            <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                                        </ul>
                                        <button data-plan="plan_starter" class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
                                    </div>


                                </div>

                                <div class="card">
                                    <div class="card-body text-center px-0">
                                        <h4 class="mt-2 mb-3">Growth</h4>
                                        <h1 class="pricing-table-price"><span class="mr-1">$</span>35</h1>
                                        <ul class="pricing-table-list list-unstyled mb-3">
                                            <li><strong></strong> </li>
                                            <li><strong>5</strong> </li>
                                            <li><strong>15</strong> </li>
                                            <li><strong>2,500</strong> </li>
                                            <li><strong>15</strong> </li>
                                            <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                                            <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                                        </ul>
                                        <button data-plan="plan_growth" class="btn bg-pink-600 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
                                    </div>
                                    <div class="ribbon-container">
                                        <div class="ribbon bg-pink-600">Popular</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body text-center px-0">
                                        <h4 class="mt-2 mb-3">Business</h4>
                                        <h1 class="pricing-table-price"><span class="mr-1">$</span>49</h1>
                                        <ul class="pricing-table-list list-unstyled mb-3">
                                            <li><strong></strong> </li>
                                            <li><strong>10</strong> </li>
                                            <li><strong>Unlimited</strong> </li>
                                            <li><strong>Unlimited</strong> </li>
                                            <li><strong>Unlimited</strong> </li>
                                            <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                                            <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                                        </ul>
                                        <button data-plan="plan_business" class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif