<div class="card border-0 postbox-full">
    @if(isset($SelectedPost))
    <div class="card-header bg-light header-elements-inline">
        <h6 class="card-title font-weight-semibold">{{$SelectedPost->title}}</h6>
        <div class="header-elements">
            <ul class="list-inline list-inline-dotted text-muted mb-0">
                <!-- <li class="list-inline-item mr-3">42 comments</li> -->
                <!-- <li class="list-inline-item">75 pending review</li> -->
            </ul>
            <div class="list-icons">

            </div>
        </div>
    </div>
    <div class="card-body pt-0 pr-0 pb-0  ">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-xl-9 mt-3">
                <ul class="media-list">
                    <!-- BEGIN: Top Level Post -->
                    <li class="media flex-column flex-md-row ">
                        <div class="mr-md-3 mb-2 mb-md-0">
                            <a href="#"><img src="/theme/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="32" height="32" alt=""></a>
                        </div>
                        <div class="media-body" x-data="{ open: false}">
                            <div class="media-title">
                                <a href="#" class="font-weight-semibold">{{$SelectedPost->title}}</a>
                                <span class="text-muted ml-3">{{\Carbon\Carbon::createFromTimeStamp(strtotime($SelectedPost->created_at))->diffForHumans()}}</span>
                            </div>
                            <p>{{$SelectedPost->detail}}</p>
                            <ul class="list-inline list-inline-dotted font-size-sm">
                                <li class="list-inline-item">{{$SelectedPost->votes}} <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                <li class="list-inline-item"><a href="#" @click.prevent="open = true">Comment</a></li>
                                <li class="list-inline-item"><a href="{{route('post.edit',$SelectedPost->id)}}">Edit</a></li>
                                @if(isset($SelectedPost->estimated))
                                <li class="list-inline-item">
                                    <a href="#">
                                        <!-- <span class="badge  badge-warning float-right"> -->
                                        due {{\Carbon\Carbon::createFromTimeStamp(strtotime($SelectedPost->estimated))->diffForHumans()}}
                                        <!-- </span> -->
                                    </a>
                                </li>
                                @endif
                            </ul>

                            <!-- COMMENT BOX -->
                            <div class="card-body" id="div_post_comment" x-show="open" @click.away="open = false">
                                <form wire:submit.prevent="PostComment">
                                    <!-- <h6 class="mb-3">Comment</h6> -->
                                    <div class="mb-1">
                                        <textarea name="message" id="message" wire:model="message" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1" placeholder="give feedback"></i> post </button>
                                    </div>
                                </form>
                            </div>
                             <!--/COMMENT BOX -->
                             
                        </div>
                    </li>
                    <!--END: Top Level Post -->
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
                                <li class="list-inline-item"><a href="#" @click.prevent="open = true">Reply</a></li>
                                <li class="list-inline-item"><a href="#">Edit</a></li>
                            </ul>
                            <!--BEGIN: Comment Reply-to-reply Inline Editor -->
                            <div class="card-body" x-show="open" @click.away="open = false">
                                <form wire:submit.prevent="PostCommentReply({{$cmt->id}})">
                                    <div class="mb-3">
                                        <textarea name="commentreply" id="commentreply" wire:model="commentreply" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Reply</button>
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
                                        <li class="list-inline-item"><a href="#" @click.prevent="open = true">Reply</a></li>
                                        <li class="list-inline-item"><a href="#">Edit</a></li>
                                    </ul>
                                    <!--BEGIN: Comment Reply-to-reply Inline Editor -->
                                    <div class="card-body bg-light" x-show="open" @click.away="open = false">
                                        <form wire:submit.prevent="PostCommentReply({{$cmt->reply_to}})">
                                            <div class="mb-1">
                                                <textarea name="commentreply" id="commentreply" wire:model="commentreply" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Reply</button>
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
            <div class="col-md-4 col-lg-4 col-xl-3 border-left-1 border-light-grey">
                <div class="card-body">
                    @if(isset($boards))
                    <div class="form-group">
                        <x-jet-label for="board_id" class="control-label" value="Board" />
                        <select name="board_id" id="board_id" wire:model="board_id" wire:change.prevent="$emit('postboardchanged')" class="form-control">
                            @foreach($boards as $board)
                            <option value="{{$board->id}}" {{$board->id ==$SelectedPost->board_id ? " selected":''}}>{{$board->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(isset($categories))
                    <div class="form-group">
                        <x-jet-label for="category_id" class="control-label" value="Category" />
                        <select name="category_id" id="category_id" wire:model="category_id" wire:change.prevent="$emit('postcategorychanged')" class="form-control">
                            <option value="0">--Select Category --</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(isset($statuses))
                    <div class="form-group">
                        <x-jet-label for="status_id" class="control-label" value="Status" />
                        <select name="status_id" id="status_id" wire:model="status_id" wire:change.prevent="$emit('poststatuschanged')" class="form-control">
                            @foreach($statuses as $stat)
                            <option value="{{$stat->id}}" {{ $stat->id == $SelectedPost->status_id ? " selected" :'' }}>{{$stat->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <x-jet-label for="estimated" class="control-label" value="Estimated" />
                        <x-jet-input name="estimated" id="estimated" wire:model="estimated" wire:change.prevent="$emit('postestimatedchanged')" type="date" class="form-control" autofocus />
                    </div>
                    @if(isset($owners))
                    <div class="form-group">
                        <x-jet-label for="owner_id" class="control-label" value="Owner" />
                        <select name="owner_id" id="owner_id" wire:change="$emit('postownerchanged')" class="form-control">
                            @foreach($owners as $owner)
                            <option value="{{$owner->id}}">{{$owner->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- <hr class="m-0">
        <div class="card-body" id="div_post_comment">
            <form wire:submit.prevent="PostComment">
                <h6 class="mb-3">Comment</h6>
                <div class="mb-3">
                    <textarea name="message" id="message" wire:model="message" class="form-control" rows="2"></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> post </button>
                </div>
            </form>
        </div> -->

    </div>

    @endif
</div>