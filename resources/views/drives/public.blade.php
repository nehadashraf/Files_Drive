@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h1 class="text-center text-info">Files</h1>
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
                        <th>Title</th>
                        <th colspan="3">Action</th>
                    </tr>
                    @forelse ($drives as $data)
                        <tr>
                            <td>{{ $data->driveId }}</td>
                            <td>{{ $data->driveTitle }}</td>
                            <td> <a class="m-1" href="{{ route('drive.showPublic', $data->driveId) }}"><i
                                        class="fa-solid fa-eye"style="color: #ee9d11;"></i></a></td>
                        </tr>
                    @empty
                        <h1>NO DATA</h1>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
