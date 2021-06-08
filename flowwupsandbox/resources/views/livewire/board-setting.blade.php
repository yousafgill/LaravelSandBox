<div class="card">
    <div class="card-header bg-light header-elements-inline">
        <h5 class="card-title">Board Settings</h5>
        <div class="header-elements">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item"><a href="{{url('/dashboard/boards')}}" class="nav-link active"><i class="icon-stack-up mr-2"></i> Back to feedback board</a></li>
            </ul>
            <div class="list-icons">
                <!-- <a class="list-icons-item" data-action="collapse"></a> -->
                <!-- <a class="list-icons-item" data-action="reload"></a> -->
                <!-- <a class="list-icons-item" data-action="remove"></a> -->
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-md-flex">
            <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-300 mb-md-0 border-bottom-0">
                <!-- <ul class="nav nav-pills flex-column mr-lg-3 wmin-lg-250 mb-lg-0  "> -->
                <li class="nav-item"><a href="#tab-appearance" class="nav-link active" data-toggle="tab"><i class="icon-browser mr-2"></i> Appearance</a></li>
                <!-- <li class="nav-item"><a href="#tab-behaviour" class="nav-link" data-toggle="tab"><i class="icon-rocket mr-2"></i> Behaviour</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-board-url" class="nav-link" data-toggle="tab"><i class="icon-link mr-2"></i> Board URL</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-moderation" class="nav-link" data-toggle="tab"><i class="icon-checkbox-checked mr-2"></i> Moderation</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-statuses" class="nav-link" data-toggle="tab"><i class="icon-touch mr-2"></i> Statuses</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-tags" class="nav-link" data-toggle="tab"><i class="icon-price-tags mr-2"></i> Tags</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-integrations" class="nav-link" data-toggle="tab"><i class="icon-share4 mr-2"></i> Integrations</a></li> -->
                <!-- <li class="nav-item"><a href="#tab-permissions" class="nav-link" data-toggle="tab"><i class="icon-user-lock mr-2"></i> Access & Permissions</a></li> -->
                
            </ul>

            <div class="tab-content tab-content-full">
                <div class="tab-pane fade active show" id="tab-appearance">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form" wire:submit.prevent="UpdateBoardAppearance">
                                <fieldset>
                                    <div class="form-group">
                                        <x-jet-label for="name" class="control-label" value="{{ __('Board Name') }}" />
                                        <x-jet-input name="name" id="name" type="text" class="form-control" wire:model="name" autofocus1 />
                                        <x-jet-label for="name" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <x-jet-label for="slug" class="control-label" value="{{ __('URL') }}" />
                                        <x-jet-input name="slug" id="slug" value="" type="text" class="form-control" wire:model.lazy="slug" autofocus />
                                        <x-jet-label for="slug" class="mt-2" />
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
                                        <button type="button" wire:click.prevent="$emit('DeleteBoard')" class="btn btn-danger">Delete</button>
                                        <a href="{{url('/dashboard/boards')}}" class="btn btn-secondary mr-2">Close</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-behaviour">
                    This is <code>Behaviour</code> Tab.
                </div>

                <div class="tab-pane fade" id="tab-board-url">
                    This is <code>Board URL</code> Tab.
                </div>

                <div class="tab-pane fade" id="tab-moderation">
                    This is <code>Moderation</code> Tab.
                </div>
                <div class="tab-pane fade" id="tab-statuses">
                    This is <code>Statuses</code> Tab.
                </div>
                <div class="tab-pane fade" id="tab-tags">
                    This is <code>Tags</code> Tab.
                </div>
                <div class="tab-pane fade" id="tab-integrations">
                    This is <code>Integrations</code> Tab.
                </div>
                <div class="tab-pane fade" id="tab-permissions">
                    This is <code>Permissions</code> Tab.
                </div>
            </div>
        </div>
    </div>


</div>