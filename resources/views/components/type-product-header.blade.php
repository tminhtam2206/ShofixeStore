<ul class="submenu-mainmenu">
    <!-- start loop product type -->
    @foreach($typeProduct as $value)
    <li>
        <a href="{{ route('frontend.type_product', ['name_slug' => $value->name_slug]) }}"><i class="fa fa-circle"></i>{{ $value->name }}<i class="fa fa-angle-right"></i></a>
        <ul class="sub-submenu-mainmenu">
            @foreach($category as $val_2)
            @if($value->id == $val_2->type_product_id)
            <li><a href="{{ route('frontend.category', ['name_slug' => $value->name_slug]) }}"><i class="fa fa-circle"></i>{{ $val_2->name }}</a></li>
            @endif
            @endforeach
        </ul>
    </li>
    @endforeach
    <!-- end loop product type -->
</ul>