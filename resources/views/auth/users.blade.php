@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h1 class="text-center text-info">All users</h1>
        @if (Session::has('done'))
            <div class="alert alert-success text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>

                    </tr>
                    @forelse ($users as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
