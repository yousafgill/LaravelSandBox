<div class="card-body py-0 mt-4" style="border-top:0;">
    <!-- <h6> Roadmap </h6> -->
    <div class="row">
        <div class="col-md-4 ">
            <h5 class="card-title"><i class="icon-circle2 icon-small text-orange pr-1"></i>Planned</h5>
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
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                        <div class="pt-0 pb-2 px-1 rounded text-center">
                                            {{$p->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 pt-2 pb-4">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap pt-1">
                                        <div>
                                            <a href="{{route('post.edit',$p->id)}}">
                                                <h6 class="mb-0 text-default">{{$p->title}}</h6>
                                            </a>
                                            <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h5 class="card-title"><i class="icon-circle2 text-violet pr-1"></i>In Progress</h5>
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
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                        <div class="pt-0 pb-2 px-1 rounded text-center">
                                            {{$p->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 pt-2 pb-4">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap pt-1">
                                        <div>
                                            <a href="{{route('post.edit',$p->id)}}">
                                                <h6 class="mb-0 text-default">{{$p->title}}</h6>
                                            </a>
                                            <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>



        </div>
        <div class="col-md-4">
            <h5 class="card-title"><i class="icon-circle2 text-success pr-1"></i>Complete</h5>
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
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('StatsDashboardUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                        <div class="pt-0 pb-2 px-1 rounded text-center">
                                            {{$p->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 pt-2 pb-4">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap pt-1">
                                        <div>
                                            <a href="{{route('post.edit',$p->id)}}">
                                                <h6 class="mb-0 text-default">{{$p->title}}</h6>
                                            </a>
                                            <p class="mb-0"><span class=" text-muted font-weight-bold">{{$p->boardname}}</span></p>
                                        </div>
                                    </div>
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