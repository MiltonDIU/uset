<ul class="footer-bottom-links list-inline mb-0">
    @foreach($menuItems as $item)
        <li class="list-inline-item">
            <a href="{{ $item->link }}" target="{{ $item->target }}">{{ $item->name }}</a>
        </li>
    @endforeach
</ul>
