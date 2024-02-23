@extends('home')
@section('crud-content')
<section>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <x-card title="Profile information">

                        <form action="{{ route('userinfo', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-outline mb-4">
                                <label for="formGroupExampleInput">Username</label>
                                <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Nome" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="formGroupExampleInput2">Email</label>
                                <input type="email" class="form-control" id="formGroupExampleInput2" name="email" placeholder="Email" value="{{ Auth::user()->email }}">

                             
                             

                            <div class="form-outline mb-4">
                                <label for="formGroupExampleInput2">Nova Password</label>
                                <input type="password" class="form-control" id="formGroupExampleInput2" name="password" placeholder="Nova Password">

                            </div>
                            <div class="form-outline mb-4">
                                <label for="formGroupExampleInput2">Confirmar nova Password</label>
                                <input type="password" class="form-control" id="formGroupExampleInput2" name="password_confirmation" placeholder="Nova Password">

                            </div>

                            <div class="container d-flex justify-content-end align-item-center">
                                <button type="submit" class="btn btn-primary rounded-pill px-3 m-1 " value="Submit" name="submit">Guardar</button>
                            </div>
                        </form>
                        </x-card>
</section>


@endsection