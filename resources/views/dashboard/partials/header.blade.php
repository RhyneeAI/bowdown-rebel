<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin Dashboard</title>
<link rel="shortcut icon" type="image/png" href="{{ asset('assets') }}/dashboard/logos/seodashlogo.png" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/dashboard/css/styles.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/slimselect.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/quill.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .card-body {
        margin: -10px;
    }

     .red-asterisk {
        color: red;
        font-weight: 600;
    }

    .btn-preview, .btn-edit, .btn-delete {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-preview:hover, .btn-edit:hover, .btn-delete:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .border-active {
        border: 1px dashed #198754;
        padding: 2px;
    }

    .border-nonactive {
        border: 1px dashed #dc3545;
        padding: 2px;
    }
</style>
@stack('css')