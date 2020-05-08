@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <feed :post_id="{{ $postdata[0]['id'] }}"></feed>

        </div>
    </div>
</div>
@endsection
