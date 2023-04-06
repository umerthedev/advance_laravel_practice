@extends('admin.admin_master')
@section('brand_active', 'active')
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
                            <form action="{{ url('update/slider' . $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Titles</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title"
                                        value="{{ $slider->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Titles Description</label>
                                    <textarea class="form-control" name="description" rows="3" value="{{ $slider->description }}">{{ $slider->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Example file input</label>
                                    <input type="file" class="form-control-file" name="image">
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($slider->image) }}"style="width: 200px; height:200px;">
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
