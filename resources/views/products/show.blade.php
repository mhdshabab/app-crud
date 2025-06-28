@extends('layouts.app')

@section('content')
            <div class="card mt-5">
                <div class="card-header">Product Details</div>
                <div class="card-body">
                    <a href="{{ route("products.index") }}" class="btn btn-info btn-sm mb-3"><i class="fa fa-arrow-left"></i> BACK</a>
                    <div class="mt4">
                        <p><strong>Publisher Name :</strong> {{ $product->user->name ?? 'Unknown' }}</p>
                        <p><strong>Name :</strong> {{ $product->name }}</p>
                        <p><strong>Detail :</strong> {{ $product->detail }}</p>
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                        </div>
                    </div>
                    
                </div>
            </div>
@endsection