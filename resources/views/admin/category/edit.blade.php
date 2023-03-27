<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            All Category
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
                        <div class="card-header"> Edit Category </div>
                        <div class="card-body">

                            <form action="{{ url('category/update/' . $categories->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="category_name" type="text" class="form-control"
                                        id="exampleInputEmail1" value="{{ $categories->category_name }}">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary text-dark">Update Categories</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>
