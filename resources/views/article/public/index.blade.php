@extends('layouts.app')

@section('content')
<div class="container">

    <hr>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{$message}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($articles->count()==0)
    <div class="alert alert-danger text-center" role="alert">
        There is no article available, you should create one!
    </div>
    @else
    <div class="row">
        @foreach ($articles as $article)
        <div class="col-md-4 col-sm-12 mt-4">
            <div class="card">
                <img src="{{ asset('/images/'.$article->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/articles/{{$article->id}}" class="text-decoration-none">{{$article->title}}</a>
                    </h5>
                    <p class="card-text">
                        category : <a href="/categories/{{$article->category->id}}" class="text-decoration-none">{{$article->category->name}}</a>
                    </p>
                    <a href="/articles/{{$article->id}}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
