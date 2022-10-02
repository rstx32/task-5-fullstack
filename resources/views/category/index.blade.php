@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12 bg-white p-4">
            <a href="/categories/create"><button class="btn btn-primary mb-3">Create New Category</button></a>
            <table class="table table-responsive table-bordered table-hover table-stripped">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No.</th>
                        <th>Name</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $i => $category)
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a href="/categories/{{ $category->id }}"><button class="btn btn-primary">Show</button></a>
                                <a href="/categories/{{ $category->id }}/edit"><button class="btn btn-success">Edit</button></a>
                                <form action="/categories/{{ $category->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Warning! this action will delete all of article!')" class="btn btn-danger deleteconfirm">Delete</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
