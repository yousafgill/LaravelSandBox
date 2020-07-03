@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <form method="POST" action="/employees/createsave">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="firstname" id="firstname" class='form-control'
                                    placeholder='First Name'>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="lastname" id="lastname" class='form-control'
                                    placeholder='Last Name'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" id="email" class='form-control'
                                    placeholder='Email Address'>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="phone" name="phone" id="phone" class='form-control'
                                    placeholder='Phone Number'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Save" class='btn btn-primary'>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection