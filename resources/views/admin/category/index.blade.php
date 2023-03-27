<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Category
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                {{-- @php($i = 1) --}}
                                @foreach ($categories as $category)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->category_name }}</td>
                                            {{-- <td>{{ $category->name }}</td> --}}
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if ($category->created_at == null)
                                                    <span class="text-danger">No Date Set</span>
                                                @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/edit/' . $category->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('softdelete/category/' . $category->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Category </div>
                        <div class="card-body">

                            <form action="{{ route('Store.Cat') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="category_name" type="text" class="form-control"
                                        id="exampleInputEmail1">

                                    @error('category_name')
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

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Trash Category List
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                {{-- @php($i = 1) --}}
                                @foreach ($trushCat as $category)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->category_name }}</td>
                                            {{-- <td>{{ $category->name }}</td> --}}
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if ($category->created_at == null)
                                                    <span class="text-danger">No Date Set</span>
                                                @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/restore/' . $category->id) }}"
                                                    class="btn btn-info">Restore</a>
                                                <a href="{{ url('Pdelete/category/' . $category->id) }}"
                                                    class="btn btn-danger"> P Delete</a>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $trushCat->links() }}
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>
