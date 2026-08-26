<nav class="admin-topbar">
    <div class="admin-topbar__links">
        <a href="{{ route('dashboard') }}" class="admin-topbar__brand">Admin Panel</a>
        <a href="{{ route('dashboard') }}" class="admin-topbar__link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
            Dashboard
        </a>
    </div>

    <div class="admin-topbar__user">
        <span>{{ Auth::user()->name }}</span>
        <a href="{{ route('profile.edit') }}" class="admin-topbar__link {{ request()->routeIs('profile.edit') ? 'is-active' : '' }}">
            Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-topbar__logout">Log Out</button>
        </form>
    </div>
</nav>
