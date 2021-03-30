<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
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
        <!-- Sidebar Date Range -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Date Range</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group">
                        <select name="" id="" class="form-control" wire:change.prevent="$emit('DateChanged',$event.target.value)">
                            <option value="all">All Time</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="lasttwodays">Last Two Days</option>
                            <option value="thisweek">This Week</option>
                            <option value="lastweek">Last Week</option>
                            <option value="lasttwoweek">Last Two Week</option>
                            <option value="lastthreeweek">Last Three Week</option>
                            <option value="currentmonth">Current Month</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <!-- /sidebar User Segments -->
        <!-- Sidebar Boards -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Boards</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{url('/dashboard/createboard')}}" class="list-icons-item"><i class="icon-add"></i></a>
                        <a class="list-icons-item" data-action="reload" wire:click="$emit('RefreshBoards')"></a>
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @livewire('boards-list')
            </div>
        </div>
        <!-- /sidebar Boards -->
        <!-- Sidebar Status -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Status</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @livewire('statuses-list')
            </div>
        </div>
        <!-- /sidebar Status -->

        <!-- Sidebar Tags -->
        <div class="card hidden">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Tags</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group-feedback form-group-feedback-right">
                        <input type="search" class="form-control" placeholder="tags">
                        <div class="form-control-feedback">
                            <i class="icon-price-tags font-size-base text-muted"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /sidebar Tags -->
        <!-- Sidebar Categories -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Categories</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{url('/dashboard/createcategory')}}" class="list-icons-item"><i class="icon-add"></i></a>
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @livewire('category-list')
            </div>
        </div>
        <!-- /sidebar categories -->
        <!-- Sidebar Owner -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Owner</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="#">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" name="owner" id="owner" class="form-input-styled" checked data-foucis>
                                All
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" name="owner" id="owner" class="form-input-styled" data-foucus>
                                No Owner
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" name="owner" id="owner" class="form-input-styled" data-foucus>
                                Me
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /sidebar Owner -->
    </div>
    <!-- /sidebar content -->
</div>