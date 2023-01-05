@extends('layouts.main')
@section('title', $std)
@section('content')
<div class="mt-3 shadow-block">Документи підприємства {{$std}}:</div>
<div class="mt-3 shadow-block">Було зареєстровано в ДАРТ в  {{$year}} році</div>
@if (count($show_files)<1)
    <div>Мабуть, в базу даних щось забув загрузити! Чи ще немає файлів?!</div>
    <img src="/images/whatever.png" alt="whatever" class="mt-2">
@else
    @foreach ($show_files as $el)
    <div class="data-container">
       <div class="row mt-3 mb-1 row-file">
            <div class="col-5">{{$el->filename}}</div>
            <a href="{{route('std-download',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-success col-2 mr-2">Скачати</button></a>
            <a href="{{route('std-delete',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-danger col-2 mr-2">Видалити</button></a>
            <a href="{{route('view',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-info col-2">Подивитись</button></a>


            {{-- <a href="{{ route('companies.edit', ['company' => $company->id]) }}"
                class="btn btn-info btn-sm float-left mr-1">
                 <i class="fas fa-pencil-alt"></i>
             </a> --}}

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
       </div>
   @endif
    </div>
    </div>
@endforeach
@endif
<h3 class="mt-2">Додати нові документи:</h3>
<form class="sendform" action="{{route('std-update',['std'=>$std, 'year'=>$year])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Виберіть файл:</label>
        <input class="form-control" type="file" id="name" name="file" value="" placeholder="Виберіть файл">
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <a href="{{route('std-update',['std'=>$std, 'year'=>$year])}}"><button type="submit" class="btn btn-primary mt-3">Додати</button></a>
</form>
<form action="">
    <div class="row">
        <div class="col-md-6" data-select2-id="56">
            <div class="form-group" data-select2-id="55">
                <label>Назва</label>
                <input class="form-control " style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                    type="text" name="name"
                    placeholder="частина або повний номер">

            </div>



        </div>
        <button type="submit" class="btn btn-success col fileinput-button dz-clickable">Застосувати</button>
    </form>
@endsection