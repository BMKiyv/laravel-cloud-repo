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
       <div class="row-file">
            <div class="col-5">{{$el->filename}}</div>
            <a href="{{route('std.download',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-success col-2 mr-2">Скачати</button></a>
            <a href="{{route('std.delete',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-danger col-2 mr-2">Видалити</button></a>
            <a href="{{route('view',['std'=>$std,'year'=>$year,'name'=>$el->filename])}}" style="display: contents;"><button class="btn btn-info col-2">Подивитись</button></a>
    </div>
    </div>
@endforeach
<div>{{$show_files->links()}}</div>
@endif
<h3 class="mt-5">Додати нові документи:</h3>
<form class="sendform" action="{{route('std.update',['std'=>$std, 'year'=>$year])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-6">
        <label for="name">Виберіть файл:</label>
        <input class="@error('name') is-invalid @enderror @error('file') is-invalid @enderror form-control" type="file" id="name" name="file" value="" placeholder="Виберіть файл">
    </div>
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
@endif
    <a href="{{route('std.update',['std'=>$std, 'year'=>$year])}}"><button type="submit" class="btn btn-primary mt-3">Додати</button></a>
</form>
<div class="mt-5">
<form action="">
    <div class="row">
        <div class="col-12 flex" data-select2-id="56">
            <div class="form-group col-6" data-select2-id="55">
                <label>Знайти необхідний файл</label>
                <input class="form-control"  data-select2-id="1" tabindex="-1" aria-hidden="true"
                    type="text" name="name"
                    placeholder="частина або повна назва">
            </div>
            <button type="submit" class="btn mt-3 btn-secondary">Фільтрувати</button>
        </div>
       
    </form>
    <div style="width: 100%; height: 300px;"><?php
   //  $file = fopen('http://localhost:8000/storage/2016/[sobi complex]/Plan-realization-cyber-strategy.pdf','r'); 
    // dump($file);
    // while(!feof($file)){
    //   echo  fgets($file).'<br>';
    // } 
    // fclose($file);
    ?></div>
</div>
@endsection