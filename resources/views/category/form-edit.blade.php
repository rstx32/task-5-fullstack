@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('categories.update', $categories->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row"> 
        
        <div class="card col-sm-12 mb-5 bg-white p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">New Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $categories->name }}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
            
        </div>
    </form>
</div>
@endsection
