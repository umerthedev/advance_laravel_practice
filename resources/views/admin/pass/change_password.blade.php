@extends('admin.admin_master')
@section('Contact_active', 'active')
@section('admin')


    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card-body">
            <form class="form-pill" method="Post" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">Current Password</label>
                    <input type="password" name="oldpassword" id="current_password" class="form-control"
                        placeholder="Enter Current Password">
                    @error('oldpassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter New Password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-default">Save</button>

            </form>
        </div>
    </div>
@endsection
