@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>

                <div class="panel-body">
                   <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                   </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input required type="text" name="location" id="location" class="form-control" value="{{ $profile->location }}">
                    </div>
                    <div class="form-group">
                        <label for="about">About me</label>
                        <textarea required rows="5" class="form-control" id="about" name="about">{{ $profile->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <p class="text-center">
                            <button class="btn btn-lg btn-primary" type="submot">Save</button>
                        </p>
                    </div>
                    {{ csrf_field() }}    
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
