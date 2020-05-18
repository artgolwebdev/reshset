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
                            <a href="{{ url('/logout') }}" class="btn btn-lg btn-warning"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="glyphicon glyphicon-log-out"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </p>
                    @endif

                    <div class="panel-footer">
                        {{ $user->country_name }}
                    </div>
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
                        @if(!is_null($user->user_agent))
                        <?php 
                            $result = UA::parse($user->user_agent);
                        ?>
                         <p>{{$result->ua->family}},{{$result->os->family}}@if($result->device->family!='Other'),{{$result->device->family}}@endif</p>
                        @endif
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