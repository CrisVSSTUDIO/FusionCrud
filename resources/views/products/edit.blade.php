@extends('home')
@section('crud-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card title="{{ $product->name ?? 'Sem informação' }}">
                <form method="POST" action="{{ route('products.update', $product) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group p-2">
                    <label for="name">Product name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $product->name ?? 'Sem nome' }}">
                </div>
                <div class="form-group p-2">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $product->description ?? 'Sem descrição' }}</textarea>
                </div>
                <div class="form-group p-2">
                    <label for="category_id">Category</label>
                    <select class="form-select form-select-sm" id="category" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- 
           <div class="form-group p-2">
                <label for="name">Tags do asset</label>
                <select class="form-select" aria-label="Multiple select example" id="assetags" name="assetags[]" multiple>
                    @foreach ($product->tags as $currentag)
                    <option value="{{ $currentag->id }}">{{ $currentag->tag_name ?? 'Sem tags' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group p-2">
                <label for="name">Tags disponiveis </label>
                <select class="form-select" aria-label="Multiple select example" id="tags" name="tags[]" multiple>
                    @foreach ($alltags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->tag_name ?? 'Sem tags' }}</option>
                    @endforeach
                </select>
            </div> --}}

                <div class="form-group p-2">

                    <label for="formFile" class="form-label">Choose a file</label>
                    <input class="form-control" type="file" id="upload" name="upload">
                </div>
                <div class="form-group p-2 text-center">
                    <button type="submit" class="btn btn-primary ">Update</button>
                </div>
            </form>
            </x-card>
        @endsection
