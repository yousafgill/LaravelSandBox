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
                    <ul>
                        @foreach($employees as $emp)
                        <li>{{$emp->firstname}} {{$emp->lastname}}</li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/employees/create') }}">New</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection