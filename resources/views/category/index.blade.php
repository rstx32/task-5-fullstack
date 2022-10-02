@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12 bg-white p-4">
            <a href="/user/categories/create"><button class="btn btn-primary mb-3">Create New Category</button></a>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if($categories->count()==0)
            <div class="alert alert-danger text-center" role="alert">
                There is no category available, you should create one!
            </div>
            @else
            <table class="table table-responsive table-bordered table-hover table-stripped">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">No.</th>
                        <th>Name</th>
                        <th width="5%" colspan="3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $i => $category)
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a href="/user/categories/{{ $category->id }}"><button class="btn btn-primary">Show</button></a>
                            </td>
                            <td>
                                <a href="/user/categories/{{ $category->id }}/edit"><button class="btn btn-success">Edit</button></a>
                            </td>
                            <td>
                                <form action="/user/categories/{{ $category->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Warning! this action will delete all of article!')" class="btn btn-danger deleteconfirm">Delete</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>

</div>
@endsection
