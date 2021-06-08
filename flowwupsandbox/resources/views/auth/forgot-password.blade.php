<x-guest-layout>
    <form class="login-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="card mb-0" style="min-width:350px;max-width:450px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-exclamation icon-3x text-warning rounded-round p-1 mb-3 mt-1"></i>
                    <h5 class="mb-0">Reset Password</h5>
                    <span class="d-block text-muted">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</span>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Email Password Reset Link <i class="icon-circle-right2 ml-2"></i></button>
                </div>

            </div>
        </div>
    </form>
</x-guest-layout>