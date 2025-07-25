@extends('dashboard.partials.main')

@push('css')
<style>
    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }

    .form-switch .form-check-input:checked {
        background-color: #198754; /* warna hijau bootstrap */
    }

    .form-switch .form-check-input::before {
        transform: scale(1.4);
        top: 2px;
    }

    .carousel-arrows {
        color: rgb(255, 246, 246) !important; 
        font-size: 48px; 
        font-weight: 800;
        background-color: rgb(0, 0, 0);
        opacity: 0.8;, 
        height: 100%
    }
</style>
@endpush

@section('title')
Tambah Produk
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form method="POST" enctype="multipart/form-data" action="{{ route($role.'.product.store') }}" id="form-produk">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="my-3">
                                <label class="form-label fw-semibold">Nama Produk <sup class="red-asterisk">*</sup></label>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                            </div>

                            <div class="my-3">
                                <label class="form-label fw-bold">Kategori Produk <sup class="red-asterisk">*</sup></label>
                                <select class="form-select fw-bold" name="id_kategori" id="id_kategori">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-3">
                                <label class="form-label fw-semibold">Deskripsi <sup class="red-asterisk">*</sup></label>
                                <div id="deskripsi-editor">
                                    <p><br></p>
                                    <p><br></p>
                                </div>
                                <input type="hidden" name="deskripsi" id="deskripsi">
                            </div>

                            <div class="my-3 d-flex align-items-center">
                                <label class="form-label fw-semibold mt-1">Aktif / Tidak Aktif <sup class="red-asterisk">*</sup></label>
                                <div class="form-check form-switch m-0 mx-3">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="on" checked>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 text-center">
                            <div class="col-md-12 mt-3">
                                <label for="foto" class="form-label">Tambah Gambar (bisa lebih dari satu) <sup class="red-asterisk">*</sup></label>
                                <input type="file" class="form-control" id="foto" name="foto[]" multiple>
                            </div>
                            
                            <div class="carousel slide mt-4" id="productCarousel" data-bs-ride="carousel">
                                <div class="carousel-inner" id="preview-images"></div>

                                <button class="carousel-control-prev carousel-arrows" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next carousel-arrows" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                            {{-- <div id="preview-images" class="row mt-3 gx-2 gy-2"></div> --}}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h4 class="fw-bold mt-4 mb-3">Detail Produk</h4>
                        <div id="varian-container"></div>
                        <button type="button" class="btn btn-primary mt-3" id="add_varian">Tambah Varian Baru</button>

                        <div class="col-md-12 mt-5 text-end">
                            <a href="{{ route($role.'.product.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    let images;
    $(document).ready(function() {
        images = MultiImagePreviews('#foto', '#preview-images');
        const quill = InitQuill('#deskripsi-editor');

        const ukuranOptions = ['Pcs', 'S', 'M', 'L', 'XL', 'XXL'];

        $('#form-produk').submit(function(e) {
            e.preventDefault();
            const { formData, files, varian } = generateFormData(this);

            const variableToCheck = {
                nama_produk: $('#nama_produk').val(),
                kategori_produk: $('#id_kategori').val(),
                deskripsi_produk: $('#deskripsi').val(),
                foto: files.length,
                varian: varian.length
            };

            if (ValidateInputs(variableToCheck)) {
                 $.ajax({
                    url: $('#form-produk').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        toastr.success(res.message);
                        console.log(res.system_message);

                        if (res.redirect) {
                            setTimeout(() => {
                                window.location.href = res.redirect;
                            }, 1000);
                        }
                    },
                    error: function (xhr) {
                        const message = xhr.responseJSON?.message || 'Terjadi kesalahan tak terduga';
                        toastr.error(message);
                    }
                });
            } 
        })

        function generateFormData(form) {
            const deskripsiHTML = quill.root.innerHTML;
            $('#deskripsi').val(deskripsiHTML);

            const formData = new FormData(form);
            const files = images.getSelectedFiles();
            files.forEach(file => {
                formData.append('foto[]', file);
            });

            let varian = [];
            $('#varian-container .varian-row').each(function() {
                varian.push({
                    ukuran: $(this).find('select[name="ukuran[]"]').val(),
                    harga: $(this).find('input[name="harga[]"]').val(),
                    stok: $(this).find('input[name="stok[]"]').val(),
                    min_stok: $(this).find('input[name="min_stok[]"]').val()
                });
            });
            formData.append('varian', JSON.stringify(varian));

            formData.delete('ukuran[]');
            formData.delete('harga[]');
            formData.delete('stok[]');
            formData.delete('min_stok[]');

            return { formData, files, varian };
        }

        function renderUkuranOptions(selectedList = [], selectedValue = '') {
            return ukuranOptions.map(uk => {
                const disabled = selectedList.includes(uk) && uk !== selectedValue ? 'disabled' : '';
                const color = selectedList.includes(uk) && uk !== selectedValue ? 'style="color: red;"' : '';

                const selected = uk === selectedValue ? 'selected' : '';
                return `<option value="${uk}" ${disabled} ${selected} ${color}>${uk}</option>`;
            }).join('');
        }

        function updateAllDropdowns() {
            let selectedList = [];
            $('#varian-container select[name="ukuran[]"]').each(function () {
                const val = $(this).val();
                if (val) selectedList.push(val);
            });

            $('#varian-container select[name="ukuran[]"]').each(function () {
                const currentVal = $(this).val();
                $(this).html(renderUkuranOptions(selectedList, currentVal));
            });
        }

        let countRow = 0;
        function checkVarianRow() {
            $('#add_varian').show()
            
            if (countRow >= 6) {
                $('#add_varian').hide()
            }
        }

        $('#add_varian').on('click', function () {
            countRow++;
            checkVarianRow();

            const selectedList = $('#varian-container select[name="ukuran[]"]').map(function () {
                return $(this).val();
            }).get();

            const newRow = `
                <div class="row mb-3 varian-row">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ukuran <sup class="red-asterisk">*</sup></label>
                        <select class="form-select" name="ukuran[]">
                            ${renderUkuranOptions(selectedList)}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Harga <sup class="red-asterisk">*</sup></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" class="form-control harga-input" name="harga[]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Stok <sup class="red-asterisk">*</sup></label>
                        <input type="number" class="form-control" name="stok[]" value="1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Min Stok <sup class="red-asterisk">*</sup></label>
                        <input type="number" class="form-control" name="min_stok[]" value="1">
                    </div>
                    <div class="col-md-1 mt-4" style="margin-top: 1.9rem !important;">
                        <button type="button" class="btn btn-danger btn-hapus btn-sm brn-rounded">
                            <iconify-icon icon="mdi:trash-can-outline" style="font-size: 20px; padding-top: 4px;"></iconify-icon>
                        </button>
                    </div>
                </div>`;

            $('#varian-container').append(newRow);
            updateAllDropdowns();
        });

        $('#varian-container').on('change', 'select[name="ukuran[]"]', function () {
            updateAllDropdowns();
        });

        $('#varian-container').on('click', '.btn-hapus', function () {
            countRow--;
            $(this).closest('.varian-row').remove();
            updateAllDropdowns();
            checkVarianRow();
        });

        $('#add_varian').trigger('click');
        
        $(document).on('keyup', '.harga-input', function () {
            let raw = $(this).val().replace(/\D/g, ''); 
            let limited = raw.substring(0, 8);
            let formatted = FormatRupiah(limited);
            $(this).val(formatted);
        });
    })
</script>
@endpush
