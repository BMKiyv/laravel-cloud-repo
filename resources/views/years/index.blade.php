@extends('layouts.main')
@section('title', 'Years')
@section('content')
<div>Here a list of years:</div>
@if (!$years)
    <div>Мабуть, в базу даних забув загрузити!</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($years as $item)
    <a href="/years/{{$item->year}}"><div>{{$item->year}}</div></a>
@endforeach
@endif

@endsection