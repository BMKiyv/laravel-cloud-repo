@extends('layouts.main')
@section('title', 'Year ' . $year[0]->year)
@section('content')
<div>Підприємства зареєстровані в {{$year[0]->year}}:</div>
@if (!$std)
    <div>Мабуть, в базу даних щось забув загрузити! Чи ще немає підприємств?!</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($std as $el)
    <div class="data-container">
       <a href="{{ '/years' . '/' . $year[0]->year . '/' . $el->name}}"> <div>{{$el->name}}</div></a>
    </div>
@endforeach
@endif
<h3>Створити нове зареєстроване підрпиємство</h3>
<form class="sendform" action="{{route('years-update',$year[0]->year)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Назва папки</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Введіть назву папки">
    </div>
    <a href="{{route('years-update',$year[0]->year)}}"><button type="submit" class="btn btn-primary mt-3">Створити</button></a>
    {{-- <a href="{{route('formdata-update',$data->id)}}"><button type="submit" class="btn btn-primary mt-3">Редагувати</button></a> --}}
</form>
@endsection