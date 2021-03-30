<x-jet-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="card">
            <div class="card-header bg-danger header-elements-inline">
                <h5 class="card-title">Delete Account</h5>
                <div class="header-elements">
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="max-w-xl text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </div>

                <div class="mt-5">
                    <x-jet-danger-button class="btn btn-danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                        {{ __('Delete Account') }}
                    </x-jet-danger-button>
                </div>

                <!-- Delete User Confirmation Modal -->
                <x-jet-dialog-modal wire:model="confirmingUserDeletion">
                    <x-slot name="title">
                        {{ __('Delete Account') }}
                    </x-slot>

                    <x-slot name="content">
                        {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                        <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                            <x-jet-input type="password" class="form-control" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />

                            <x-jet-input-error for="password" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                            {{ __('Nevermind') }}
                        </x-jet-secondary-button>

                        <button class="btn btn-danger" wire:click="deleteUser" wire:loading.attr="disabled">
                            {{ __('Delete Account') }}
                        </button>
                    </x-slot>
                </x-jet-dialog-modal>
            </div>
        </div>

    </x-slot>
</x-jet-action-section>