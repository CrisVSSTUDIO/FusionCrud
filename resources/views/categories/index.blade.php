@extends('layouts.app')
@section('content')
<x-pricing view="categories.index" />


@if (isset($categories))
<section class="categories">


    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 shadow-lg bg-white border-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Index</a></li>
                        <li class="breadcrumb-item " aria-current="page">Categorias</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



    <div class="alert " role="alert" id="alert_info">
        <b> Temos <u class="text-info"><?php echo htmlspecialchars($rowcount ?? ''); ?></u>
            {{ $rowcount > 1 ? 'categorias' : 'categoria' }}</b>
    </div>
    <x-alert-success />

    <x-alert-error />
    <div class="main-container " id="main-container">

        @forelse ($categories as $category)


        <div class="card-body-mine shadow p-3 mb-5 bg-body rounded slide-in">

            <div class="card-body-info">

                <h3 class="card-title mt-2">{{ $category->category_name ?? 'Sem informação' }}</h3>
                <span class="card-description mt-2">{{ $category->category_description ?? 'Sem informação' }}</span>

                <div class="button-area">
                    <a class="btn btn-primary  rounded-pill px-3  mt-2" href="{{route('categories.show',$category)}}" role="button">Visualizar {{ $category->category_name ?? 'Asset' }}</a>
                </div>
            </div>
        </div>
        @empty
        <x-nodata />
        @endforelse




</section>

@elseif (isset($categoriesearch))
<section class="categories-search">

    <div class="alert " role="alert" id="alert_info">
        <b> Temos <u class="text-info"><?php echo htmlspecialchars($rowcount ?? ''); ?></u>
            {{ $rowcount > 1 ? 'categorias' : 'categoria' }}</b>
    </div>
    <div class="main-container " id="main-container">

        @forelse ($categoriesearch as $category)

        <div class="card-body-mine shadow p-3 mb-5 bg-body rounded slide-in">

            <hr>
            <div class="card-body-info">

                <h3 class="card-title mt-2">{{ $category->category_name ?? 'Sem informação' }}</h3>
                <span class="card-description mt-2">{{ $category->category_description ?? 'Sem informação' }}</span>

                <div class="button-area">
                    <a class="btn btn-primary  rounded-pill px-3  mt-2" href="{{route('categories.show',$category)}}" role="button">Visualizar {{ $category->category_name ?? 'Asset' }}</a>
                </div>
            </div>
        </div>
        @empty

        <x-nodata />

        @endforelse

</section>
@endif


@endsection