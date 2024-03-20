<div class="col-md-3 col-lg-2 d-md-block  sidebar p-2 shadow collapse show ">
    <div class="offcanvas-md offcanvas-end  h-100" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="position-sticky pt-3">
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                <ul class="nav flex-column">
                    @canany(['create-category', 'edit-category', 'delete-category'])
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#categories-collapse" aria-expanded="false">
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
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#assets-collapse" aria-expanded="false">
                                Products
                            </button>
                            <div class="collapse" id="assets-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="{{ route('products.create') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add
                                            new product</a></li>
                                    <li><a href="{{ route('products.index') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded">Show
                                            all products</a></li>

                                </ul>
                            </div>
                        </li>
                    @endcanany
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
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
                    @canany(['see-invitations'])
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#invitations" aria-expanded="false">
                                Manage invitations</button>
                            <div class="collapse" id="invitations">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="{{ route('allInvitations') }}"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded">See
                                            all invites</a></li>

                                </ul>
                            </div>
                        </li>
                    @endcanany
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
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
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
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
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
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

                        <div class="dropdown">
                            <a href="#"
                                class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="{{ Auth::user()->name }}" width="32"
                                    height="32" class="rounded-circle me-2">
                                <strong>{{ Auth::user()->name }}</strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow">
                                @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('getuserprofile') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li>


                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                @endguest
                            </ul>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
