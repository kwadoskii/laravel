@extends('layouts.master')

@section('title')
    Story!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6">
            <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="post">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" type="text"
                           name="firstname" value="{{ Request::old('firstname') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                           name="email" value="{{ Request::old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                           name="password" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn btn-success" name="button">Sign Up</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>

        </div>

        <div class="col-md-6">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="post">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                           value="">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                           name="password" value="">
                </div>
                <button type="submit" class="btn btn-success" name="button">Sign In</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>

        </div>
    </div>
@endsection
