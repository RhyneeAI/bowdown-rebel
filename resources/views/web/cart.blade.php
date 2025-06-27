<!DOCTYPE html>
<html>

<head>
    @include('web.partials.header')
</head>

<body>
    <div class="fh5co-loader"></div>
    <div id="page">
        @include('web.partials.navbar')
        <!-- Shopping Cart Page -->
        <div class="container" style="padding: 60px 0;">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-md-8 col-sm-12">
                    <a href="#" style="display: inline-block; margin-bottom: 20px;"><i class="icon-arrow-left"></i>
                        Continue Shopping</a>
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <tbody>
                                <tr>
                                    <td style="width: 120px;">
                                        <img src="{{ asset('assets') }}/web/images/pict_bowdown/shirt1.png"
                                            class="img-responsive" alt="">
                                    </td>
                                    <td>
                                        <strong>World Wide BK</strong><br>
                                        <span>Rp169.000</span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div class="quantity-control">
                                            <button class="qty-btn minus">−</button>
                                            <input type="text" class="qty-input" value="2">
                                            <button class="qty-btn plus">+</button>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">Rp169.000</td>
                                    <td style="vertical-align: middle; text-align: right;">
                                        <a href="#" class="text-danger"><i class="icon-cross"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <form class="form-inline" style="margin-top: 20px;">
                        <input type="text" class="form-control" placeholder="Coupon code">
                        <button type="submit" class="btn btn-primary"
                            style="background: #111; border-color: #111; color: #fff;">Apply coupon</button>
                    </form>
                </div>

                <!-- Cart Totals -->
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
            </div>
        </div>
        @include('web.partials.footer')
        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
        </div>


    </div>
</body>
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

</html>
