@extends('admin.admin_master')
@section('Contact_active', 'active')
@section('admin')


    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card card-default">

                        <div class="card-header card-header-border-bottom">
                            <h2>Basic Form Controls</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.contact') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Phone</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="Enter Phone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" name="address" rows="3"></textarea>
                                </div>
                                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
