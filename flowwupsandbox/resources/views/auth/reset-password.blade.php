<x-guest-layout>
    <div class="card mb-0" style="min-width:350px;max-width:450px;">
        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-lock2 icon-3x text-warning rounded-round p-1 mb-3 mt-1"></i>
                <h5 class="mb-0">Reset Password</h5>
                <span class="d-block text-muted">type your new password</span>
            </div>
            <form class="login-form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="{{old('email', $request->email)}}" readonly="readonly" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" placeholder="password" id="password" name="password" value="" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" placeholder="confirm password" id="password_confirmation" name="password_confirmation" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password <i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <x-jet-validation-errors class="mb-4" />
        </div>
    </div>

</x-guest-layout>