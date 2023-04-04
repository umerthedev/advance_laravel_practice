@extends('admin.admin_master')
@section('brand_active', 'active')
@section('admin')
    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid gap-2">
                        <a href="{{ route('add.slider') }}" class="d-grid gap-2">
                            <button class="btn btn-info" type="button">Add Slider</button></a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Slider
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Sl No.</th>
                                        <th scope="col" class="text-center"> Title</th>
                                        <th scope="col" class="text-center"> Description</th>
                                        <th scope="col" class="text-center"> Images</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>

                                {{-- @php($i = 1) --}}
                                @foreach ($slider as $row)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $slider->firstItem() + $loop->index }}</th>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->description }}</td>

                                            <td><img src="{{ asset($row->image) }}" style="height:40px; width:70px;"></td>

                                            <td>
                                                <a href="{{ url('slider/edit/' . $row->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('slider/delete/' . $row->id) }}"
                                                    onclick="return confirm('Are you sure want to delete ?')"
                                                    class="btn btn-danger">Delete</a>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $slider->links() }}

                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Soft Delete --}}



    </div>
@endsection
