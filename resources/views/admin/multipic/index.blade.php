@extends('admin.admin_master')

@section('admin')
    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Category
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                {{-- @php($i = 1) --}}
                                @foreach ($images as $brand)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $images->firstItem() + $loop->index }}</th>

                                            {{-- <td>{{ $category->name }}</td> --}}
                                            <td><img src="{{ asset($brand->image) }}" style="height:40px; width:70px;">
                                            </td>
                                            <td>
                                                @if ($brand->created_at == null)
                                                    <span class="text-danger">No Date Set</span>
                                                @else
                                                    {{ $brand->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('brand/edit/' . $brand->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('brand/delete/' . $brand->id) }}"
                                                    onclick="return confirm('Are you sure want to delete ?')"
                                                    class="btn btn-danger">Delete</a>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $images->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Image </div>
                        <div class="card-body">

                            <form action="{{ route('multipic.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label"> Brand Image</label>
                                    <input name="image[]" type="file" class="form-control" multiple="">

                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary text-dark">Add</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Soft Delete --}}



    </div>
@endsection
