<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config("app.name") }}</a>

    <!-- Navbar toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Main menu -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth

        <!-- Admin -->
        <li class="nav-item dropdown">
          <a @class(['nav-link fw-bold dropdown-toggle', 'active' => request()->routeIs('admin.*')]) href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ trans('admin.admin') }}
          </a>
          <ul class="dropdown-menu">
            <li>
              <a @class(['dropdown-item', 'active' => request()->routeIs('admin.categories.index')]) href="#">
                {{ trans('admin.categories') }}
              </a>
            </li>
          </ul>
        </li>

        <!-- Tickets -->
        <li class="nav-item dropdown">
          <a @class(['nav-link dropdown-toggle', 'active' => request()->routeIs('tickets.*')]) href="{{ route('tickets.index') }}" data-bs-toggle="dropdown" aria-expanded="false">
            Tickety
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#" @class(['dropdown-item', 'active' => request()->routeIs('tickets.user')])>
                {{ trans('ticket.assigned_to_user') }}
              </a>
            </li>
            <li>
              <a href="#" @class(['dropdown-item', 'active' => request()->routeIs('tickets.unassigned')])>
                {{ trans('ticket.unassigned_tickets') }}
              </a>
            </li>
            <li>
              <a href="#" @class(['dropdown-item', 'active' => request()->routeIs('tickets.index')])>
                {{ trans('ticket.all_tickets') }}
              </a>
            </li>
          </ul>
        </li>

        @endauth
      </ul>

      <!-- User navigation -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
            @auth
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <x-user.badge :user="auth()->user()" />
                {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button class="dropdown-item" type="submit" form="logoutForm">
                        <span class="me-1"><i class="fa-solid fa-fw fa-right-from-bracket"></i></span>
                        <span>{{ trans('ui.logout') }}</span>
                    </button>
                </li>
            </ul>
            @else
                <a class="nav-link" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
            @endauth
        </li>
      </ul>
    </div>
  </div>
</nav>

<form action="{{ route('logout') }}" method="POST" id="logoutForm" class="d-none">
    @csrf
</form>
