@extends('layouts.main')
@section('title', 'All Companies')
@section('content')
<div>Список всіх зареєстрованих підприємств:</div>
@if (count($std)<1)
    <div>Хмм...Нічого не знайдено.</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($std as $el)
    <div class="data-container">
       <a href="{{ '/years' . '/' . $el[1] . '/' . $el[0]}}"> <div>{{$el[0]}}</div></a>
    </div>
@endforeach
@endif

<form action="" class="mt-5">
    <div class="row">
        <div class="col-12 flex">
            <div class="form-group col-6" data-select2-id="55">
                <label>Знайти підприємство</label>
                <input class="form-control"  data-select2-id="1" tabindex="-1" aria-hidden="true"
                    type="text" name="name"
                    placeholder="частина або повна назва">
            </div>
            <button type="submit" class="btn btn-success col-2 mt-3 fileinput-button dz-clickable">Фільтрувати</button>
        </div>
       
    </form>
@endsection