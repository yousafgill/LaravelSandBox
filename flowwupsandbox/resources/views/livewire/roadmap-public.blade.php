<div>
    <h6> Give feedback </h6>
    <div class="row">
        @foreach($boards as $b)
        <div class="col-md-4 ">
            <!-- Horizontal form -->
            <a href="{{route('showboard.public',$b->slug)}}" class="card card-body  border-radius-8 text-secondary py-2 px-2">
                <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                    <div class="media-body text-center text-md-left">
                        <h6 class="media-title font-weight-semibold pt-1">{{$b->name}}</h6>
                    </div>
                    <span class="btn alpha-slate ml-md-3 mt-3 mt-md-0">{{$b->totalposts}}</span>
                </div>
            </a>
            <!-- /horizotal form -->
        </div>
        @endforeach
    </div>
    <h6> Roadmap </h6>
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
                                @auth
                                    <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @else
                                    <a href="#" class="text-center  text-secondary"  data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @endif
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
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
                                @auth
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @else
                                <a href="#" class="text-center  text-secondary"  data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @endif
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
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
                                @auth
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @else
                                <a href="#" class="text-center  text-secondary" data-toggle="modal" data-target="#modal-tabbed"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                @endif
                                <div class="bg-light pt-0 pb-1 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
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