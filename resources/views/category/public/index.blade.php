@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12 bg-white p-4">
            <table class="table table-responsive table-bordered table-hover table-stripped">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">No.</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $i => $category)
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a href="/categories/{{ $category->id }}"><button class="btn btn-primary">Show</button></a>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
