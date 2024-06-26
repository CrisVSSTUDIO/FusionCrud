@extends('home')
@section('crud-content')
<div class="row justify-content-center">
    <div class="col-md-8">
            <x-card title="Create products">

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group p-3">
                        <label for="name">Nome</label>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" id="name" name="name"value="{{ old('name') }}">
                    </div>
                    <div class="form-group p-3">
                        <label for="description">Descrição</label>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group p-3">

                        <label for="category_id">Categoria</label>
                        <select class="form-select form-select-sm" id="category" name="category">
                            <option>Por favor, escolha...</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" selected="category">{{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group p-3">

                        <label for="formFile" class="form-label">Escolha um arquivo</label>
                        <input class="form-control" type="file" id="upload" name="upload">

                    </div>
                    <div class="form-group text-center p-3">
                        <button type="submit" name="submit" class="btn btn-primary">Criar Asset</button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection
