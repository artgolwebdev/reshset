@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row visible-xs">
        <div class="col-xs-12">
        <div class="navbar-form navbar-left">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                <i class="glyphicon glyphicon-search"></i>
                    </span>
                <search></search>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <friends-location></friends-location>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <post></post>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <feed></feed>
        </div>
    </div>
</div>
@endsection
