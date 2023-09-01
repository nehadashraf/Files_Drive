@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <div class="card">
            <img src="{{ $drive->file }}" alt="" class="img-top-fluid ">
            <h1 class="text-center">File</h1>
            <div class="card-body">
                <h3>Title :{{ $drive->title }}</h3>
                <hr>
                <h3>Description : {{ $drive->description }}</h3>
            </div>
            <a href="{{ route('drive.download', $drive->id) }}" class="btn btn-success m">Download</a>

        </div>
    </div>
@endsection
