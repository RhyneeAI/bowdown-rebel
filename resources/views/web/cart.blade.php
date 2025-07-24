@extends('web.partials.main')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

.table td {
    padding: 1rem;
}

.table td span {
    font-size: 1.5rem;
}

.table td div p {
    font-size: 1.5rem;
    display: inline;
}

.table td div input[type="hidden"] {
    margin-top: -0.5rem;
}
</style>
@endpush
@section('content')
    <div class="fh5co-loader"></div>
    <form action="{{ route($role.'.transaction.checkout') }}" method="POST" id="form-checkout">
        @csrf
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
                                        {{-- <input type="hidden" name="qty[]" value="">
                                        <input type="hidden" name="variant_product_ids[]"> --}}
                                        <tr id="row-{{ $item->id }}">
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
                                                    <input type="text" name="qty[]" class="qty-input" value="{{ $item->qty }}" style="font-size: 2.1rem;" readonly>
                                                    <input type="hidden" name="variant_product_ids[]" value="{{ $item->variantProduct->id ?? '' }}">
                                                    <button class="qty-btn btn-plus" type="button">+</button>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <p style="font-size: 2.1rem; margin-top: 20px;">Rp{{ number_format(($item->variantProduct->harga ?? 0) * $item->qty, 0, ',', '.') }}</p>
                                            </td>
                                            <td style="vertical-align: middle; text-align: right;">
                                                <button type="button" class="text-danger remove-cart-item" data-id="{{ $item->id }}" style="border: none; background: none;">
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

                        <div class="form-inline" style="margin-top: 20px;">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon code">
                            <button type="button" class="btn btn-primary" id="apply-coupon" style="background: #111; border-color: #111; color: #fff; margin-top:5px;">Apply coupon</button>
                        </div>
                        {{-- Dropdown Ekspedisi --}}
                        <div class="form-inline mb-4">
                            <label style="margin-top: 10px;">Pilih Ekspedisi</label><br>
                            <select name="expedition_id" id="expedition-select" class="form-control">
                                <option value="">Pilih Ekspedisi</option>
                                @foreach ($expeditions as $expedition)
                                    <option 
                                        value="{{ $expedition->id }}" 
                                        data-biaya="{{ $expedition->biaya }}"
                                    >
                                        {{ $expedition->nama_ekspedisi }} - Rp{{ number_format($expedition->biaya, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="text-center" style="padding: 60px 0;">
                            <p class="lead">Tidak ada produk di keranjang.</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-dark">Belanja Sekarang</a>
                        </div>
                    </div>
                @endif
                <input type="hidden" name="total_payment" id="total_payment" value="0">
                <div id="promotion_container"></div>

                <!-- Cart Totals -->
                @if ($cart->cartItems->count() > 0)
                    <div class="col-md-4 col-sm-12">
                        <div style="border: 1px solid #ccc; padding: 30px;">
                            <h3>Cart totals</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <span>SUBTOTAL</span>
                                            <div>
                                                Rp <p id="subtotal" class="mb-0">0</p>
                                                <input type="hidden" name="subtotal">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <span>ONGKOS KIRIM</span>
                                            <div>
                                                <p id="ongkir" class="mb-0">0</p>
                                                <input type="hidden" name="ongkir" id="input-ongkir" value="0">
                                                {{-- <input type="hidden" name="expedition_id" id="input-expedition-id" value="1"> --}}
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <span>DISCOUNT</span>
                                            <div>
                                                <p id="discount" class="mb-0">0</p>
                                                <input type="hidden" name="discount">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <span><strong>TOTAL</strong></span>
                                            <div>
                                                <strong>Rp</strong> <strong id="total" class="mb-0">0</strong>
                                                <input type="hidden" name="total">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="checkout-button" class="btn btn-block btn-primary" style="background: #111; border-color: #111; color: #fff;">Proceed to checkout</button>
                            {{-- <a href="#" class="btn btn-block btn-primary" style="background: #111; border-color: #111; color: #fff;">Proceed to checkout</a> --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}" src="{{ env('MIDTRANS_SNAP_URL', "https://app.sandbox.midtrans.com/snap/snap.js") }}"></script>
<script>
    $(document).ready(function () {
        $('#expedition-select').select2({
            width: '35%',
            height: '40px',
        });

        let hasChanges = false;

        // Event untuk tombol minus
        $('.btn-minus').on('click', function () {
            const $qtyInput = $(this).siblings('.qty-input');
            let val = parseInt($qtyInput.val()) || 1;
            if (val > 1) {
                $qtyInput.val(val - 1);
                checkChanges($(this).closest('.quantity-control'));
                updateTotal($(this).closest('.quantity-control'));
                updateOverallTotal();
            }
        });

        // Event untuk tombol plus
        $('.btn-plus').on('click', function () {
            const $qtyInput = $(this).siblings('.qty-input');
            let val = parseInt($qtyInput.val()) || 1;
            $qtyInput.val(val + 1);
            checkChanges($(this).closest('.quantity-control'));
            updateTotal($(this).closest('.quantity-control'));
            updateOverallTotal();
        });

        // Fungsi untuk memeriksa perubahan qty
        function checkChanges($quantityControl) {
            const initialQty = parseInt($quantityControl.data('initial-qty'));
            const currentQty = parseInt($quantityControl.find('.qty-input').val());
            hasChanges = hasChanges || (initialQty !== currentQty);
            $('#save-changes-container').toggle(hasChanges);
        }

        // Fungsi untuk memperbarui total harga per baris
        function updateTotal($quantityControl) {
            const $row = $quantityControl.closest('tr');
            const price = parseInt($row.find('td:nth-child(2) span').text().replace('Rp', '').replace(/\./g, '')) || 0;
            const qty = parseInt($quantityControl.find('.qty-input').val()) || 1;
            const total = price * qty;
            $row.find('td:nth-child(4) p').text('Rp' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            updateOverallTotal(); // Panggil update total keseluruhan
        }

        $('#apply-coupon').click(function() {
            let coupon_code = $('#coupon_code').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const url = "{{ $role == 'User' ? route($role . '.cart.apply-coupon') : null }}";
            if (!url) {
                toastr.error('Silahkan login terlebih dahulu');
                return;
            }

            $.get(url, { coupon_code })
                .done(response => {
                    if (response.status === 'success') {
                        toastr.success(response.message);

                        const diskonHarga = parseInt(response.data.diskon_harga);
                        $('#discount').text(diskonHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                        $('input[name="discount"]').val(response.data.diskon_harga);
                        $('#promotion_container').html(`<input type="hidden" name="promotion_ids[]" value="${response.data.id}">`);
                        updateOverallTotal();
                    } else if (response.status === 'error') {
                        toastr.error(response.message);

                        $('#discount').text('- Rp 0')
                        updateOverallTotal();
                    } else {
                        toastr.error('!!!', 'Terjadi kesalahan tak terduga.');
                    }
                })
                .fail(error => {
                    toastr.error('Gagal terhubung ke server');
                    console.error(error);
                });
        });

        $('#expedition-select').on('change', function () {
            const ongkir = parseInt($(this).find(':selected').data('biaya')) || 0;
            const ekspedisiId = $(this).val() || '';

            // Update tampilan ongkir
            $('#ongkir').text('Rp ' + ongkir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            // Update hidden inputs
            $('#input-ongkir').val(ongkir);
            $('#input-expedition-id').val(ekspedisiId);

            updateOverallTotal(); // pastikan fungsi ini ambil ongkir dari #input-ongkir
        });




        // Fungsi updateOverallTotal (pastikan sudah ada dari kode sebelumnya)
        function updateOverallTotal() {
            let subtotal = 0;
            $('.quantity-control').each(function () {
                const $row = $(this).closest('tr');
                const rowTotal = parseInt($row.find('td:nth-child(4) p').text().replace('Rp', '').replace(/\./g, '')) || 0;
                subtotal += rowTotal;
            });

            const discount = parseInt($('#discount').text().replace('- Rp ', '').replace(/\./g, '')) || 0;
            const ongkir = parseInt($('#input-ongkir').val()) || 0;
            const total = subtotal + ongkir - discount;

            $('#subtotal').text(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#discount').text('- Rp ' + discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#ongkir').text('Rp ' + ongkir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            $('input[name="subtotal"]').val(subtotal);
            $('input[name="discount"]').val(discount);
            $('input[name="ongkir"]').val(ongkir);
            $('input[name="total"]').val(total);

            $('#save-changes-container').toggle(hasChanges);

            $('#total_payment').val(total);
        }

        updateOverallTotal()
       
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
            if (!url) {
                toastr.error('Silahkan login terlebih dahulu');
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
                        // Update initial qty setelah sukses simpan
                        $('.quantity-control').each(function () {
                            const $qtyInput = $(this).find('.qty-input');
                            $(this).data('initial-qty', parseInt($qtyInput.val()));
                        });
                        updateOverallTotal(); // Perbarui total setelah simpan
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

        $(document).on('click', '#checkout-button', function () {
            // get url from form attribute
            const url = $('#form-checkout').attr('action');

            const form = $('#form-checkout')[0];
            const formDataPayload = new FormData(form);

            $.ajax({
                url: url,
                type: 'POST',
                data: formDataPayload,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === 'success') {
                        snap.pay(res.data.token, {
                            onSuccess: function(result) {
                                // Redirect ke halaman sukses
                                window.location.reload();
                            },
                            onPending: function(result) {
                                // Redirect ke halaman menunggu pembayaran
                                window.location.reload();
                            },
                            onError: function(result) {
                                // Redirect ke halaman error
                                window.location.reload();
                            },
                            onClose: function() {
                                // 👉 Trigger saat user menutup popup tanpa membayar
                                window.location.reload(); // ganti dengan route kamu
                            }
                        });
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log([error, xhr]);
                    const message = xhr.responseJSON.message || 'Terjadi kesalahan: ' + error;
                    toastr.error(message);
                },
                complete: function () {
                    hasChanges = false;
                    $('#save-changes-container').hide();
                }
            });
        })

        $('.remove-cart-item').on('click', function (e) {
            e.preventDefault();

            const itemId = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/User/cart/${itemId}/remove`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        },
                        success: function (data) {
                            $(`#row-${itemId}`).remove();

                            toastr.success(data.success || 'Item berhasil dihapus dari keranjang.');
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                            toastr.error('Terjadi kesalahan saat menghapus item dari keranjang.');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush


