function formatRupiah(element) {
    // ambil nilai dari form itu sendiri
    var nilai = element.val();

    // hilangkan format rupiah dengan menghilangkan titik dan koma
    var number_string = nilai.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah lebih dari 3 digit
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    element.val(rupiah)
}

function toRupiahFormat(number) {
    if (typeof number !== 'number') {
        number = parseInt(number.toString().replace(/[^0-9]/g, '')) || 0;
    }

    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function toRupiahFormatWithDecimal(number) {
    // Bersihkan input jika berupa string
    if (typeof number === 'string') {
        number = parseFloat(number.replace(/[^0-9.,]/g, '').replace(',', '.')) || 0;
    }

    // Format dengan dua angka di belakang koma
    const parts = number.toFixed(2).split('.');
    const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    const decimalPart = parts[1];

    return `${integerPart},${decimalPart}`;
}