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
            <div class="col-md-8 col-sm-12">
                <a href="{{ route('shop.index') }}" style="display: inline-block; margin-bottom: 20px;">
                    <i class="icon-arrow-left"></i> Continue Shopping
                </a>

                @if (optional($cart->cartItems)->count() > 0)
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <tbody>
                                @foreach($cart->cartItems as $item)
                                    <tr>
                                        <td style="width: 120px;">
                                            <img src="{{ GetFile('products', $item->product->photos->first()->nama_hash ?? '') }}" class="img-responsive" alt="">
                                        </td>
                                        <td>
                                            <strong>{{ $item->product->nama_produk }}</strong><br>
                                            <span>Rp{{ number_format($item->variantProduct->harga ?? 0, 0, ',', '.') }}</span>
                                            <p>Size : {{ $item->variantProduct->ukuran ?? '' }}</p>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="quantity-control">
                                                <button class="qty-btn minus">−</button>
                                                <input type="text" class="qty-input" value="{{ $item->qty }}">
                                                <button class="qty-btn plus">+</button>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            Rp{{ number_format(($item->variantProduct->harga ?? 0) * $item->qty, 0, ',', '.') }}
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

                    <form class="form-inline" style="margin-top: 20px;">
                        <input type="text" class="form-control" placeholder="Coupon code">
                        <button type="submit" class="btn btn-primary"
                            style="background: #111; border-color: #111; color: #fff;">Apply coupon</button>
                    </form>
                @else
                    <div class="text-center" style="padding: 60px 0;">
                        <p class="lead">Tidak ada produk di keranjang.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-dark">Belanja Sekarang</a>
                    </div>
                @endif
            </div>

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
                    <a href="#" class="btn btn-block btn-primary"
                        style="background: #111; border-color: #111; color: #fff;">Proceed to checkout</a>
                </div>
            </div>
            @endif
        </div>
    </div>




    </div>
@endsection

@push('scripts')

<script>
    document.querySelectorAll('.remove-cart-item').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const itemId = this.getAttribute('data-id');

            fetch(`/User/cart/${itemId}/remove`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menghapus item.');
                return res.json();
            })
            .then(data => {
                // Hapus baris item dari tabel jika ada
                const row = this.closest('tr');
                if (row) row.remove();

                toastr.success(data.success || 'Item berhasil dihapus dari keranjang.');
            })
            .catch(err => {
                console.error(err);
                toastr.error('Terjadi kesalahan saat menghapus item dari keranjang.');
            });
        });
    });
</script>

<script>
document.querySelectorAll('.qty-btn').forEach(button => {
    button.addEventListener('click', function () {
        const input = this.parentElement.querySelector('.qty-input');
        let value = parseInt(input.value);
        if (this.classList.contains('minus') && value > 1) {
            input.value = value - 1;
        } else if (this.classList.contains('plus')) {
            input.value = value + 1;
        }
    });
});
</script>
    
@endpush


