<div class="card-body mt-4 pt-0 pb-0" style="border-top:0;">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h5 class="card-title"><i class="icon-circle2 text-primary pr-1"></i>New Posts</h5>
            <div class="row">
                @if(count($newposts)<1) 
                    <div class="col-12">
                        <div class="card-custom-empty rounded-3  mb-1">
                            <div class="row">
                                <div class="col-12 py-3 text-center vertical-center">
                                    <p>No new posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            @foreach($newposts as $p)
            <div class="col-12">
                <div class="card card-custom rounded-3  mb-2">
                    <!-- <div class="card border-left-0 border-top-0 border-right-0 p-0"> -->
                    <div class="card-body p-0 ">
                        <div class="row">
                            <div class="col-2 alpha-slate pt-3" style="max-width:3rem; !important">
                                <div class="d-flex justify-content-center flex-column p-0">
                                    <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('NewPostsUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
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
                                        <p class="mb-0"><span class="text-{{$p->status_color}}">{{$p->status_title}}</span></p>
                                        <!-- <p class="mb-0">{{\Illuminate\Support\Str::limit($p->detail, 80, $end='...')}}</p> -->
                                    </div>

                                    <ul class="list list-unstyled text-right mb-0 pt-3 mt-sm-0 ml-auto mr-2">
                                        <!-- <li><span class="badge bg-{{$p->status_color}}">{{$p->status_title}}</span></li> -->
                                        <!-- <li><span class="align-right-"><i class="mi-comment pr-1"></i></span>{{$p->totalcomments}}</li> -->
                                        <li><span class="align-right-"><i class="icon-calendar3 pr-2"></i></span>{{\Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->diffForHumans()}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <h5 class="card-title"><i class="icon-circle2 text-primary pr-1"></i>New Comments</h5>
        <div class="row">
            @if(count($newcomments)<1) 
                <div class="col-12">
                    <div class="card-custom-empty rounded-3  mb-1">
                        <div class="row">
                            <div class="col-12 py-3 text-center vertical-center">
                                <p>No new comments</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @foreach($newcomments as $p)
        <div class="col-12">
            <div class="card card-custom rounded-3  mb-2">
                <!-- <div class="card border-left-0 border-top-0 border-right-0 p-0"> -->
                <div class="card-body p-0 ">
                    <div class="row">
                        <div class="col-2 alpha-slate py-3" style="max-width:3rem; !important">
                            <div class="d-flex justify-content-center flex-column p-0">
                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('NewPostsUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-1x p-0"></i></a>
                                <div class="pt-0 pb-2 px-1 rounded text-center">
                                    {{$p->totalvotes}}
                                </div>
                            </div>
                        </div>
                        <div class="col-10 pt-2 pb-4">
                            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap pt-1">
                                <div>
                                    <a href="{{route('post.edit',$p->id)}}">
                                        <h6 class="mb-0 text-default">{{$p->post_title}}</h6>
                                    </a>
                                    <!-- <p class="mb-0"><span class="text-{{$p->status_color}}">{{$p->status_title}}</span></p> -->
                                    <p class="mb-0 text-primary">{{\Illuminate\Support\Str::limit($p->message, 80, $end='...')}}</p>
                                </div>

                                <ul class="list list-unstyled text-right mb-0 pt-3 mt-sm-0 ml-auto mr-2">
                                    <!-- <li><span class="badge bg-{{$p->status_color}}">{{$p->status_title}}</span></li> -->
                                    <!-- <li><span class="align-right-"><i class="mi-comment pr-1"></i></span>{{$p->totalcomments}}</li> -->
                                    <li><span class="align-right-"><i class="icon-calendar3 pr-2"></i></span>{{\Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->diffForHumans()}}</li>
                                </ul>
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