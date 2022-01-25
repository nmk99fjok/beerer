<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}"><strong>Beerer!</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
            aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
      <ul class="navbar-nav ml-auto">
        @guest('user')
          @guest('admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.register') }}">新規登録</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.login') }}">ログイン</a>
            </li>
          @endguest
        @endguest

        @auth('user')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle"></i>{{ Auth::user()->name }}さん
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <button class="dropdown-item" type="button"
                      onclick="location.href='{{ route('user.show', ['name' => Auth::user()->name]) }}'">
                マイページ
              </button>
              <div class="dropdown-divider">

              </div>
              <button form="logout-button" class="dropdown-item" type="submit">
                ログアウト
              </button>
            </div>
          </li>
          <form id="logout-button" method="POST" action="{{ route('user.logout') }}">
            @csrf
          </form>
        @endauth

        @auth('admin')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle"></i>Admin
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <button class="dropdown-item" type="button"
                      onclick="location.href='{{ route('admin.index') }}'">
                ダッシュボード
              </button>
              <div class="dropdown-divider"></div>
              <button form="logout-button" class="dropdown-item" type="submit">
                管理者ログアウト
              </button>
            </div>
          </li>
          <form action="{{ route('admin.logout') }}" method="POST" id="logout-button">
            @csrf
          </form>
        @endauth
      </ul>
    </div>
  </div>
</nav>
