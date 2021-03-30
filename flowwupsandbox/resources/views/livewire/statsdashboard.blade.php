<div>
    <div class="card-body pt-0 pb-0">
        <div class="card">
            <div class="card-header bg-light header-elements-inline">
                <h6 class="card-title">Activity Overview</h6>
                <div class="header-elements">
                    <select class="form-control custom-select" id="select_date">
                        <option value="val1">June, 29 - July, 5</option>
                        <option value="val2">June, 22 - June 28</option>
                        <option value="val3" selected="">June, 15 - June, 21</option>
                        <option value="val4">June, 8 - June, 14</option>
                    </select>
                </div>
            </div>

            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body">
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

                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body">
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

                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body">
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

                    <div class="col-sm-6 col-xl-3">
                        <div class="card card-body">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="font-weight-semibold mb-0">389,438</h3>
                                    <span class="text-uppercase font-size-sm text-muted">Status Changes</span>
                                </div>

                                <div class="ml-3 align-self-center">
                                    <i class="icon-pulse2 icon-3x text-danger-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('new-posts')

    @livewire('post-by-status')


</div>