@extends('admin.admin_master')
@section('Contact_active', 'active')
@section('admin')


    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All User Message

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Message</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    {{-- @php($i = 1) --}}
                                    @foreach ($messages as $msg)
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $messages->firstItem() + $loop->index }}</th>
                                                <td>{{ $msg->name }}</td>
                                                <td>{{ $msg->email }}</td>
                                                <td>{{ $msg->subject }}</td>
                                                <td>{{ $msg->message }}</td>
                                                < <td>

                                                    <a href="{{ url('msg/delete/' . $msg->id) }}"
                                                        class="btn btn-danger">Delete</a>

                                                    </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>




        </div>

    </div>


@endsection
