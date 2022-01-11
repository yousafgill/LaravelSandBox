<x-guest-layout>
    <!-- Login form -->
    <div class="card mb-0" style="min-width:350px;">

        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-lock2 icon-2x text-success border-success border-3 rounded-round p-1 mb-3 mt-1"></i>
                <h5 class="mb-0">Flowwup Sign in</h5>
            </div>
            <form class="login-form" form method="POST" action="{{ route('loginemail.store') }}">
                @csrf
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" :value="old('email')" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                </div>

                <!-- <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required autocomplete="current-password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div> -->


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Continue <i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </form>
            <div class="form-group text-center text-muted content-divider">
                <span class="px-2">Don't have an account?</span>
            </div>

            <div class="form-group">
                <a href="{{route('register')}}" class="btn btn-light btn-block">Sign up</a>
            </div>
        </div>

        <div class="card-body">
            <x-jet-validation-errors class="mb-4 text-danger" />
            @if (session('status'))
            <div class="row">
                <div class="col-12">
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- /login form -->
</x-guest-layout>