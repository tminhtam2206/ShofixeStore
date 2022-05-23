<div class="mega-menu">
    <!-- start loop product type -->
    @foreach($brand as $value)
    <span>
        <a href="{{ route('frontend.brand', ['name_slug' => $value->name_slug]) }}"><i class="fa fa-circle"></i>{{ $value->name }}</a>
    </span>
    @endforeach
    <!-- end loop product type -->
</div>