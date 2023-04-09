@extends('admin.admin_master')
@section('brand_active', 'active')
@section('admin')
    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid gap-2">
                        <a href="{{ route('add.contact') }}" class="d-grid gap-2">
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
                                        <th scope="col" class="text-center" style="width: 5%;">Sl No.</th>
                                        <th scope="col" class="text-center" style="width: 15%;"> Email</th>
                                        <th scope="col" class="text-center"style="width: 25%;"> Phone</th>
                                        <th scope="col" class="text-center"style="width: 25%;"> Address</th>
                                        <th scope="col" class="text-center"style="width: 15%;">Action</th>
                                    </tr>
                                </thead>

                                @php($i = 1)
                                @foreach ($contact as $row)
                                    <tbody>
                                        <tr>
                                            <th class="text-center" scope="row">{{ $i++ }}</th>
                                            <td class="text-center">{{ $row->email }}</td>
                                            <td class="text-center">{{ $row->phone }}</td>
                                            <td class="text-center">{{ $row->address }}</td>



                                            <td>
                                                <a href="{{ url('contact/edit/' . $row->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('contact/delete/' . $row->id) }}"
                                                    onclick="return confirm('Are you sure want to delete ?')"
                                                    class="btn btn-danger">Delete
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>


                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Soft Delete --}}



    </div>
@endsection
