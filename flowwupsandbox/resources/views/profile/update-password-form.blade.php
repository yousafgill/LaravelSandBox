<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">

        <div class="card border-0">
            <div class="card-header bg-light header-elements-inline">
                <h5 class="card-title">Update Password</h5>
                <div class="header-elements">
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-jet-label for="current_password" class="control-label" value="{{ __('Current Password') }}" />
                            <x-jet-input id="current_password" type="password" class="form-control" wire:model.defer="state.current_password" autocomplete="current-password" />
                            <x-jet-input-error for="current_password" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-jet-label for="password" class="control-label" value="{{ __('New Password') }}" />
                            <x-jet-input id="password" type="password" class="form-control" wire:model.defer="state.password" autocomplete="new-password" />
                            <x-jet-input-error for="password" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-jet-label for="password_confirmation" class="control-label" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" type="password" class="form-control" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                            <x-jet-input-error for="password_confirmation" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>