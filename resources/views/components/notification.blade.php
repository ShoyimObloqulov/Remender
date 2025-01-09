<li class="nav-item dropdown">

    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ count($remenders) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ count($remenders) }} Напоминание</span>
        <div class="dropdown-divider"></div>
        @foreach($remenders as $remender)
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $remender->desc }}
            <span class="float-right text-muted text-sm">{{ $remender->created_at->diffForHumans() }}</span>
        </a>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">Просмотреть все Напоминание</a>
    </div>
</li>
