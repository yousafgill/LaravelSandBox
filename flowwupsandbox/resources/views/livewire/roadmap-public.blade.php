<div>
    <h5> Give feedback </h5>
    <div class="row">
        @if(count($boards)<1) 
            <div class="col-12">
                <div class="card-custom-empty rounded-3  mb-1">
                    <div class="vertical-center">
                        <div class="">
                            <p>oops !!! there are no active boards for this company</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach($boards as $b)
        <div class="col-md-4 ">
            <!-- Horizontal form -->
            <a href="{{route('showboard.public',$b->slug)}}" class="card card-body card-custom border-radius-8 text-secondary py-2 px-2">
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

    <div class="mt-4">
        <h5> Roadmap </h5>
        <div class="row">
            <div class="col-md-4 ">
                <h6 class="card-title"><i class="icon-circle2 icon-small text-orange pr-1"></i>Planned</h6>
                <div class="row">
                    @if(count($plannedposts)<1) 
                    <div class="col-12">
                        <div class="card-custom-empty-large rounded-3  mb-1">
                            <div class="vertical-center">
                                <div class="">
                                    <p>No Planned Posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($plannedposts as $p)
                <div class="col-12">
                    <div class="card card-custom rounded-3  mb-2">
                        <div class="card-body p-0 ">
                            <div class="row">
                                <div class="col-2 alpha-slate pt-3" style="max-width:3rem; !important">
                                    <div class="d-flex justify-content-center flex-column p-0">
                                        @auth
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                        @else
                                        <a href="#" class="text-center  text-secondary" data-toggle="modal" data-target="#modal-tabbed"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                        @endif

                                        <div class="pt-0 pb-2 px-1 rounded text-center">
                                            {{$p->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 pt-2 pb-4">
                                    <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h6 class="mb-0 font-weight-normal">{{$p->title}}</h6>
                                            <p class="mb-0"><span class=" text-muted font-weight-normal">{{$p->boardname}}</span></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="col-md-4">
            <h6 class="card-title"><i class="icon-circle2 text-violet pr-1"></i>In Progress</h6>
            <div class="row">
                @if(count($inprogressposts)<1) 
                <div class="col-12">
                    <div class="card-custom-empty-large rounded-3  mb-1">
                        <div class="vertical-center">
                            <div class="">
                                <p>No Inprogress Posts</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach($inprogressposts as $p)
            <div class="col-12">
                <div class="card card-custom rounded-3  mb-2">
                    <div class="card-body p-0 ">
                        <div class="row">
                            <div class="col-2 alpha-slate pt-3" style="max-width:3rem; !important">
                                <div class="d-flex justify-content-center flex-column p-0">
                                    @auth
                                    <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                    @else
                                    <a href="#" class="text-center  text-secondary" data-toggle="modal" data-target="#modal-tabbed"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                    @endif

                                    <div class="pt-0 pb-2 px-1 rounded text-center">
                                        {{$p->totalvotes}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 pt-2 pb-4">
                                <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                    <div>
                                        <h6 class="mb-0 font-weight-normal">{{$p->title}}</h6>
                                        <p class="mb-0"><span class=" text-muted font-weight-normal">{{$p->boardname}}</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    <div class="col-md-4">
        <h6 class="card-title"><i class="icon-circle2 text-success pr-1"></i>Complete</h6>
        <div class="row">
            @if(count($completeposts)<1) 
            <div class="col-12">
                <div class="card-custom-empty-large rounded-3  mb-1">
                    <div class="vertical-center">
                        <div class="">
                            <p>No Completed Posts</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @foreach($completeposts as $p)
        <div class="col-12">
            <div class="card card-custom rounded-3  mb-2">
                <div class="card-body p-0 ">
                    <div class="row">
                        <div class="col-2 alpha-slate pt-3" style="max-width:3rem; !important">
                            <div class="d-flex justify-content-center flex-column p-0">
                                @auth
                                <a href="#" class="text-secondary  text-center" wire:click.prevent="$emit('RoadmapUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                @else
                                <a href="#" class="text-secondary  text-center" data-toggle="modal" data-target="#modal-tabbed"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                @endif

                                <div class="pt-0 pb-2 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10 pt-2 pb-4">
                            <a href="{{route('showpost.public',$p->slug)}}" class="text-default d-sm-flex align-item-sm-center flex-sm-nowrap">
                                <div>
                                    <h6 class="mb-0 font-weight-normal">{{$p->title}}</h6>
                                    <p class="mb-0"><span class=" text-muted font-weight-normal">{{$p->boardname}}</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
</div>
</div>
</div>