<div class="card-body pt-0 pb-0"  style="border-top:0;">
    <!-- <h6> Roadmap </h6> -->
    <div class="row">
        <div class="col-md-4 ">
            <!-- Horizontal form -->
            <div class="card">
                <div class="card-header bg-light header-elements-inline">
                    <h5 class="card-title"><i class="icon-circle2 icon-small text-orange pr-1"></i>Planned</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                            <!-- <a class="list-icons-item" data-action="reload"></a> -->
                            <!-- <a class="list-icons-item" data-action="remove"></a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Post -->
                    @foreach($plannedposts as $p)
                    <div class="row pb-2">
                        <div class="col-2">
                            <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('post.edit',$p->id)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                <div>
                                    <h6 class="mb-0 font-weight-bold">{{$p->title}}</h6>
                                    <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <!--/Post -->
                </div>
            </div>
            <!-- /horizotal form -->

        </div>
        <div class="col-md-4">
            <!-- Vertical form -->
            <div class="card">
                <div class="card-header bg-light header-elements-inline">
                    <h5 class="card-title"><i class="icon-circle2 text-violet pr-1"></i>In Progress</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Post -->
                    @foreach($inprogressposts as $p)
                    <div class="row pb-2">
                        <div class="col-2">
                            <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('post.edit',$p->id)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                <div>
                                    <h6 class="mb-0 font-weight-bold">{{$p->title}}</h6>
                                    <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                </div>
                            </a>
                        </div>
                    </div>

                    @endforeach
                    <!--/Post -->
                </div>
            </div>
            <!-- /vertical form -->

        </div>
        <div class="col-md-4">
            <!-- Vertical form -->
            <div class="card border-radius-8">
                <div class="card-header bg-light header-elements-inline">
                    <h5 class="card-title"><i class="icon-circle2 text-success pr-1"></i>Complete</h5>
                    <div class="header-elements">
                        <div class="list-icons">

                        </div>
                    </div>
                </div>

                <div class="card-body p-2 ">
                    <!-- Post -->
                    @foreach($completeposts as $p)
                    <div class="row pb-2">
                        <div class="col-2">
                            <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('post.edit',$p->id)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                <div>
                                    <h6 class="mb-0 font-weight-bold">{{$p->title}}</h6>
                                    <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <!--/Post -->
                </div>
            </div>
            <!-- /vertical form -->
        </div>
    </div>
</div>