<div class="card">
    <div class="card-header bg-white">
        <h6 class="card-title">
            {{ __('Create Board') }}
            <span class="font-size-base text-muted ml-2"> {{ __('Create a new board to collaborate with others on projects.') }}</span>
        </h6>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="submitForm">
            <fieldset>
                <x-jet-validation-errors class="mb-4 text-danger" />
                @if ($limitreached)
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">You have reached your limit</span>
                </div>
                @endif
                @if ($success)
                <div class="alert alert-success border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $success }}</span>
                </div>
                @endif
                <div class="form-group">
                    <x-jet-label for="name" class="control-label" value="{{ __('Board Name') }}" />
                    <x-jet-input name="name" id="name" type="text" class="form-control" wire:model.lazy="name" autofocus />
                    <x-jet-label for="name" class="mt-2" />
                </div>
                <div class="form-group">
                    <x-jet-label for="slug" class="control-label" value="{{ __('URL') }}" />
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">{{$teamurl}}</span>
                        </span>
                        <x-jet-input name="slug" id="slug" value="" type="text" class="form-control" wire:model.lazy="slug" autofocus />
                    </div>
                </div>
                <div class="form-group">
                    <x-jet-label for="accessType" class="control-label" value="{{ __('Visibility') }}" />
                    <select name="accessType" id="accessType" wire:model="accessType" class="form-control">
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                    </select>
                    <label for="accessType" class="mt-2" />
                </div>
                <div class="form-group text-right">
                    <a href="{{url('/dashboard/boards')}}" class="btn btn-secondary mr-2">Close</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>