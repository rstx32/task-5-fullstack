@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 

        <div class="card col-md-9 col-sm-12 mb-5 bg-white p-0">
            <img src="{{ asset('/images/'.$article->image) }}" class="card-img-top" alt="image article content" height="200px">
            <div class="card-body">
                <h3 class="card-title">{{$article->title}}</h3>
                <p class="card-text">
                    category : <a href="/categories/{{$article->category->id}}" class="text-decoration-none">{{$article->category->name}}</a>
                </p>
                <p class="card-text">written by {{$article->user->name}}</p>
                <hr>
                <p class="card-text">{{$article->content}}</p>
                <div class="card-footer text-muted text-center bg-white">
                    <p class="card-text">
                        <small>posted on : {{$article->created_at}}</small>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
