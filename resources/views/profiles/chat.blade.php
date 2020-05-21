@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <chat-app :user="{{ auth()->user()}}"></chat-app>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script>
        $(function(){
        $('#msgs-li').addClass('active');
    });
</script>
@endsection
