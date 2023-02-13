@extends('layouts.main')
@section('title', 'All Companies')
@section('content')
<h3>Список всіх зареєстрованих підприємств:</h3>
@if (count($std)<1)
    <div>Хмм...Нічого не знайдено.</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($std as $el)
    <div class="data-container with-tags">
       <a href="{{ '/years' . '/' . $el->path}}"> <div>{{$el->name}}</div></a>
       <div>
        @foreach($el->tags as $elem)
        <span class="tags">{{$elem->title}}</span>
        @endforeach
     </div>
    </div>
@endforeach
<div>{{$std->links()}}</div>
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