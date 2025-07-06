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
    
    $(inputSelector).on('change', function (event) {
        if(selectedFiles.length >= maxFile) {
            toastr.warning('Gambar yang diinput max ' + maxFile, 'Limit');
            return;
        }

        const files = event.target.files;
        const $container = $(containerSelector);

        if (!files.length) return;


        Array.from(files).forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            if (file.size > maxSize) {
                toastr.error('Ukuran gambar maksimal ' + maxSizeMB + 'MB per file', 'Validasi Gagal');
                return;
            }

            const uniqueId = Date.now() + '_' + Math.random().toString(36).substr(2, 5);
            selectedFiles.push({ id: uniqueId, file });

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = $('<img>', {
                    src: e.target.result,
                    class: 'img-thumbnail mb-2',
                    css: {
                        width: '100%',
                        height: 'auto',
                        maxHeight: '150px',
                        objectFit: 'cover'
                    }
                });

                const removeBtn = $('<button>', {
                    text: 'x',
                    class: 'btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle',
                    click: function () {
                        selectedFiles = selectedFiles.filter(f => f.id !== uniqueId);
                        previewCol.remove();
                    }
                });

                const wrapper = $('<div>', {
                    class: 'position-relative'
                }).append(img).append(removeBtn);

                const previewCol = $('<div>', {
                    class: 'col-6 preview-col'
                }).append(wrapper);

                $container.append(previewCol);
            };
            reader.readAsDataURL(file);
        });

        $(this).val('');
    });

    return {
        getSelectedFiles: function () {
            return selectedFiles.map(f => f.file);
        }
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

function InitQuill(element) {
    const quill = new Quill(element, {
        theme: 'snow'
    });

    return quill;
}
