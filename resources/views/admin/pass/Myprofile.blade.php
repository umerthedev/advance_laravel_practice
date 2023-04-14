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
            <form class="form-pill" method="Post" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group">
                    <img src="{{ asset($user->image) }}"style="width: 200px; height:200px;">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">User Image</label>
                    <input name="image" type="file" class="form-control" id="exampleInputEmail1"
                        value="{{ $user['image'] }}">

                    @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput3">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">User Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user['email'] }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-default">Save</button>

            </form>
        </div>
    </div>
@endsection
