function ImagePreview(inputSelector, previewSelector, maxSizeMB = 4) {
    $(inputSelector).on('change', function (event) {
        const file = event.target.files[0];
        const $preview = $(previewSelector);
        const maxSize = maxSizeMB * 1024 * 1024;
        
        if (file.size > maxSize) {
            toastr.error('Ukuran gambar maksimal ' + maxSizeMB + 'MB per file', 'Validasi Gagal');
            $(this).val(''); 
            $preview.hide();
            return;
        }

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $preview.attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $preview.hide();
        }
    });
}

function MultiImagePreviews(inputSelector, containerSelector, maxFile = 5, maxSizeMB = 2) {
    const maxSize = maxSizeMB * 1024 * 1024;
    let selectedFiles = [];

    // Fungsi untuk menambah gambar dari path (misal: hasil edit)
    function loadImagesFromPaths(paths) {
        const $container = $(containerSelector);
        paths.forEach((item) => {
            selectedFiles.push({ id: item.file_hashname, file: null });

            const isActive = $container.find('.carousel-item.active').length === 0;

            // Untuk gambar dari path:
            const $previewItem = $(`
                <div class="carousel-item${isActive ? ' active' : ''}" data-id="${item.file_hashname}">
                    <div class="d-flex align-middle" style="height: 200px; position: relative;">
                        <img src="${item.path}" class="img-fluid rounded" style="max-height: 90%; max-width: 100%; object-fit: contain;">
                    </div>
                </div>
            `);
            const $removeBtn = $('<button>', {
                html: '&times;',
                class: 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle',
                css: { 'z-index': 10 }
            }).on('click', function () {
                selectedFiles = selectedFiles.filter(f => f.id !== item.file_hashname);
                $previewItem.remove();
                if ($container.find('.carousel-item.active').length === 0) {
                    $container.find('.carousel-item').first().addClass('active');
                }
            });
            $previewItem.find('.d-flex').append($removeBtn);
            $container.append($previewItem);
        });
    }

    $(inputSelector).on('change', function (event) {
        if (selectedFiles.length >= maxFile) {
            toastr.warning('Gambar yang diinput max ' + maxFile, 'Limit');
            return;
        }

        const files = event.target.files;
        const $container = $(containerSelector);

        if (!files.length) return;

        Array.from(files).forEach((file) => {
            if (!file.type.startsWith('image/')) return;

            if (file.size > maxSize) {
                toastr.error('Ukuran gambar maksimal ' + maxSizeMB + 'MB per file', 'Validasi Gagal');
                return;
            }

            const uniqueId = Date.now() + '_' + Math.random().toString(36).substr(2, 5);
            selectedFiles.push({ id: uniqueId, file });

            const reader = new FileReader();
            reader.onload = function (e) {
                const isActive = $container.find('.carousel-item.active').length === 0;
                const $previewItem = $(`
                    <div class="carousel-item${isActive ? ' active' : ''}" data-id="${uniqueId}">
                        <div class="d-flex align-middle" style="height: 200px; position: relative;">
                            <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 90%; max-width: 100%; object-fit: contain;">
                        </div>
                    </div>
                `);
                const $removeBtn = $('<button>', {
                    html: '&times;',
                    class: 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle',
                    css: { 'z-index': 10 }
                }).on('click', function () {
                    selectedFiles = selectedFiles.filter(f => f.id !== uniqueId);
                    $previewItem.remove();
                    if ($container.find('.carousel-item.active').length === 0) {
                        $container.find('.carousel-item').first().addClass('active');
                    }
                });
                $previewItem.find('.d-flex').append($removeBtn);
                $container.append($previewItem);
            };
            reader.readAsDataURL(file);
        });

        $(this).val('');
    });

    return {
        getSelectedFiles: function () {
            // Hanya file upload yang bisa dikirim ke backend
            return selectedFiles.filter(f => f.file).map(f => f.file);
        },
        getAllImages: function () {
            // Untuk keperluan lain, misal menampilkan semua (file upload & path)
            return selectedFiles;
        },
        loadImages: loadImagesFromPaths // method untuk load dari path
    };
}

function ValidateInputs(data) {
    for (const [key, value] of Object.entries(data)) {
        const readableKey = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

        console.log(key, data);
        

        if (value === '' || value === null || value === undefined || value === 0) {
            toastr.error(`${readableKey} wajib diisi.`, 'Validasi Gagal');
            return false;
        }
    }
    return true;
}

function FormatRupiah(angka) {
    return angka.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function InitQuill(element, innerValue = '') {
    const quill = new Quill(element, {
        theme: 'snow'
    });

    if (innerValue) {
        quill.clipboard.dangerouslyPasteHTML(innerValue);
    }

    return quill;
}

function ShowLoading(title) {
    return Swal.fire({
                title: title,
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false
            });
}
