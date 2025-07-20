@extends('web.partials.main')
@push('css')
    <style>
.quantity-control {
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
}
.qty-btn {
    background: none;
    border: none;
    font-size: 24px;
    font-weight: 300;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    cursor: pointer;
}
.qty-input {
    width: 30px;
    text-align: center;
    border: none;
    background: transparent;
    font-size: 18px;
    font-weight: 400;
}

@media screen and (max-width: 768px) {
    .table-responsive {
        border: 0;
    }
    .cart-table td {
        display: block;
        text-align: right;
        border: none !important;
    }
    .cart-table td::before {
        float: left;
        font-weight: bold;
    }
    .quantity-control {
        justify-content: flex-end;
    }
}
</style>
@endpush
@section('content')
    <div class="fh5co-loader"></div>
    <div id="page">
        <!-- Shopping Cart Page -->
        <div class="container" style="padding: 60px 0;">
        <div class="row">
            <!-- Cart Items -->
            @if (optional($cart->cartItems)->count() > 0)
                <div class="col-md-8 col-sm-12">
                    <a href="{{ route('shop.index') }}" style="display: inline-block; margin-bottom: 20px;">
                        <i class="icon-arrow-left"></i> Continue Shopping
                    </a>

                    <div class="table-responsive">
                        <table class="table cart-table">
                            <tbody>
                                @foreach($cart->cartItems as $item)
                                    <tr>
                                        <td style="width: 120px;">
                                            <img src="{{ GetFile('products', $item->product->photos->first()->nama_hash ?? '') }}" class="img-responsive" alt="">
                                        </td>
                                        <td>
                                            <strong style="font-size: 2.2rem;">{{ $item->product->nama_produk }}</strong><br>
                                            <span style="font-size: 2rem;">Rp{{ number_format($item->variantProduct->harga ?? 0, 0, ',', '.') }}</span>
                                            <p style="font-size: 1.8rem;">Size : {{ $item->variantProduct->ukuran ?? '' }}</p>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="quantity-control" data-item-id="{{ $item->id }}" data-variant-id="{{ $item->variantProduct->id ?? '' }}" data-initial-qty="{{ $item->qty }}">
                                                <button class="qty-btn btn-minus" type="button">-</button>
                                                <input type="text" name="qty[{{ $item->id }}][value]" class="qty-input" value="{{ $item->qty }}" style="font-size: 2.1rem;" readonly>
                                                <input type="hidden" name="qty[{{ $item->id }}][id_item]" value="{{ $item->id }}">
                                                <input type="hidden" name="qty[{{ $item->id }}][id_varian_produk]" value="{{ $item->variantProduct->id ?? '' }}">
                                                <button class="qty-btn btn-plus" type="button">+</button>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <p style="font-size: 2.1rem; margin-top: 20px;">Rp{{ number_format(($item->variantProduct->harga ?? 0) * $item->qty, 0, ',', '.') }}</p>
                                        </td>
                                        <td style="vertical-align: middle; text-align: right;">
                                            <button class="text-danger remove-cart-item" data-id="{{ $item->id }}" style="border: none; background: none;">
                                                <i class="icon-cross"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="save-changes-container" style="display: none; margin-top: 2rem; float: right;">
                        <button type="button" id="save-changes" class="btn btn-primary" style="background: #111; border-color: #111; color: #fff;">Save Changes</button>
                    </div>

                    <form class="form-inline" style="margin-top: 20px;">
                        <input type="text" class="form-control" placeholder="Coupon code">
                        <button type="submit" class="btn btn-primary" style="background: #111; border-color: #111; color: #fff;">Apply coupon</button>
                    </form>
                </div>
            @else
                <div class="col-md-12">
                    <div class="text-center" style="padding: 60px 0;">
                        <p class="lead">Tidak ada produk di keranjang.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-dark">Belanja Sekarang</a>
                    </div>
                </div>
            @endif

            <!-- Cart Totals -->
            @if ($cart->cartItems->count() > 0)
                <div class="col-md-4 col-sm-12">
                    <div style="border: 1px solid #ccc; padding: 30px;">
                        <h3>Cart totals</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>SUBTOTAL</td>
                                    <td class="text-right">Rp169.000</td>
                                </tr>
                                <tr>
                                    <td>KODE UNIK</td>
                                    <td class="text-right">Rp44</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL</strong></td>
                                    <td class="text-right"><strong>Rp169.044</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-block btn-primary" style="background: #111; border-color: #111; color: #fff;">Proceed to checkout</a>
                    </div>
                </div>
            @endif
        </div>
    </div>




    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        let hasChanges = false;

        // Event untuk tombol minus
        $('.btn-minus').on('click', function () {
            const $qtyInput = $(this).siblings('.qty-input');
            let val = parseInt($qtyInput.val()) || 1;
            if (val > 1) {
                $qtyInput.val(val - 1);
                checkChanges($(this).closest('.quantity-control'));
                updateTotal($(this).closest('.quantity-control'));
            }
        });

        // Event untuk tombol plus
        $('.btn-plus').on('click', function () {
            const $qtyInput = $(this).siblings('.qty-input');
            let val = parseInt($qtyInput.val()) || 1;
            $qtyInput.val(val + 1);
            checkChanges($(this).closest('.quantity-control'));
            updateTotal($(this).closest('.quantity-control'));
        });

        // Fungsi untuk memeriksa perubahan qty
        function checkChanges($quantityControl) {
            const initialQty = parseInt($quantityControl.data('initial-qty'));
            const currentQty = parseInt($quantityControl.find('.qty-input').val());
            hasChanges = hasChanges || (initialQty !== currentQty);
            $('#save-changes-container').toggle(hasChanges);
        }

        // Fungsi untuk memperbarui total harga
        function updateTotal($quantityControl) {
            const $row = $quantityControl.closest('tr');
            const price = parseInt($row.find('td:nth-child(2) span').text().replace('Rp', '').replace(/\./g, '')) || 0;
            const qty = parseInt($quantityControl.find('.qty-input').val()) || 1;
            const total = price * qty;
            $row.find('td:nth-child(4) p').text('Rp' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        }

        // Event untuk tombol Save Changes
        $('#save-changes').on('click', function () {
            const payload = {};
            $('.quantity-control').each(function () {
                const $qtyInput = $(this).find('.qty-input');
                const itemId = $(this).data('item-id');
                const variantId = $(this).data('variant-id');
                const initialQty = parseInt($(this).data('initial-qty'));
                const currentQty = parseInt($qtyInput.val());
                if (initialQty !== currentQty) {
                    payload[itemId] = {
                        id_keranjang_item: itemId,
                        id_varian_produk: variantId,
                        qty: currentQty
                    };
                }
            });
            // console.log('Changes to save:', payload);

            const url = "{{ $role == 'User' ? route($role . '.cart.update-cart-item') : null }}";
            if(!url) {
                toastr.error('Silahkan login terlebih dahulu')
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: payload,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('Terjadi kesalahan: ' + error);
                },
                complete: function () {
                    hasChanges = false;
                    $('#save-changes-container').hide();
                }
            });
        });
    });
</script>
@endpush


