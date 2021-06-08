<x-guest-layout>
    <!-- Login form -->
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <form class="login-form" form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card mb-0" style="min-width:350px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-lock2 icon-2x text-success border-success border-3 rounded-round p-1 mb-3 mt-1"></i>
                    <h5 class="mb-0">Flowwup Sign in</h5>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required autocomplete="current-password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center">
                    <div class="form-check mb-0">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-input-styleds" data-foucs>
                            Remember
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                </div>

                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2">Don't have an account?</span>
                </div>

                <div class="form-group">
                    <a href="{{route('register')}}" class="btn btn-light btn-block">Sign up</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /login form -->
</x-guest-layout>