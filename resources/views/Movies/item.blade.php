@extends("layouts.app")

@section('content')
    @if(isset($item))
        <p>Id: {{$item->id}}</p>
        <p>Title: {{$item->title}}</p>
        <p>Synopsis: {{$item->synopsis}}</p>
    @else
        <p>Movie doesnt exits yet!</p>
    @endif
@stop
