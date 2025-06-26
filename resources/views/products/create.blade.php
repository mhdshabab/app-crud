@extends('layouts.app')

@section('content')
            <div class="card mt-5">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <a href="{{ route("products.index") }}" class="btn btn-info btn-sm mb-3"><i class="fa fa-arrow-left"></i> BACK</a>
                    <form action="{{ route("products.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Detail</label>
                            <textarea name="detail" placeholder="Detail" class="form-control"></textarea>
                            @error('detail')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" />
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-success btn-sm"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>   
               
            </div>
@endsection  