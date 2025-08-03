<div class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-add-stock">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddStockLabel">Tambah Stok Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="product-slug" name="slug">
                    
                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <div id="product-nama" class="fw-bold text-primary"></div>
                    </div>
                    
                    <input type="hidden" id="variant-id" name="variant_id">

                    <div class="mb-3">
                        <label for="variant-ukuran">Ukuran</label>
                        <select id="variant-ukuran" name="ukuran" class="form-select">
                            <option value="">Pilih ukuran</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Stok</label>
                        <div class="row g-2 align-items-center">
                            <div class="col-4">
                                <input type="number" id="stok-sebelumnya" class="form-control bg-light" readonly placeholder="Stok awal">
                            </div>
                            <div class="col-4">
                                <input type="number" id="stok-tambah" name="stok_tambah" class="form-control" min="0" placeholder="+ Tambah">
                            </div>
                            <div class="col-4">
                                <input type="number" id="stok-total" class="form-control bg-light" readonly placeholder="Total">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn-update-stock">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
