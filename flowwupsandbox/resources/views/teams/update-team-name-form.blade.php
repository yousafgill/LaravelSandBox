<x-jet-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <div class="card">
            <div class="card-header bg-light header-elements-inline">
                <h5 class="card-title">Team Owner
                    <span class="font-size-base text-muted ml-2">The team's name and owner information.</span>
                </h5>
                <div class="header-elements">
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Team Owner Information -->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img class="rounded mr-2 border-1 p-2 border-slate-300 shadow" height="128" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <h6 class="font-weight-semibold mb-0">{{ $team->owner->name }}</h6>
                            <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                            <div class="text-gray-700 text-sm">{{ $team->team_slug }}</div>
                        </div>
                        <div class="form-group">
                            <x-jet-label for="name" class="control-label" value="{{ __('Team Name') }}" />
                            <x-jet-input id="name" name="name" type="text" class="form-control" wire:model.defer="state.name" :disabled="! Gate::check('update', $team)" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <x-jet-label for="team_slug" class="control-label" value="{{ __('Domain Name') }}" />
                            <x-jet-input id="team_slug" name="team_slug" type="text" class="form-control" wire:model.defer="state.team_slug"  :disabled="! Gate::check('update', $team)" />
                            <x-jet-input-error for="team_slug" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <!-- <x-jet-label value="{{ __('Team Owner') }}" /> -->
                    <div class="flex items-center mt-2">
                        <div class="ml-4 leading-tight">
                        </div>
                    </div>
                </div>
                <!-- Team Name -->
                <div class="col-span-6 sm:col-span-4">

                </div>
            </div>
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save')}}
        </x-jet-button>
    </x-slot>
    @endif
</x-jet-form-section>