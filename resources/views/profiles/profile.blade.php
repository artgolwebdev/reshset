@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {{ $user->name }}'s profile
                    </div>
                    <div class="panel-body text-center">
                        <img src="{{ $user->avatar }}" width="200px" class="img">
                    </div>
                    @if(Auth::id() == $user->id)
                        <p class="text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info">Edit</a>
                        </p>
                    @endif
                </div>

                @if(Auth::user()->id != $user->id)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <friend :profile_user_id="{{ $user->id }}"></friend>
                    </div>
                </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        About me
                    </div>
                    <div class="panel-body">
                        {{ $user->profile->about }}
                    </div>
                    <div class="panel-footer">
                        {{ $user->profile->location }}
                    </div>
                </div>

                <user-friends :user_id="{{ $user->id }}"></user-friends>

            </div>
            <div class="col-md-8">
                <post :user_id="{{ $user->id }}"></post>
                <feed :user_id="{{ $user->id }}"></feed>
            </div>
        </div>
    </div>
@endsection