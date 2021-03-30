<div class="card">
    <div class="card-header bg-white">
        <h6 class="card-title">
            {{ __('Create Category') }}
            <span class="font-size-base text-muted ml-2"> {{ __('Create a new category') }}</span>
        </h6>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="SaveCategory">
            <fieldset>
                @if ($success)
                <div class="alert alert-success border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $success }}</span>
                </div>
                @endif
                <div class="form-group">
                    <x-jet-label for="title" class="control-label" value="{{ __('Category Name') }}" />
                    <x-jet-input name="title" id="title" type="text" class="form-control" wire:model="title" autofocus />
                    <x-jet-label for="title" class="mt-2" />
                </div>
                <div class="form-group">
                    <x-jet-label for="category_color" class="control-label" value="{{ __('Category Color') }}" />
                    <select name="category_color" id="category_color" wire:model="category_color" class="form-control">
                        <option value="primary">primary</option>
                        <option value="danger">danger</option>
                        <option value="info">info</option>
                        <option value="violet">violet</option>
                        <option value="success">success</option>
                        <option value="teal">teal</option>
                    </select>
                    <label for="category_color" class="mt-2" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>