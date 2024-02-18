@extends('home')
@section('crud-content')
<div class="container py-4">
    <x-alert-success />

<x-alert-error />
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6 shadow rounded bg-white">
            <h2 class="fw-bold p-3 text-primary text-center">Criar Categoria</h2>
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group p-3">
                    <label for="name">Nome da categoria</label>
                    <input type="text" class="form-control" id="category_name" name="category_name">
                </div>
                <div class="form-group p-3">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" id="category_description" name="category_description"></textarea>
                </div>

                <!--  -->
                <div class="form-group text-center p-3">
                    <button type="submit" name="submit" class="btn btn-primary">Criar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection