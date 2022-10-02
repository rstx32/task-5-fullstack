@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row"> 
        
            <div class="card col-md-9 col-sm-12 mb-5 bg-white p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content">{{$article->content}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                            <option selected value="{{$article->category->id}}">{{$article->category->name}}</option>
                            @foreach ($categories as $category)
                                @if($category->id!=$article->category->id)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Upload</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>
        
            <div class="card col-md-2 offset-md-1 col-sm-12 p-0 h-100">
                <div class="card-header text-center">
                    Action
                </div>
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                </div>
            </div>
            
        </div>
    </form>
</div>
@endsection
