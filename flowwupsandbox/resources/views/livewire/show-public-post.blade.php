<div class="d-md-flex align-items-md-start">
    <!-- Left sidebar component -->
    <div class="sidebar sidebar-light sidebar-component sidebar-component-left bg-transparent border-0 shadow-0 sidebar-expand-md ">
        <!-- Sidebar content -->
        <div class="sidebar-content">
            <!-- Sidebar search -->
            <div class="card">
                <div class="card-header bg-light header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Voters</span>
                    <div class="header-elements">
                        <div class="list-icons">
                        </div>
                    </div>
                </div>

                <!--BEGIN: Posts List -->
                <!-- <div class="card-body p-0"> -->
                <div class="list-group list-group-fluch">
                    @foreach($postvoters as $pv)
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="icon-user mr-3 text-success"></i>
                        {{$pv->name}}
                    </a>
                    @endforeach
                </div>
                <!-- </div> -->
                <!--END: Posts List -->

            </div>
            <!-- /sidebar search -->
        </div>
        <!-- /sidebar content -->
    </div>
    <!-- /left sidebar component -->

    <!-- Right content -->
    <div class="w-100">
        <!-- BEGIN: Post Detail-->
        <div class="card">
            @if(isset($SelectedPost))
            <div class="card-header bg-light header-elements-inline">
                <h6 class="card-title font-weight-semibold">{{$SelectedPost->title}}</h6>
                <div class="header-elements">
                    <ul class="list-inline list-inline-dotted text-muted mb-0">
                    </ul>
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 padding-0">
                        <ul class="media-list">
                            <!-- BEGIN: Top Level Post -->
                            <li class="media flex-column flex-md-row ">
                                <div class="mr-md-3 mb-2 mb-md-0">
                                    <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                        @guest
                                        <a href="#" class="text-center  text-secondary" data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                        @else
                                        <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('UpVotedHandler',{{$SelectedPost->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                        @endif
                                        <div class="bg-light pt-0 pb-2 px-2 rounded text-center">
                                            {{$SelectedPost->totalvotes}}
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-title mb-0">
                                        <h6 class="font-weight-semibold mb-0">{{$SelectedPost->title}}</h6>
                                    </div>
                                    <p class="mb-0"><span class="text-{{$SelectedPost->status_color}} font-weight-bold">{{$SelectedPost->status_title}}</span></p>
                                    <p>{{$SelectedPost->detail}}</p>
                                    <ul class="list-inline list-inline-dotted font-size-sm">
                                        <li class="list-inline-item"><span class="text-muted">{{\Carbon\Carbon::createFromTimeStamp(strtotime($SelectedPost->created_at))->diffForHumans()}}</span></li>
                                        @auth
                                        <li class="list-inline-item"><a href="#div_post_comment">Comment</a></li>
                                        @else
                                        <li class="list-inline-item"><a href="#"  data-toggle="modal" data-target="#modal-tabbed" >Comment</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            <!--END: Top Level Post  -->
                            <!-- <hr class="mt-10"> -->
                            <div class="media-title mt-3">
                                <p class="font-weight-semibold">Activity</p>
                            </div>
                            <!--BEGIN: Comments and Comments Reply Section -->

                            @if(isset($CurrentPostcomments))
                            @foreach($CurrentPostcomments as $cmt)
                            @if($cmt->is_reply==false)
                            <li class="media flex-column flex-md-row bg-light border-left-3 border-left-primary pl-1 pt-2 pb-2">
                                <div class="mr-md-3 mb-2 mb-md-0">
                                    <a href="#"><img src="/theme/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="24" height="24" alt=""></a>
                                </div>
                                <div class="media-body" x-data="{ open: false}">
                                    <div class="media-title">
                                        <a href="#" class="font-weight-semibold">{{$cmt->name}}</a>
                                        <span class="text-muted ml-3">{{\Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans()}}</span>
                                    </div>
                                    <p>{{$cmt->message}}</p>
                                    <ul class="list-inline list-inline-dotted font-size-sm">
                                        <!-- <li class="list-inline-item"> {{$cmt->ranking}} <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li> -->
                                        @auth
                                        <li class="list-inline-item"><a href="#" @click.prevent="open = true">Reply</a></li>
                                        @else
                                        <li class="list-inline-item"><a href="#"  data-toggle="modal" data-target="#modal-tabbed" >Reply</a></li>
                                        @endif
                                        <!-- <li class="list-inline-item"><a href="#">Edit</a></li> -->
                                    </ul>
                                    <!--BEGIN: Comment Reply-to-reply Inline Editor -->
                                    <div class="card-body" x-show="open" @click.away="open = false">
                                        <form wire:submit.prevent="PostPublicCommentReply({{$cmt->id}})">
                                            <div class="mb-3">
                                                <textarea name="commentreply" id="commentreply" required wire:model="commentreply" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="text-right">
                                                @auth
                                                <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Reply</button>
                                                @else
                                                <button type="button" class="btn bg-blue"  data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-plus22 mr-1"></i> Reply</button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <!--END: Comment Reply-to-reply Inline Editor -->
                                </div>
                            </li>
                            @endif
                            @if($cmt->is_reply==true)
                            <li class="media flex-column flex-md-row">
                                <div class="mr-md-3 mb-2 mb-md-0">
                                </div>
                                <div class="media-body" x-data="{ open: false}">
                                    <div class="media-title">
                                    </div>
                                    <p></p>
                                    <ul class="list-inline list-inline-dotted font-size-sm">
                                    </ul>
                                    <div class="media flex-column flex-md-row bg-white border-left-0 border-left-grey pl-4 pt-2 pb-2">
                                        <div class="mr-md-3 mb-2 mb-md-0">
                                            <a href="#"><img src="/theme/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="24" height="24" alt=""></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-title">
                                                <a href="#" class="font-weight-semibold">{{$cmt->name}}</a>
                                                <span class="text-muted ml-3">{{\Carbon\Carbon::createFromTimeStamp(strtotime($cmt->created_at))->diffForHumans()}}</span>
                                            </div>
                                            <p>{{$cmt->message}}</p>
                                            <ul class="list-inline list-inline-dotted font-size-sm">
                                                <!-- <li class="list-inline-item">{{$cmt->ranking}} <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li> -->
                                                @auth
                                                <li class="list-inline-item"><a href="#" @click.prevent="open = true">Reply</a></li>
                                                @else
                                                <li class="list-inline-item"><a href="#"   data-toggle="modal" data-target="#modal-tabbed"  >Reply</a></li>
                                                @endif
                                                <!-- <li class="list-inline-item"><a href="#">Edit</a></li> -->
                                            </ul>
                                            <!--BEGIN: Comment Reply-to-reply Inline Editor -->
                                            <div class="card-body bg-light" x-show="open" @click.away="open = false">
                                                <form wire:submit.prevent="PostPublicCommentReply({{$cmt->reply_to}})">
                                                    <div class="mb-1">
                                                        <textarea name="commentreply" id="commentreply" required wire:model="commentreply" class="form-control" rows="2"></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        @auth
                                                        <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Reply</button>
                                                        @else
                                                        <button type="button" class="btn bg-blue" data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-plus22 mr-1"></i> Reply</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                            <!--END: Comment Reply-to-reply Inline Editor -->
                                        </div>

                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                            @endif

                            <!--END: Comments and Comments Reply Section -->
                        </ul>
                    </div>

                </div>

            </div>

            <hr class="m-0">

            <div class="card-body" id="div_post_comment">
                <form wire:submit.prevent="PostPublicComment">
                    <h6 class="mb-3">Add comment</h6>
                    <div class="mb-3">
                        <textarea name="message" id="message" required wire:model="message" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="text-right">
                        @auth
                        <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Add comment</button>
                        @else
                        <button type="button" data-toggle="modal" data-target="#modal-tabbed"  class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Add comment</button>
                        @endif
                    </div>
                </form>
            </div>
            @endif

        </div>
        <!-- END: Post Detail -->
    </div>
    <!-- /right content -->
</div>