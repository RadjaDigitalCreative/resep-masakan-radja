<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">

                <img src="{{ asset('img/kuchtit.png') }}" alt="{{ config('app.name', 'CsApp') }}">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-main">
                <li>
                    <a href="{{ route('home') }}" class="item">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('search') }}" class="item">Cari Resep</a>
                </li>
                <li>
                    <a href="{{ route('search3') }}" class="item">Cari Bahan</a>
                </li>
                <li>
                    <a href="{{ route('new.recipes') }}" class="item">Resep Baru</a>
                </li>
                <li>
                    <a href="{{ route('categories') }}" class="item">Kategori</a>
                </li>
                <li>
                    <a href="{{ route('rankings') }}" class="item">Peringkat</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                <li><a href="{{ route('login') }}" class="item">Login</a></li>
                <li><a href="{{ route('register') }}" class="item">Registrasi</a></li>
                @else
                @if (Auth::user()->isAdmin())
                <li><a href="{{ route('admin') }}" class="item">Administrasi</a></li>
                @endif
                @if (Auth::user()->isCook())
                <li class="dropdown">
                    <a class="item" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Resep <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('likes.auth') }}"><i class="glyphicon glyphicon-heart"></i> Kesukaanku</a>
                        </li>
                        <li>
                            <a href="{{ route('recipes.auth') }}"><i class="glyphicon glyphicon-cutlery"></i>Resep Saya</a>
                        </li>
                        <li>
                            <a href="{{ route('recipes.create') }}"><i class="glyphicon glyphicon-plus"></i> Resep Baru</a>
                        </li>
                        <li>
                            <a href="{{ route('comments.list') }}"><i class="glyphicon glyphicon-comment"></i> Komentar</a>
                        </li>
                    </ul>
                </li>
                @else
                <li>
                    <a class="item" href="{{ route('likes.auth') }}">
                        <i class="glyphicon glyphicon-heart"></i> Favorit Saya
                    </a>
                </li>
                @endif
                <li class="dropdown">
                    <a class="item" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ Auth::user()->avatarPath() }}" alt="" class="avatar-img">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('user.profile', Auth::user()->slug) }}">
                                <i class="glyphicon glyphicon-user"></i> Profil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings') }}">
                                <i class="glyphicon glyphicon-cog"></i> Pengaturan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="glyphicon glyphicon-log-out"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>
</nav>
