@extends('layouts.main')
@section('title', 'Years')
@section('content')
<h3 style="text-align: center" class="mt-5 mb-2">Тут викладено архів суб'єктів туристичної діяльності за роками:</h3>

@if (!$years)
    <div>Мабуть, в базу даних забув загрузити!</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($years as $item)
    <a style="text-align: center" href="/years/{{$item->year}}"><div>{{$item->year}}</div></a>
@endforeach
@endif

@endsection