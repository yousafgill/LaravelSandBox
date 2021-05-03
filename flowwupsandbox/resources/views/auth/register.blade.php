<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}" x-data="{...init(), ...initV2()}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Full Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                @if (app('request')->input('email'))
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required value="{{ app('request')->input('email') }}" readonly="readonly" />
                @else
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="teamname" value="{{ __('Company/App Name') }}" />
                @if (app('request')->input('team'))
                <x-jet-input id="teamname" class="block mt-1 w-full" type="text" name="teamname" required value="{{ app('request')->input('team') }}" readonly="readonly" />
                @else
                <x-jet-input id="teamname" x-model="company" x-on:change.prevent="setDomain($event.target.value)" class="block mt-1 w-full" type="text" name="teamname" required />
                @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="team_slug" value="{{ __('Subdomain') }}" />
                @if (app('request')->input('team'))
                <x-jet-input id="team_slug" class="block mt-1 w-full" type="text" name="team_slug" required value="{{ app('request')->input('team') }}" readonly="readonly" />
                @else
                
                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                    <x-jet-input type="text" id="team_slug" x-model="domain"  name="team_slug" required class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative" placeholder="subdomain"/>
                    <!-- <x-jet-input id="team_slug" x-model="domain" class="block mt-1 w-full" type="text" name="team_slug" required readonly="readonly" /> -->
                    <div class="flex -mr-px">
                        <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">.flowwup.com</span>
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (app('request')->input('invite'))
            <x-jet-input id="invite" class="hidden" type="hidden" name="invite" value="{{ app('request')->input('invite') }}" required />
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<script>
function init() {
    return {
        domain: "",
        setDomain: function(name) {
            this.domain = name.toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/&/g, '-and-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/\_\_+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        },
    };

}

function initV2() {
    return {
        company: "",
        setCompany: function(name) {
            this.company = name;
        },
    };

}
</script>