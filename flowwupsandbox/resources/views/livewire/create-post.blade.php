<div class="card">
    <div class="card-header bg-light header-elements-inline">
        <h6 class="card-title font-weight-semibold">Post</h6>
        <div class="header-elements">
            <ul class="list-inline list-inline-dotted text-muted mb-0">
                <li class="list-inline-item"></li>
                <li class="list-inline-item"></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <x-jet-validation-errors class="mb-4 text-danger" />
        @if ($boardcount==0)
        <div class="alert alert-danger border-0 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Please create a board before adding on a post. <a href="{{url('/dashboard/createboard')}}">Click Here</a> to create a board.</span>
        </div>
        @endif
        <form wire:submit.prevent="SavePost">
            <fieldset>
                <!-- @if(isset($success))
                <div class="alert alert-success border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $success }}</span>
                </div>
                @endif -->
                <div class="form-group">
                    <x-jet-label for="board_id" class="control-label" value="Board" />
                    <select name="board_id" id="board_id" wire:model="board_id" class="form-control">
                        @if(isset($boards))
                        @foreach($boards as $board)
                        <option value="{{$board->id}}">{{$board->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <x-jet-label for="title" class="control-label" value="Title" />
                    <x-jet-input name="title" id="title" type="text" class="form-control" wire:model="title" autofocus />
                </div>
                <div class="form-group">
                    <x-jet-label for="detail" class="control-label" value="Detail" />
                    <textarea name="detail" id="detail" wire:model="detail" rows="4" class="form-control" autofocus></textarea>
                </div>
                <div class="form-group text-right">
                    <a href="{{route('dashboard.posts',-1)}}" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>