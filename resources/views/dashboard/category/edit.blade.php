<div class="modal fade" id="editModalCategory" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
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

                                <div class="row mb-3 mt-1">
                                    <div class="col-md-12">
                                        <label for="category_name" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" required>
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
                    </div>
            </form>
        </div>
    </div>
</div>
