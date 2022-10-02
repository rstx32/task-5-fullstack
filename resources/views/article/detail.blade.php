@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 

        <div class="card col-md-9 col-sm-12 mb-5 bg-white p-0">
            <img src="{{ asset('/images/'.$article->image) }}" class="card-img-top" alt="image article content" height="200px">
            <div class="card-body">
                <h3 class="card-title">{{$article->title}}</h3>
                <p class="card-text">Category : {{$article->category->name}}</p>
                <p class="card-text">Written by {{$article->user->name}}</p>
                <hr>
                <p class="card-text">{{$article->content}}</p>
                <div class="card-footer text-muted text-center bg-white">
                    <p class="card-text">
                        <small>posted on : {{$article->created_at}}</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="card col-md-2 offset-md-1 col-sm-12 p-0 h-100">
            <div class="card-header text-center">
                Action
            </div>
            <div class="card-body text-center">
                <form action="" method="POST">
                    <a href="/articles/{{$article->id}}/edit" class="btn btn-success">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger deleteconfirm">Delete</i></button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
