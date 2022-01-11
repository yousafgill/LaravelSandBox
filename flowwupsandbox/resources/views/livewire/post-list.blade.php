<div class="card-body px-0">
    <div class="form-group-feedback form-group-feedback-right ml-2 mr-3">
        <input type="search" class="form-control" wire:model="searchText" wire:change.prevent="$emit('SearchByText')" placeholder="Search">
        <div class="form-control-feedback">
            <i class="icon-search4 font-size-base text-muted"></i>
            <i class="icon-sort font-size-base  ml-10" data-toggle="dropdown">
                <ul class="navbar-nav ml-auto">
                     <li class="nav-item dropdown dropdown-user">
                        <div class="dropdown-menu dropdown-menu-right" style="font-family: sans-serif;">
                            <a href="#" wire:click="$emit('SortPostBy','created_at','desc')" class="dropdown-item"><i class="icon-sort-time-desc"></i>Latest First</a>
                            <a href="#" wire:click="$emit('SortPostBy','created_at','asc')" class="dropdown-item"><i class="icon-sort-time-asc"></i>Oldest First</a>
                            <a href="#" wire:click="$emit('SortPostBy','v.totalvotes','desc')" class="dropdown-item"><i class="icon-sort-numberic-desc"></i>Sort by Votes</a>
                            <a href="#" wire:click="$emit('SortPostBy','posts.status_id','asc')" class="dropdown-item"><i class="icon-certificate"></i>Sort by Status</a>
                        </div>
                    </li>
                </ul>
            </i>
        </div>
    </div>
    <div class="custom-scrollbars" style="max-height:600px;">
        <div class="mt-4 mb-4 mr-1 ">
            @foreach($posts as $post)
            <div class="media flex-column post-card-custom mb-1  flex-md-row  pt-1 pb-1 border-left-{{$post->status_color}} alpha-p{{$post->status_color}}">
                <div class="media-body pl-2" wire:click.prevent="$emit('postselected',{{$post->id}})">
                    <div class="media-title">
                        <a href="#" class="font-weight-semibold text-dark">{{$post->title}} </a>
                        <!-- <span class="font-size-sm text-muted ml-sm-2 mb-2 mb-sm-0 d-block d-sm-inline-block">{{\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()}}</span> -->
                    </div>

                    <p> {{ $post->detail}} </p>
                    <ul class="list-inline font-size-sm mb-0">
                        <li class="list-inline-item mr-1">{{$post->totalvotes}} <a href="#"><i class="icon-arrow-up22 text-success"></i></a></li>
                        <!-- <li class="list-inline-item"> <a href="#"><i class="icon-comment-discussion text-primary"></i></a></li> -->
                        <li class="list-inline-item"><span class="badge bg-{{$post->status_color}} mr-1">{{$post->status_title}}</span></li>
                        @if($post->is_new)
                        <li class="list-inline-item"><span class="badge badge-mark border-danger mr-1"></span></li>
                        @endif
                        <li class="list-inline-item"><span class="font-size-sm text-muted mr-1">{{\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()}}</span></li>
                    </ul>
                </div>
            </div>
            <!-- <hr class="mt-2 mb-2 padding-0"> -->
            @endforeach
        </div>
    </div>
</div>