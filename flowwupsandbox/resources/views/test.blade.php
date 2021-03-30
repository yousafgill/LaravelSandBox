<div class="card border-0">
    @if(isset($SelectedPost))
    <div class="card-header bg-light header-elements-inline">
        <h6 class="card-title font-weight-semibold">{{$SelectedPost->title}}</h6>
        <div class="header-elements">
            <ul class="list-inline list-inline-dotted text-muted mb-0">
                <li class="list-inline-item">42 comments</li>
                <li class="list-inline-item">75 pending review</li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 col-8 padding-0">
                <ul class="media-list">
                    <!-- BEGIN: Top Level Post -->
                    <li class="media flex-column flex-md-row">
                        <div class="mr-md-3 mb-2 mb-md-0">
                            <a href="#"><img src="/theme/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="32" height="32" alt=""></a>
                        </div>
                        <div class="media-body">
                            <div class="media-title">
                                <a href="#" class="font-weight-semibold">{{$SelectedPost->title}}</a>
                                <span class="text-muted ml-3">{{\Carbon\Carbon::createFromTimeStamp(strtotime($SelectedPost->created_at))->diffForHumans()}}</span>
                            </div>
                            <p>{{$SelectedPost->detail}}</p>
                            <ul class="list-inline list-inline-dotted font-size-sm">
                                <li class="list-inline-item">114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                <li class="list-inline-item"><a href="#">Reply</a></li>
                                <li class="list-inline-item"><a href="#">Edit</a></li>
                            </ul>
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
                    <li class="media flex-column flex-md-row">
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
                                <li class="list-inline-item">114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                <li class="list-inline-item"><a href="#">Reply</a></li>
                                <li class="list-inline-item"><a href="#">Edit</a></li>
                            </ul>

                            @if($cmt->is_reply==true)
                            <div class="media flex-column flex-md-row">
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
                                        <li class="list-inline-item">67 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                                        <li class="list-inline-item"><a href="#">Reply</a></li>
                                        <li class="list-inline-item"><a href="#">Edit</a></li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                    @endif
                    <!--END: Comments and Comments Reply Section -->
                </ul>



            </div>
            <div class="col-md-4 col-4 p-0">
                <div class="card p-0 border-0 shadow-0">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(isset($boards))
                                <div class="form-group">
                                    <x-jet-label for="board_id" class="control-label" value="Board" />
                                    <select name="board_id" id="board_id" wire:change="$emit('postboardchanged')" class="form-control">
                                        @foreach($boards as $board)
                                        <option value="{{$board->id}}">{{$board->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <hr class="m-0">

    <div class="card-body">
        <form wire:submit.prevent="PostComment">
            <h6 class="mb-3">Add comment</h6>
            <div class="mb-3">
                <textarea name="message" id="message" wire:model="message" class="form-control" rows="5"></textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="btn bg-blue"><i class="icon-plus22 mr-1"></i> Add comment</button>
            </div>
        </form>
    </div>
    @endif
</div>