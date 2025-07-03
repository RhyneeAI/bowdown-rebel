<div class="modal fade" id="createModalCategory" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Buat Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- FORM MULAI -->
            <form id="createForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="card-body">

                        <div class="row mb-3 mt-1">
                            <div class="col-md-12">
                                <label for="category_name" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                            </div>
                        </div>

                        <!-- Tambahkan input gambar -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="category_image" class="form-label">Gambar Kategori</label>
                                <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                            </div>
                        </div>

                        <!-- Opsional: Preview gambar -->
                        <div class="row" id="preview-container" style="display: none;">
                            <div class="col-md-12 text-center">
                                <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded mt-2" style="max-height: 200px; object-fit: cover;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- FORM SELESAI -->

        </div>
    </div>
</div>
<script>
document.getElementById('category_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
});
</script>
