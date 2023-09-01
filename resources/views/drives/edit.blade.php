@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h1 class="text-center text-info">Edit File</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('drive.update', $drive->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">File Title</label>
                        <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title"
                            value="{{ $drive->title }}">
                        @error('title')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">File Description</label>
                        <input type="text" class="form-control  @error('description') is-invalid @enderror"
                            name="description" value="{{ $drive->description }}">
                        @error('description')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Your File : {{ $drive->file }}</label>
                        <input type="file" class="form-control  @error('inputFile') is-invalid @enderror"
                            name="inputFile">
                        @error('inputFile')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <button class="btn btn-warning mt-2">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
