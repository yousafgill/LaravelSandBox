<x-jet-action-section>
    <x-slot name="title">
        {{ __('Browser Sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and logout your active sessions on other browsers and devices.') }}
    </x-slot>

    <x-slot name="content">
        <div class="card">
            <div class="card-header bg-warning header-elements-inline">
                <h5 class="card-title">Browser Sessions</h5>
                <div class="header-elements">
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="card-title">
                    {{ __('If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
                </h6>

                @if (count($this->sessions) > 0)
                <div class="row">
                    <!-- Other Browser Sessions -->
                    @foreach ($this->sessions as $session)
                    <div class="col-md-3">
                        @if ($session->is_current_device)
                        <div class="card alpha-green">
                        @else
                        <div class="card alpha-warning">
                        @endif
                                <div class="card-body text-center">
                                    @if ($session->agent->isDesktop())
                                    <i class="icon-laptop icon-3x text-success-400 border-success-400 border-1 rounded p-3 mb-3 mt-1"></i>
                                    @else
                                    <i class="icon-mobile icon-3x text-success-400 border-success-400 border-1 rounded p-3 mb-3 mt-1"></i>
                                    @endif

                                    <h5 class="card-title">{{ $session->agent->platform() }} - {{ $session->agent->browser() }}</h5>
                                    <p class="mb-3">
                                        {{ $session->ip_address }},

                                        @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                        @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                        @endif
                                    </p>
                                    <!-- <a href="#" class="btn bg-success-400">Browse articles</a> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex items-center mt-5">
                        <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                            {{ __('Logout Other Browser Sessions') }}
                        </x-jet-button>

                        <x-jet-action-message class="ml-3" on="loggedOut">
                            {{ __('Done.') }}
                        </x-jet-action-message>
                    </div>

                    <!-- Logout Other Devices Confirmation Modal -->
                    <x-jet-dialog-modal wire:model="confirmingLogout">
                        <x-slot name="title">
                            {{ __('Logout Other Browser Sessions') }}
                        </x-slot>

                        <x-slot name="content">
                            {{ __('Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.') }}

                            <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                                <x-jet-input type="password" class="form-control" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                                <x-jet-input-error for="password" class="mt-2" />
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                                {{ __('Nevermind') }}
                            </x-jet-secondary-button>

                            <x-jet-button class="ml-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                                {{ __('Logout Other Browser Sessions') }}
                            </x-jet-button>
                        </x-slot>
                    </x-jet-dialog-modal>
                </div>
            </div>

    </x-slot>
</x-jet-action-section>