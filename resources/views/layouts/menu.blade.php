
@auth
    <li class="nav-item">
        <a href="{{ route('accounts.my-account') }}"
           class="nav-link {{ Request::routeIs('accounts.my-account') ? 'active' : '' }}">
            <p>My Account</p>
        </a>
    </li>
<li class="nav-item">
    <a href="{{ route('transactions.index') }}"
       class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">
        <p>Transactions</p>
    </a>
</li>
@php
    $user = auth()->user()
@endphp
@if($user->isWebmaster() || $user->isAdmin() || $user->isModerator())
<li class="nav-item">
    <a href="{{ route('qrcodes.index') }}"
       class="nav-link {{ Request::is('qrcodes*') ? 'active' : '' }}">
        <p>Qrcodes</p>
    </a>
</li>
@endif

@if($user->isModerator() || $user->isAdmin())
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('accounts.index') }}"
       class="nav-link {{ Request::is('accounts', 'accounts/*/edit', 'accounts/create') || Request::routeIs('accounts.show') ? 'active' : '' }}">
        <p>All Accounts</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('accountHistories.index') }}"
       class="nav-link {{ Request::is('accountHistories*') ? 'active' : '' }}">
        <p>Account Histories</p>
    </a>
</li>
@endif

@if($user->isAdmin())
<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>
@endif
@endauth

