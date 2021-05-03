<x-jet-form-section submit="UpdateCompany">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <div class="card">
            <div class="card-header bg-light header-elements-inline">
                <h5 class="card-title">Domain Name
                    <span class="font-size-base text-muted ml-2">Change Name of domain</span>
                </h5>
                <div class="header-elements">
                    <div class="list-icons">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Team Owner Information -->
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                        <x-jet-label for="team_slug" class="control-label" value="{{ __('Domain Name') }}" />
                            <x-jet-input id="team_slug" name="team_slug" type="text" class="form-control" wire:model.defer="team_slug"   />
                            <x-jet-input-error for="team_slug" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
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

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>