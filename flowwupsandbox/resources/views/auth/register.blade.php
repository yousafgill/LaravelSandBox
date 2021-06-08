<x-guest-layout>
    <form class="login-form" method="POST" action="{{ route('register') }}" x-data="{...init(), ...initV2()}">
        @csrf
        <div class="card mb-0" style="min-width:350px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-1 mb-3 mt-1"></i>
                    <h5 class="mb-0">Start your Free Trial</h5>
                    <span class="d-block text-muted">Free 30-day flowwup trial. No credit card required</span>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="name" class="form-control" type="text" name="name" required autofocus autocomplete="name" placeholder="full name" />
                    <div class="form-control-feedback">
                        <i class="icon-user-check text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    @if (app('request')->input('email'))
                    <input id="email" class="form-control" type="text" name="email" :value="{{ app('request')->input('email') }}" required autofocus autocomplete="email" readonly="readonly" placeholder="email" />
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                    @else
                    <input id="email" class="form-control" type="text" name="email" required autofocus autocomplete="email" placeholder="email" />
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                    @endif
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    @if (app('request')->input('team'))
                    <input id="teamname" class="form-control" type="text" name="teamname" :value="{{ app('request')->input('team') }}" required autofocus readonly="readonly" />
                    <div class="form-control-feedback">
                        <i class="icon-command text-muted"></i>
                    </div>
                    @else
                    <input class="form-control" id="teamname" x-model="company" x-on:change.prevent="setDomain($event.target.value)" type="text" name="teamname" required autofocus placeholder="company name" />
                    <div class="form-control-feedback">
                        <i class="icon-command text-muted"></i>
                    </div>
                    @endif
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    @if (app('request')->input('team'))
                    <div class="input-group">
                        <input type="text" class="form-control" id="team_slug" name="team_slug" required value="{{ app('request')->input('team') }}" readonly="readonly">
                        <span class="input-group-append">
                            <span class="input-group-text">.flowwup.com</span>
                        </span>
                    </div>
                    @else
                    <div class="input-group">
                        <input type="text" class="form-control" x-model="domain" id="team_slug" name="team_slug" required value="{{ app('request')->input('team') }}" placeholder="sub domain">
                        <span class="input-group-append">
                            <span class="input-group-text">.flowwup.com</span>
                        </span>
                    </div>
                    @endif
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" class="form-control" type="password" name="password" required autofocus autocomplete="new-password" placeholder="password" />
                    <div class="form-control-feedback">
                        <i class="icon-key text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autofocus autocomplete="new-password" placeholder="confirm password" />
                    <div class="form-control-feedback">
                        <i class="icon-key text-muted"></i>
                    </div>
                </div>

                @if (app('request')->input('invite'))
                <input id="invite" class="hidden" type="hidden" name="invite" value="{{ app('request')->input('invite') }}" required />
                @endif

                <div class="form-group" style="display:none;">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
                            Send me <a href="#">test account settings</a>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
                            Subscribe to monthly newsletter
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styled" data-fouc>
                            Accept <a href="#">terms of service</a>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn bg-teal-400 btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>

                <div class="form-group text-center text-muted content-divider mt-3">
                    <span class="px-2">Already have an account?</span>
                </div>
                <a href="{{route('login')}}" class="btn btn-light btn-block">Sign in</a>
            </div>
        </div>
    </form>
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