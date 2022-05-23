@if(count($brand()) > 0)
<div class="client-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="client-owl">
                <!-- start loop brands -->
                @foreach($brand() as $value)
                <div class="col-xs-12">
                    <div class="single-client">
                        <div class="single-client-img plr-40">
                            <a href="#"><img src="{{ getLogoBrand($value->logo) }}" alt=""></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end loop brands -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="client-button text-center pt-35">
                    <a href='#' class='section-button'>Xem Thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif