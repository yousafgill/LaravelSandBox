<div>
    <h6> {{$board->name}} </h6>
    <div class="row">
        <div class="col-md-4 ">
            <!-- Horizontal form -->
            <div class="card">
                <div class="card-header bg-light header-elements-inline">
                    <h5 class="card-title">Create Post</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                            <!-- <a class="list-icons-item" data-action="reload"></a> -->
                            <!-- <a class="list-icons-item" data-action="remove"></a> -->
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="CreatePost">
                        <fieldset>
                            <div class="form-group">
                                <x-jet-label for="title" class="control-label" value="Title" />
                                <x-jet-input name="title" id="title" type="text" class="form-control" wire:model="title" autofocus placeholder="Short, descriptive title" />
                            </div>
                            <div class="form-group">
                                <x-jet-label for="detail" class="control-label" value="Detail" />
                                <textarea name="detail" id="detail" wire:model="detail" rows="4" class="form-control" autofocus placeholder="Tell us more about your feedback"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary mr-2">Clear</button>
                                @auth
                                <button type="submit" class="btn btn-primary">Create Post</button>
                                @else
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tabbed">Create Post</button>
                                @endif
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- /horizotal form -->

        </div>
        <div class="col-md-8">

            <!-- Vertical form -->
            <div class="card">
                <div class="card-header bg-light header-elements-inline">

                    <div class="card-title h6 btn-group">
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="search" wire:model="searchText" class="form-control wmin-200" placeholder="Search...">
                            <div class="form-control-feedback">
                                <i class="icon-search4 font-size-base text-muted"></i>
                            </div>
                        </div>

                        <!-- <h6 class="mr-2">Showing</h6> -->
                        <a href="#" class="btn btn-light ml-2 text-default dropdown-toggle font-weight-bold" data-toggle="dropdown">{{$this->status_display}}</a>
                        <div class="dropdown-menu">
                            <a href="#" wire:click.prevent="$emit('statusselected',-1)" class="dropdown-item">All</a>
                            @foreach($statuslist as $st)
                            <a href="#" wire:click.prevent="$emit('statusselected',{{$st->id}})" class="dropdown-item text-{{$st->status_color}}">{{$st->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="header-elements">
                        <a href="#" class="btn btn-light ml-2 text-default dropdown-toggle font-weight-bold" data-toggle="dropdown"><i class="icon-sort-amount-desc pr-2"></i>{{$this->sort_display}}</a>
                        <div class="dropdown-menu">
                            <a href="#" wire:click.prevent="$emit('SortPostsBy','created_at','desc','Latest First')" class="dropdown-item"><i class="icon-sort-time-desc"></i>Latest First</a>
                            <a href="#" wire:click.prevent="$emit('SortPostsBy','created_at','asc','Oldest First')" class="dropdown-item"><i class="icon-sort-time-asc"></i>Oldest First</a>
                            <a href="#" wire:click.prevent="$emit('SortPostsBy','v.totalvotes','desc','By Votes')" class="dropdown-item"><i class="icon-sort-numberic-desc"></i>Sort by Votes</a>
                            <a href="#" wire:click.prevent="$emit('SortPostsBy','posts.status_id','asc','By Status')" class="dropdown-item"><i class="icon-certificate"></i>Sort by Status</a>
                        </div>
                    </div>
                </div>

                <div class="card-body padding-0">
                    <div class="row">
                        @foreach($boardposts as $p)
                        <div class="col-12">
                            <div class="card border-left-3 border-left-{{$p->status_color}} rounded-left-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="d-flex justify-content-center flex-column bg-light border rounded p-0">
                                                @auth
                                                <a href="#" class="text-center  text-secondary" wire:click.prevent="$emit('UpVoted',{{$p->id}})"><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                                @else
                                                <a href="#" class="text-center  text-secondary"  data-toggle="modal" data-target="#modal-tabbed" ><i class="icon-arrow-up5 icon-2x p-0"></i></a>
                                                @endif
                                                <div class="bg-light pt-0 pb-2 px-2 rounded text-center">
                                                    {{$p->totalvotes}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                                <div>
                                                    <a href="{{route('showpost.public',$p->slug)}}" style="color:#333;">
                                                        <h6 class="mb-0">{{$p->title}}</h6>
                                                    </a>
                                                    <p class="mb-0"><span class="text-{{$p->status_color}} font-weight-bold">{{$p->status_title}}</span></p>
                                                    <p class="mb-0">{{\Illuminate\Support\Str::limit($p->detail, 80, $end='...')}}</p>
                                                </div>
                                                <ul class="list list-unstyled text-right mb-0 pt-3 mt-sm-0 ml-auto">
                                                    <li><span class="align-right-"><i class="mi-comment pr-1"></i></span>{{$p->totalcomments}}</li>
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
            <!-- /vertical form -->
        </div>

    </div>

</div>