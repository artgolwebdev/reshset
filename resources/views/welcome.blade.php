@extends('layouts.app')
<style>
    .footer{
        position: absolute;
        bottom: 10px;
        width: 100%;
    }
    @media (max-width:400px){
        .footer{
            position: relative;
        }
    }
</style>

@section('content')
<div class="container full-height">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Lorem ipsum <br class="hidden-md hidden-lg"><small id="element"></small></h1>
            </div>
        </div>
        <div class="col-md-6">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elit duis tristique sollicitudin nibh sit amet commodo. Mauris nunc congue nisi vitae suscipit. Ultrices vitae auctor eu augue ut lectus arcu bibendum. Nunc consequat interdum varius sit. Tortor at auctor urna nunc id cursus metus aliquam eleifend. Viverra aliquet eget sit amet tellus cras. Pulvinar proin gravida hendrerit lectus. Aenean pharetra magna ac placerat vestibulum. Sed odio morbi quis commodo odio.
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-center footer">
    {{ config('app.name', 'Laravel') }} {{ date('Y') }}
</footer>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/typeit@6.1.1/dist/typeit.min.js"></script>
<script>
new TypeIt("#element",{
    loop:true,
    speed: 350
})
.type("Lorem")
.pause(3500)
.delete(5)
.type("Ipsum")
.pause(3500)
.go();
</script>

@endsection
