@extends('layouts.main')
@section('title', 'Years')
@section('content')
<div>Here a list of years:</div>
@foreach ($years as $item)
    <div>{{$item->year}}</div>
@endforeach
@endsection