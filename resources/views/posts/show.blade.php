@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-light">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}"> 
    <br><br>
    <div>
        {!!$post->body!!} <!-- when two curly braces was used, it didn't pass the html format from using ckeditor. the solution is this <- -->
    </div>
    <hr>
    <small> Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    <!-- prevents guest from seeing the edit and delete button and also makes sure that only a user that creates a post can see the edit and delete button -->
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
            
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}} 
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection