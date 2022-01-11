<div class="d-md-flex align-items-md-start">


    <!-- Right content -->
    <div class="w-100">
        <!-- BEGIN: Post Detail-->
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>

        <x-jet-section-border />
        @endif
        <!-- END: Post Detail -->
    </div>
    <!-- /right content -->
</div>