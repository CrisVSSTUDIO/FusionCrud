<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid ">
        <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <ul class="navbar-nav mb-2 mb-lg-0">
                @if (Route::has('login'))
                @auth

                <div class="dropdown m-2 ">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="{{asset('resources\assets\user.jpg')}}" alt="{{ Auth::user()->name }}" width="auto" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small show">
                        <li><a class="dropdown-item" href="{{ url('/home') }}">Restrict area</a></li>
                        <li><a class="dropdown-item" href="{{ route('getuserinfo') }}">Profile</a></li>
                        @can('Super Admin')
                        <li><a class="dropdown-item" href="{{ route('management') }}">Admin Dashboard</a></li>
                        @endcan
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li> <a class="dropdown-item  " href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>


                    </ul>
                </div>
                @else
                <div class="flex-column text-center px-md-4 px-sm-0 text-white ">
                    <i class="far fa-user"> </i> <small class="px-2">Non authenticated user (
                        <a class="text-white" href="{{ route('login') }}"> Login </a>)</small>
                </div>

                @endauth
                @endif
            </ul>
        </div>

    </div>
    </div>
</nav>