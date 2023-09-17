@extends('user.layout.app')
@section('title')Profile @endsection
@section('contents')
    <div class="container-fluid mt-5 rounded bg-white py-3 px-3">
        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('update_profile') }}" >
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        @php($profile_image = Auth::user()->avatar)
                        <label for="profile_image" style="cursor: pointer">
                            <img class="rounded-circle mt-5" style="object-fit: cover" height="250" width="250" src="@if($profile_image == null) {{ asset("image/avatar.png") }} @else {{ asset("storage/$profile_image") }}  @endif" id="image_preview_container">
                        </label>
                        <span class="font-weight-bold">
                            <input type="file" name="profile_image" id="profile_image" class="form-control d-none">
                        </span>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="labels">First name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First name" value="{{ Auth::user()->first_name }}">
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Last name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{ Auth::user()->last_name }}">
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Email</label>
                                <input type="text" name="email" disabled class="form-control" value="{{ Auth::user()->email }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="labels">Old password</label>
                                <input type="password" name="old_password" class="form-control" placeholder="Old Password" >
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" >
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Confirm password</label>
                                <input type="password" name="confirm_password" class="form-control"  placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button id="profile_btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection