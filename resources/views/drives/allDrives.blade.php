@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h1 class="text-center text-info">All Files</h1>
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
                        <th>title</th>
                        <th colspan="4">Action</th>
                    </tr>
                    @forelse ($drives as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->title }}</td>
                            <td><a class="m-1" href="{{ route('drive.destroy', $data->id) }}"><i class="fa-solid fa-trash"
                                        style="color: #f50000;"></i></a></td>
                            <td> <a class="m-1" href="{{ route('drive.show', $data->id) }}"><i class="fa-solid fa-eye"
                                        style="color: #ee9d11;"></i></a></td>
                            <td><a class="m-1" href="{{ route('drive.edit', $data->id) }}"><i
                                        class="fa-solid fa-pen-to-square"style="color: #0054e6;"></i></a></td>
                            <td><a class="m-1" href="{{ route('drive.changeStatus', $data->id) }}">
                                    @if ($data->status == 'private')
                                        <i class="fa-solid fa-lock " style="color: #02e866;"></i>
                                    @else
                                        <i class="fa-solid fa-lock-open" style="color: #e80202;"></i>
                                    @endif
                                </a></td>
                        </tr>
                    @empty
                        <h1>NO DATA</h1>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
