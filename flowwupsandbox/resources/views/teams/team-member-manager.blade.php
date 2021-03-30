<div>
    @if (Gate::check('addTeamMember', $team))
    <x-jet-section-border />
    <!-- Add Team Member -->
    <div class="mt-10 sm:mt-0">
        <x-jet-form-section submit="addTeamMember">
            <x-slot name="title">
                {{ __('Add Team Member') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Add a new team member to your team, allowing them to collaborate with you.') }}
            </x-slot>

            <x-slot name="form">
                <div class="card">
                    <div class="card-header bg-light header-elements-inline">
                        <h5 class="card-title">Add Team Member
                            <span class="font-size-base text-muted ml-2">Add a new team member to your team, allowing them to collaborate with you.</span>
                        </h5>
                        <div class="header-elements">
                            <div class="list-icons">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-span-6">
                            <div class="max-w-xl text-sm text-gray-600">
                                {{ __('Please provide the email address of the person you would like to add to this team. The email address must be associated with an existing account.') }}
                            </div>
                        </div>
                        <!-- Member Email -->
                        <div class="form-group">
                            <x-jet-label for="email" class="control-label" value="{{ __('Email') }}" />
                            <x-jet-input id="name" type="text" class="form-control" wire:model.defer="addTeamMemberForm.email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>

                        <!-- Role -->
                        @if (count($this->roles) > 0)
                        <div class="form-group">
                            <x-jet-label for="role" value="{{ __('Role') }}" />
                            <x-jet-input-error for="role" class="mt-2" />
                            <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                                @foreach ($this->roles as $index => $role)
                                <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}" wire:click="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                    <div class="{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                        <!-- Role Name -->
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-600 {{ $addTeamMemberForm['role'] == $role->key ? 'font-semibold' : '' }}">
                                                {{ $role->name }}
                                            </div>

                                            @if ($addTeamMemberForm['role'] == $role->key)
                                            <svg width="24" height="24" class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @endif
                                        </div>

                                        <!-- Role Description -->
                                        <div class="mt-2 text-xs text-gray-600">
                                            {{ $role->description }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Added.') }}
                </x-jet-action-message>
                <x-jet-button>
                    {{ __('Add') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
    @endif

    @if ($team->users->isNotEmpty())
    <x-jet-section-border />
    <!-- Manage Team Members -->
    <div class="mt-10 sm:mt-0">
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Team Members') }}
            </x-slot>
            <x-slot name="description">
                {{ __('All of the people that are part of this team.') }}
            </x-slot>
            <!-- Team Member List -->
            <x-slot name="content">
                <div class="card">
                    <div class="card-header bg-light header-elements-inline">
                        <h5 class="card-title">Team Members
                            <span class="font-size-base text-muted ml-2">All of the people that are part of this team.</span>
                        </h5>
                        <div class="header-elements">
                            <div class="list-icons">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($team->users->sortBy('name') as $user)
                            <div class="col-sm-6 col-md-2">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid pb-1" src="{{ $user->profile_photo_url }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="font-weight-semibold mb-2">{{ $user->name }}</h6>
                                    <!-- <span class="d-block text-muted">UX/UI designer</span> -->
                                    <div class="flex items-center">
                                        <!-- Manage Team Member Role -->
                                        @if (Gate::check('addTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                        <button class="btn btn-primary" wire:click="manageRole('{{ $user->id }}')">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </button>
                                        @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                        <div class="ml-2 text-sm text-gray-400">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </div>
                                        @endif

                                        <!-- Leave Team -->
                                        @if ($this->user->id === $user->id)
                                        <button class="btn btn-warning" wire:click="$toggle('confirmingLeavingTeam')">
                                            {{ __('Leave') }}
                                        </button>

                                        <!-- Remove Team Member -->
                                        @elseif (Gate::check('removeTeamMember', $team))
                                        <button class="btn btn-danger" wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                                            {{ __('Remove') }}
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-jet-action-section>
    </div>
    @endif

    <!-- Role Management Modal -->
    <x-jet-dialog-modal wire:model="currentlyManagingRole">
        <x-slot name="title">
            {{ __('Manage Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="card">
                <div class="card-header bg-light header-elements-inline">
                    <h5 class="card-title">Manage Roles
                        <span class="font-size-base text-muted ml-2">Manage Role of the team member</span>
                    </h5>
                    <div class="header-elements">
                        <div class="list-icons">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                        @foreach ($this->roles as $index => $role)
                        <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}" wire:click="$set('currentRole', '{{ $role->key }}')">
                            <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                                <!-- Role Name -->
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-600 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                        {{ $role->name }}
                                    </div>

                                    @if ($currentRole == $role->key)
                                    <svg class="ml-2 h-5 w-5 text-green-400" height="24" width="24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </div>

                                <!-- Role Description -->
                                <div class="mt-2 text-xs text-gray-600">
                                    {{ $role->description }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Leave Team Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingLeavingTeam">
        <x-slot name="title">
            {{ __('Leave Team') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to leave this team?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="btn btn-danger mr-3 ml-2" wire:click="leaveTeam" wire:loading.attr="disabled">
                {{ __('Leave') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <!-- Remove Team Member Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingTeamMemberRemoval">
        <x-slot name="title">
            {{ __('Remove Team Member') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to remove this person from the team?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="btn btn-secondary" wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="btn btn-danger" wire:click="removeTeamMember" wire:loading.attr="disabled">
                {{ __('Remove') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>