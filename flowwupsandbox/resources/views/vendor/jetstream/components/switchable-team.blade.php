@props(['team', 'component' => 'jet-dropdown-link'])

<form method="POST" class="p-0 m-0" action="{{ route('current-team.update') }}">
    @method('PUT')
    @csrf
    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">
    <!-- <x-dynamic-component :component="$component" > -->
            <a href="#"  onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item py-2">
            {{ $team->name }}
            @if (Auth::user()->isCurrentTeam($team))
                <span class="badge badge-pill bg-light ml-auto">
                    <i class="icon-checkmark4 text-primary"></i>
                </span>
                
            @endif
            
            </a>
    <!-- </x-dynamic-component> -->
</form>
