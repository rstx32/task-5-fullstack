@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-grid gap-2 col-md-4 mx-auto">
       Total Article : {{ $articles->count() }}
    </div>
    
    <hr>

    <div class="row"> 

        @foreach ($articles as $article)
        <div class="col-md-4 col-sm-12 mt-4">
            <div class="card">
                <img src="{{ asset('/images/'.$article->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$article->title}}
                    </h5>
                    <a href="/user/articles/{{$article->id}}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
