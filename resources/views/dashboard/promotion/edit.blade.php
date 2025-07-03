<div class="modal fade" id="editModalPromotion" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Promosi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createForm" method="POST">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <form id="articleForm" action=""
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">UPLOAD BANNER PROMOSI</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/png, image/jpeg, image/jpg, image/webp" required>
                                        <small class="form-text text-muted">Hanya file PNG, JPG, JPEG, dan WEBP yang
                                            diizinkan.</small>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="promotion_kode" class="form-label">Kode Promosi/voucher</label>
                                        <input type="text" class="form-control" id="promotion_kode"
                                            name="promotion_kode" required>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="stock" class="form-label">Stok / Kuota</label>
                                        <input type="text" class="form-control" id="stock" name="stock" required>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="expiration_date" class="form-label">Tanggal Berakhir</label>
                                        <input type="text" class="form-control" id="expiration_date"
                                            name="expiration_date" required>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="promotion_type" class="form-label">Jenis Promosi</label>
                                        <select name="promotion_type" id="">
                                            <option value="percent">Diskon Persen</option>
                                            <option value="price">Diskon Harga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="percent_discount" class="form-label">Diskon dalam %</label>
                                        <input type="text" class="form-control" id="percent_discount"
                                            name="percent_discount" required>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="price_discount" class="form-label">Diskon dalam pengurangan
                                            harga</label>
                                        <input type="text" class="form-control" id="price_discount"
                                            name="price_discount" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <button type="button" class="btn btn-danger"
                                            onclick="history.back()">Kembali</button>
                                        <button type="submit" class="btn btn-success">Simpan data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
            </form>
        </div>
    </div>
</div>
