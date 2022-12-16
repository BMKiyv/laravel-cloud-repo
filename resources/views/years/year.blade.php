@extends('layouts.main')
@section('title', 'Year ' . $year[0]->year)
@section('content')
<div>Here a photos of of year {{$year[0]->year}}:</div>
@if (!$photo)
    <div>Мабуть, в базу даних щось забув загрузити!</div>
    <img src="/images/whatever.png" alt="whatever">
@else
    @foreach ($photo as $el)
    <img src="{{$el->src}}" alt="{{$el->src}}">
@endforeach
@endif

@endsection