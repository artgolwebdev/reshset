@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <friends-location></friends-location>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <post></post>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <feed></feed>
        </div>
    </div>
</div>
@endsection
