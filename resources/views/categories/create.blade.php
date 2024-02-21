@extends('home')
@section('crud-content')
    <div class="container py-4">
        <x-alert-success />

        <x-alert-error />
        <div class="row">
            <div class="col-md-8">
                <x-card title="Create category">
                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group p-3">
                            <label for="name">Category name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>
                        <div class="form-group p-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="category_description" name="category_description"></textarea>
                        </div>

                        <div class="form-group text-center p-3">
                            <button type="submit" name="submit" class="btn btn-primary">Create category</button>
                        </div>
                    </form>
                </x-card>
            </div>
        @endsection
