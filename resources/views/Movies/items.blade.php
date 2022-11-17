@extends("layouts.app")

@section('content')
    @if(count((array)$movies) > 0)
            @foreach($movies as $movie)
                <p>Id: {{$movie->id}}</p>
                <p>Title: {{$movie->title}}</p>
                <p>Synopsis: {{$movie->synopsis}}</p>
                <a href="{{route('item', $movie->id)}}">Details</a>
            @endforeach
        @else
        <p>Movies doesnt exits yet!</p>
    @endif
@stop
