<div>
    <div class="card-body pt-0 pb-0">
        <div class="card-header  header-elements-inline">
            <h5 class="card-title">Activity Overview</h5>
            <div class="header-elements">
                <select class="form-control custom-select" id="select_date" wire:model="dateperiod" wire:change.prevent="$emit('statsdatechanged')">
                        <option value="all">All time</option>
                        <option value="today">Today</option>
                        <option value="sevendays">7 days</option>
                        <option value="fifteendays">15 Days</option>
                        <option value="thirtydays">30 days</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="card card-custom rounded-3 card-body">
                    <div class="media">
                        <div class="mr-3 align-self-center">
                            <i class="icon-file-text icon-3x text-success-400"></i>
                        </div>

                        <div class="media-body text-right">
                            <h3 class="font-weight-semibold mb-0">{{$totalposts}}</h3>
                            <span class="text-uppercase font-size-sm text-muted">Posts</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="card card-custom rounded-3 card-body">
                    <div class="media">
                        <div class="mr-3 align-self-center">
                            <i class="icon-rating3 icon-3x text-indigo-400"></i>
                        </div>

                        <div class="media-body text-right">
                            <h3 class="font-weight-semibold mb-0">{{$totalvotes}}</h3>
                            <span class="text-uppercase font-size-sm text-muted">Votes</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="card card-custom rounded-3 card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="font-weight-semibold mb-0">{{$totalcomments}}</h3>
                            <span class="text-uppercase font-size-sm text-muted">Comments</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-bubbles4 icon-3x text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @livewire('new-posts')

    @livewire('post-by-status')


</div>