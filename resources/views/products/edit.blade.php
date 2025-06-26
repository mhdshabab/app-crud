@extends('layouts.app')

@section('content')
            <div class="card mt-5">
                <div class="card-header">Product Edit</div>
                <div class="card-body">
                    <a href="{{ route("products.index") }}" class="btn btn-info btn-sm mb-3"><i class="fa fa-arrow-left"></i> BACK</a>
                    <form action="{{ route("products.update", $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $product->name }}" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Detail</label>
                            <textarea name="detail" placeholder="Detail" class="form-control">{{ $product->detail }}</textarea>
                            @error('detail')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" />
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-success btn-sm"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>   
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

               
            </div>
@endsection
