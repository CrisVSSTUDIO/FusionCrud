@extends('layouts.app')

@section('content')
    <style>
        .bi {
            display: inline-block;
            width: 1rem;
            height: 1rem;
        }

        /*
                     * Sidebar
                     */
        .sidebar {
            top: 0;
            /* rtl:raw:
                      right: 0;
                      */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100;
            /* Behind the navbar */
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
                height: auto;
            }
        }



        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /*   body {
                            min-height: 100vh;
                            min-height: -webkit-fill-available;
                        }

                        html {
                            height: -webkit-fill-available;
                        } */

        main {
            height: 100vh;
            height: -webkit-fill-available;
            max-height: 100vh;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .dropdown-toggle {
            outline: 0;
        }

        .btn-toggle {
            padding: .25rem .5rem;
            font-weight: 600;
            color: var(--bs-emphasis-color);
            background-color: transparent;
        }

        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(var(--bs-emphasis-color-rgb), .85);
            background-color: var(--bs-tertiary-bg);
        }

        .btn-toggle::before {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
        }

        [data-bs-theme="dark"] .btn-toggle::before {
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%28255,255,255,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        }

        .btn-toggle[aria-expanded="true"] {
            color: rgba(var(--bs-emphasis-color-rgb), .85);
        }

        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }

        .btn-toggle-nav a {
            padding: .1875rem .5rem;
            margin-top: .125rem;
            margin-left: 1.25rem;
        }

        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: var(--bs-tertiary-bg);
        }

        .scrollarea {
            overflow-y: auto;
        }

        /*
                     * Navbar
                     */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .form-control {
            padding: .75rem 1rem;
        }
    </style>


    <x-svg-props />



    <header class="navbar sticky-top bg-body-tertiary flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white"
            href="/">{{ config('app.name', 'Laravel') }}</a>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                    aria-label="Toggle search">
                    <svg class="bi">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
            </li>
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg class="bi">
                        <use xlink:href="#list"></use>
                    </svg>
                </button>
            </li>
        </ul>

        <div id="navbarSearch" class="navbar-search w-100 collapse">
            <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-md-block  sidebar p-2 shadow collapse show ">
                <div class="offcanvas-md offcanvas-end  h-100" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="position-sticky pt-3">
                        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                            <ul class="nav flex-column">
                                @canany(['create-category', 'edit-category', 'delete-category'])
                                    <li class="mb-1">
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#categories-collapse"
                                            aria-expanded="false">
                                            Categories
                                        </button>
                                        <div class="collapse" id="categories-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li><a href="{{ route('categories.create') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add
                                                        new category</a></li>
                                                <li><a href="{{ route('categories.index') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">Show
                                                        all categories</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                                @canany(['create-product', 'edit-product', 'delete-product'])
                                    <li class="mb-1">
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#assets-collapse"
                                            aria-expanded="false">
                                            Assets
                                        </button>
                                        <div class="collapse" id="assets-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li><a href="{{ route('products.create') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add
                                                        new asset</a></li>
                                                <li><a href="{{ route('products.index') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">Show
                                                        all assets</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                                @canany(['create-role', 'edit-role', 'delete-role'])
                                    <li class="mb-1">
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#trashed" aria-expanded="false">
                                            Trashed items </button>
                                        <div class="collapse" id="trashed">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li><a href="{{ route('trashed') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">Trashed
                                                        items</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                                @canany(['create-role', 'edit-role', 'delete-role'])
                                    <li class="mb-1">
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#roles" aria-expanded="false">
                                            Manage roles</button>
                                        <div class="collapse" id="roles">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li><a href="{{ route('roles.index') }}"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded">See
                                                        all roles</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                                @canany(['create-user', 'edit-user', 'delete-user'])
                                    <li class="mb-1">
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false">
                                            Manage users </button>
                                        <div class="collapse" id="users">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        href="{{ route('users.index') }}">
                                                        Manage users</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                @endcanany
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#orders-collapse"
                                        aria-expanded="false">
                                        Analytics </button>
                                    <div class="collapse" id="orders-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li><a href="{{ route('analytics') }}"
                                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Analytics
                                                    page</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="border-top my-3"></li>
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#account-collapse"
                                        aria-expanded="false">
                                        Account
                                    </button>
                                    <div class="collapse" id="account-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            @guest
                                                @if (Route::has('login'))
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                                    </li>
                                                @endif

                                                @if (Route::has('register'))
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @endif
                                            @else
                                            
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('getuserprofile') }}">{{ __('Dashboard') }}</a>
                                            </li>
                                                <li class="nav-item ">


                                                    <a class="nav-link" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                                <li class="nav-item ">

                                    </li>
                                @endguest
                            </ul>
                        </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 vh-100 overflow-auto">
            {{-- <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                            <svg class="bi">
                                <use xlink:href="#calendar3"></use>
                            </svg>
                            This week
                        </button>
                    </div> 
            </div> --}}
            @yield('crud-content')
        </main>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
        integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous">
    </script>
   
@endsection
