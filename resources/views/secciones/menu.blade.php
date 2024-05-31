<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <img src="{{ asset('imagen/icon.jpg') }}" width="70" height="70" class="d-inline-block align-top rounded-circle" style="margin-right: 10px;" alt="">
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="navbar-brand" href="/">Inicio
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Desplegar <style> .navbar-nav .dropdown-toggle {
    min-width: 200px; /* Ajusta este valor según tus necesidades */
    text-align: center; /* Alinea el texto al centro */
}</style></a>
                        <div class="dropdown-menu">
                            @if (Route::has('login'))
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            @endif
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('clientes.index') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('perfiles.index') }}">Perfiles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('facturas.index') }}">Facturacion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('productos.index')}}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('carrito.index')}}"><i class="bi bi-cart4"></i></a>
                    </li>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
