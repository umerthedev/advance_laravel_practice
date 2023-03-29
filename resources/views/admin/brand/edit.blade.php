<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Edit Brand
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header"> Edit Brand </div>
                        <div class="card-body">

                            <form action="{{ url('brands/update/' . $brands->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                <div class="mb-3">
                                    <label class="form-label">Brand Name</label>
                                    <input name="brand_name" type="text" class="form-control" id="exampleInputEmail1"
                                        value="{{ $brands->brand_name }}">

                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Brand Image</label>
                                    <input name="brand_image" type="file" class="form-control"
                                        id="exampleInputEmail1" value="{{ $brands->brand_image }}">

                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}"style="width: 200px; height:200px;">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary text-dark">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>
