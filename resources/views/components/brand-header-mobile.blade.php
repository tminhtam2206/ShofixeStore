<ul>
    @foreach($brand as $value)
    <li><a href="{{ route('frontend.brand', ['name_slug' => $value->name_slug]) }}">{{ $value->name }}</a></li>
    @endforeach
</ul>