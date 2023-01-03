@extends('layouts.main')
@section('title', 'File Uploading')
@section('content')

  <div class="panel-body">
       
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif
  
    <form action="{{ route('file.store', ['std' => 8]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="inputFile">Вибрати й загрузити файл:</label>
            <input 
                type="file" 
                name="file" 
                id="inputFile"
                class="form-control @error('file, isexists') is-invalid @enderror">


                @error('file')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('isexists')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Загрузити</button>
        </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span>
                @endforeach
            @endif
    </form>
  </div>
  @endsection
  