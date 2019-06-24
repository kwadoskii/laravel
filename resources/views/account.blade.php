@extends('layouts.master')

@section('title')
    Account!
@endsection

@section('logout')
    @include('includes.logout-block')
@endsection

@section('content')
    <div class="col-md-7 offset-md-2">
        <header><h5>My Account</h5></header>
        <form action="{{ route('account.edit') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input class="form-control" type="text" name="first_name" id="first_name"
                       value="{{ $user->first_name }}">
            </div>
            <div class="form-group">
                <label for="image">Image (.jpg only)</label>
                <input class="form-control-file" type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>

    @if(Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-7 offset-md-2">
                <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}"
                     alt="My image" class="img-responsive" width="250px" height="250px">
            </div>
        </section>
    @endif
@endsection