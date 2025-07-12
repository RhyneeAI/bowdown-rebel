@foreach ($hot_products->chunk(3) as $chunk)
    <div class="row mb-4">
        @foreach ($chunk as $item)
            @php
                $colClass = match(count($chunk)) {
                    1 => 'col-md-12',
                    2 => 'col-md-6',
                    default => 'col-md-4'
                };
            @endphp

            <div class="{{ $colClass }} text-center animate-box">
                <div class="product">
                    <div class="product-grid"
                        style="background-image:url({{ asset('assets') }}/web/images/pict_bowdown/shirt1.png);">
                        <div class="inner">
                            <p>
                                <a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
                                <a href="{{ route('shop.detail') }}" class="icon"><i class="icon-eye"></i></a>

                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="single.html">White Retro Power Tees</a></h3>
                        <span class="price">Rp. 150.000</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br><br>
@endforeach