<ul class="navbar-nav mx-auto">
    @foreach($menuItems as $item)
        @if($item->children->isEmpty())
            <li class="nav-item">
                <a class="nav-link {{ request()->url() === $item->link || request()->fullUrl() === $item->link ? 'active' : '' }}"
                   href="{{ $item->link }}"
                   target="{{ $item->target }}">
                    {{ $item->name }}
                </a>
            </li>
        @else
            @php
                $isParentActive = $item->children->contains(fn($child) =>
                    request()->url() === $child->link || request()->fullUrl() === $child->link
                );
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ $isParentActive ? 'active' : '' }}"
                   href="{{ $item->link }}"
                   id="navbarDropdown{{ $loop->index }}"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false"
                   target="{{ $item->target }}">
                    {{ $item->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown{{ $loop->index }}">
                    @foreach($item->children as $child)
                        <a class="dropdown-item {{ request()->url() === $child->link || request()->fullUrl() === $child->link ? 'active' : '' }}"
                           href="{{ $child->link }}"
                           target="{{ $child->target }}">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            </li>
        @endif
    @endforeach
</ul>
