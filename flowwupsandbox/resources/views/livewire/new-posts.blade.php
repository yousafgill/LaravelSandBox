<div class="card-body pt-0 pb-0"  style="border-top:0;">
    <div class="card">
        <div class="card-header bg-light header-elements-inline">
            <h5 class="card-title"><i class="icon-circle2 text-primary pr-1"></i>New Posts</h5>
            <div class="header-elements">
                <div class="list-icons">
                </div>
            </div>
        </div>
        <div class="card-body" >
            <div class="row">
                @foreach($newposts as $p)
                <div class="col-12">
                    <div class="card border-left-3 border-left-{{$p->status_color}} rounded-left-0">
                    <!-- <div class="card border-left-0 border-top-0 border-right-0 p-0"> -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1" style="max-width:4rem; !important">
                                    <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('NewPostsUpVotedHandler',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                        <div class="bg-light pt-0 pb-2 px-2 rounded text-center">
                                            {{$p->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <a href="{{route('post.edit',$p->id)}}">
                                                <h6 class="mb-0 text-default">{{$p->title}}</h6>
                                            </a>
                                            <p class="mb-0"><span class="text-{{$p->status_color}} font-weight-bold">{{$p->status_title}}</span></p>
                                            <p class="mb-0">{{\Illuminate\Support\Str::limit($p->detail, 80, $end='...')}}</p>
                                        </div>

                                        <ul class="list list-unstyled text-right mb-0 pt-2 mt-sm-0 ml-auto">
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