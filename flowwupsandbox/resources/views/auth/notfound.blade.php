<x-guest-layout>
    <!-- Login form -->
    <div class="card mb-0" style="min-width:550px; border-radius:10px">

        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-cross2 icon-2x text-danger border-danger border-3 rounded-round p-1 mb-3 mt-1"></i>
                <h5 class="mb-0">Flowwup Sign-in error</h5>
            </div>
            <div class="alert alert-danger border-0 text-center">
                <!-- <button type="button" class="close" data-dismiss="alert"><span>×</span></button> -->
                <span class="font-weight-semibold">Sorry !</span> We can't find this user in our system. <a href="#" class="alert-link"></a>.
            </div>
            <div class="form-group">
                <a href="{{route('loginemail')}}" class="btn btn-light btn-block">Go back</a>
            </div>
            <div class="form-group text-center text-muted content-divider">
                <span class="px-2">Don't have an account?</span>
            </div>

            <div class="form-group">
                <a href="{{route('register')}}" class="btn btn-light btn-block">Sign up</a>
            </div>
        </div>

        <div class="card-body border-0">
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