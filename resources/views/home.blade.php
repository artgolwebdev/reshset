@extends('layouts.app')

@section('content')
<div class="container">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Latest news</p>
                </div>
                <div class="panel-body">
                    <feed></feed>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
