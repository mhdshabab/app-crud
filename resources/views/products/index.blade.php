@extends('layouts.app')

@section('content')
        <div class="card mt-5">
        <div class="card-header">Product Index</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route("products.create") }}" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus"></i> Create Product</a>
                @php
                $newOrder = $sortOrder === 'asc' ? 'desc' : 'asc';
                @endphp
                <a href="{{ route("products.index", ['sort_by' => $sortBy, 'sort_order' => $newOrder]) }}" class="btn btn-info btn-sm mb-3 "><i class="fa fa-sort"></i>
                    
                    Sort Products</a>
            </div>
            <div class="table-responsive">
                <table class="table table-primary table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" width="50">ID </th>
                            <th scope="col">Publisher Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Detail</th>
                            <th scope="col" width="250">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                        <tr>
                            <td >{{ $product->id }}</td>
                            <td >{{ $product->user->name ?? 'Unknown' }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->detail }}</td>
                            <td >
                                 <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                                   @can('update', $product)
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                    @endcan
                                    @can('delete', $product)
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- TEMP DEBUG --}}
            {{-- @if (auth()->check())
                <div class="alert alert-info">
                    Logged in as: {{ auth()->user()->name }} (ID: {{ auth()->id() }})
                </div>
            @else
                <div class="alert alert-warning">
                    Not logged in!
                </div>
            @endif --}}


            
        </div>
        </div>
@endsection