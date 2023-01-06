@extends('layouts.main')
@section('title', 'Year ' . $year)
@section('content')
<div>Підприємства зареєстровані в {{$year}}:</div>
@if (count($std)<1)
    <div>Мабуть, в базу даних щось забув загрузити! Чи ще немає підприємств?!</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($std as $el)
    <div class="data-container">
       <a href="{{ '/years' . '/' . $year . '/' . $el->name}}"> <div>{{$el->name}}</div></a>
    </div>
@endforeach
@endif
<h3>Створити нове зареєстроване підрпиємство</h3>
<form class="sendform" action="{{route('years.store',$year)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Назва папки</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Введіть назву папки">
    </div>
    <a href="{{route('years.store',$year)}}"><button type="submit" class="btn btn-primary mt-3">Створити</button></a>
    {{-- <a href="{{route('formdata-update',$data->id)}}"><button type="submit" class="btn btn-primary mt-3">Редагувати</button></a> --}}
</form>
<form action="" class="mt-5">
    <div class="row">
        <div class="col-12 flex" data-select2-id="56">
            <div class="form-group col-6" data-select2-id="55">
                <label>Знайти підприємство, зареєстроване цього року</label>
                <input class="form-control"  data-select2-id="1" tabindex="-1" aria-hidden="true"
                    type="text" name="name"
                    placeholder="частина або повна назва">
            </div>
            <button type="submit" class="btn btn-success col-2 mt-3 fileinput-button dz-clickable">Фільтрувати</button>
        </div>
       
    </form>
@endsection