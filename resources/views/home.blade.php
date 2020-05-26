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
            <div class="page-header">
            <h1>Feed <small>Latest news</small></h1>
            </div>
            <feed></feed>
        </div>
    </div>
</div>
@endsection
