<nav class="uk-navbar-container" uk-navbar>
  <div class="uk-navbar-left">
    <a class="uk-navbar-item uk-logo" href="{{ route('tasks.index') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
  </div>

  <div class="uk-navbar-right">
    <div class="uk-navbar-nav">
      <hr>
        <a href="#"><span uk-icon="grid"></span></a>
        <div class="uk-navbar-dropdown uk-width-medium">
          <div class="uk-nav uk-navbar-dropdown-nav">
            <!-- Authentication Links -->
            @guest
              <li>
                <a href="{{ route('login') }}">
                  <span uk-icon="sign-in" class="uk-margin-small-right"></span>
                  {{ __('Login') }}
                </a>
              </li>

              @if (Route::has('register'))
                <li>
                  <a href="{{ route('register') }}">
                    <span uk-icon="user" class="uk-margin-small-right"></span>
                    {{ __('Register') }}
                  </a>
                </li>
              @endif
            @else
              <div>You are logged in!
                <a href="/user/profile">Profile settings</a>
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span uk-icon="sign-out" class="uk-margin-small-right"></span>
                  Logout
                </a>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" uk-hidden>
                @csrf
              </form>
            @endguest
          </div>
        </div>
    </ul>
  </div>
</nav>
