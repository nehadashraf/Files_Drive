@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h1 class="text-center text-info">Upload File</h1>
        @if (Session::has('done'))
            <div class="alert alert-success text-center">
                {{ Session::get('done') }}
            </div>
        @endif
        <!-- Create Post Form -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('drive.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">File Title</label>
                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">File Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" value="{{ old('description') }}">
                        @error('description')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Your File</label>
                        <input type="file" class="form-control  @error('inputFile') is-invalid @enderror"
                            name="inputFile">
                        @error('inputFile')
                            <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Your File</label>
                        <input type="hidden" class="form-control  @error('inputFile') is-invalid @enderror"
                            name="inputFile" value="{{ Auth::user()->id }}">
                    </div>
                    <button class="btn btn-info mt-2">send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
