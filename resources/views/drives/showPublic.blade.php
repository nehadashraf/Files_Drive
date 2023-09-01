@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <div class="card">
            <img src="{{ asset('img/download (1).png') }}" alt="" class="img-top-fluid ">
            <h1 class="text-center">Show File</h1>
            <div class="card-body">
                <h3>Title :{{ $drive->driveTitle }}</h3>
                <hr>
                <h3>Description : {{ $drive->driveDescription }}</h3>
                <hr>
                <h3>File : {{ $drive->file }}</h3>
                <hr>
                <h3>Auther : {{ $drive->userName }}</h3>
            </div>
            <a href="{{ route('drive.download', $drive->driveId) }}" class="btn btn-success m">Download</a>

        </div>
    </div>
@endsection
