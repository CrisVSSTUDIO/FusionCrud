@extends('home')
@section('crud-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card title="{{ $category->category_name ?? 'Sem informação' }}">
                <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group p-2">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{ $category->category_name ?? 'Sem informação' }}"
                            id="category_name" name="category_name">
                    </div>
                    <div class="form-group p-2">
                        <label for="description">Descrição</label>
                        <textarea class="form-control" id="category_description" name="category_description">{{ $category->category_description ?? 'Sem informação' }}</textarea>
                    </div>
                    <div class="form-group p-3">
                        <label for="virtualidade">
                            Categoria Virtual?
                        </label>
                        <input class="form-check-input me-2" name="virtuality" type="checkbox" value="1"
                            id="virtuality" required />
                    </div>

                    <div class="form-group p-2 text-center">
                        <button type="submit" class="btn btn-primary ">Atualizar</button>
                    </div>
                </form>
            </x-card>
        @endsection
