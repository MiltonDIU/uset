<ul class="footer-links list-unstyled">
    @foreach($menuItems as $item)
        <li>
            <a href="{{ $item->link }}" target="{{ $item->target }}">{{ $item->name }}</a>
        </li>
    @endforeach
</ul>
