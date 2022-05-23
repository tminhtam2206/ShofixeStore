<ul>
    @foreach($type_product as $value)
    <li>
        <a href="{{ route('frontend.type_product', ['name_slug' => $value->name_slug]) }}">{{ $value->name }}</a>
    </li>
    @endforeach
</ul>