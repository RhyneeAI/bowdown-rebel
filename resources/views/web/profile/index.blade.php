@extends('web.partials.main')
@push('css')
    <style>
        .alamat-group {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            position: relative;
        }
/* The switch - the box around the slider */
.switch {
  font-size: 10px;
  position: relative;
  display: inline-block;
  width: 3.5em;
  height: 2em;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  inset: 0;
  background: #9fccfa;
  border-radius: 50px;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.slider:before {
  position: absolute;
  content: "";
  display: flex;
  align-items: center;
  justify-content: center;
  height: 2em;
  width: 2em;
  inset: 0;
  background-color: white;
  border-radius: 50px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.4);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.switch input:checked + .slider {
  background: #0974f1;
}

.switch input:focus + .slider {
  box-shadow: 0 0 1px #0974f1;
}

.switch input:checked + .slider:before {
  transform: translateX(1.6em);
}

.btn-xs {
padding: 0.150rem 0.50rem;
font-size: 1.5rem;
line-height: 1.5;
border-radius: 0.2rem;
}
    .order-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 1rem;
        transition: box-shadow 0.3s;
    }
    .order-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .order-card-header {
        background-color: #f8f9fa;
        padding: 1rem;
        border-bottom: 1px solid #e0e0e0;
        font-weight: bold;
    }
    .order-card-body {
        padding: 1rem;
    }

    .order-details {
        margin-bottom: 1rem;
    }
    .order-details p {
        margin-bottom: 0.5rem;
    }
    .badge-xs {
    font-size: 0.75rem;
    padding: 0.25em 0.5em;
    line-height: 1.5;
    border-radius: 0.2rem;
}
</style>
@endpush

@section('content')
<div class="fh5co-loader"></div>
<div class="page">
    <div class="col-md-12">
        <div class="fh5co-heading text-center">
            <h2>Profile</h2>
        </div>
        <div class="fh5co-tabs animate-box">
            <ul class="fh5co-tab-nav">
                <li class="active">
                    <a href="#" data-tab="1">
                        <span class="icon visible-xs">
                            <i class="icon-user"></i>
                        </span>
                        <span class="hidden-xs">Detail Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-tab="2">
                        <span class="icon visible-xs">
                            <i class="icon-bag"></i>
                        </span>
                        <span class="hidden-xs">My Order</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-tab="3">
                        <span class="icon visible-xs">
                            <i class="icon-clock"></i>
                        </span>
                        <span class="hidden-xs">Order History</span>
                    </a>
                </li>
            </ul>

            <!-- Tabs -->
            <div class="fh5co-tab-content-wrap">
                <div class="fh5co-tab-content tab-content active" data-tab-content="1">

                    <form method="POST" action="{{ route($role.'.profile.update') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama', $user->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <div class="position-relative">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat Wrapper -->
                        <div id="alamat-wrapper">
                        @foreach($user->addresses as $index => $address)
                            <div class="alamat-group" data-id="{{ $address->id }}">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1 me-2">
                                        <label class="form-label">Alamat</label>
                                        <input type="hidden" name="address_id[]" value="{{ $address->id }}">
                                        <input type="text"
                                            class="form-control @error('alamat.' . $index) is-invalid @enderror"
                                            name="alamat[]"
                                            value="{{ old('alamat.' . $index, $address->alamat) }}"
                                            placeholder="Alamat {{ $index + 1 }}">
                                        @error('alamat.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check form-switch">
                                        <label class="switch me-2">
                                            <input type="radio" name="is_main" class="is-main-checkbox" value="{{ $address->id }}" {{ $address->is_main ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                        <label class="form-check-label">Jadikan Alamat Utama</label>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-xs" onclick="hapusAlamat(this)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="tambahAlamat()">+ Tambah
                            Alamat</button>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>

                <div class="fh5co-tab-content tab-content" data-tab-content="2">
                    <h4>Pesanan Sedang Dikirim</h4>
                    @if ($myorder->isEmpty())
                        <div class="text-center"><p>Tidak ada pesanan yang sedang dikirim.</p></div>

                    @else
                    <div class="row">
                        @foreach ($myorder as $order)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        Pesanan #{{ $order->no_faktur }}
                                    </div>
                                    <div class="order-card-body">
                                        <div class="order-details">
                                            <p><strong>Status:</strong> {{ $order->latestStatus->status ?? 'Tidak ada status' }}</p>
                                            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                            <p><strong>Ekspedisi:</strong> {{ $order->expedition->nama_ekspedisi ?? 'Tidak ada ekspedisi' }}</p>
                                            <p><strong>Resi:</strong> {{ $order->resi ?? 'Tidak ada resi' }}</p>
                                            <p><strong>Estimasi sampai :</strong> {{ $order->expedition->perkiraan_sampai ?? 'Tidak ada resi' }}</p>
                                            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                            <p><strong>Diskon:</strong> Rp {{ number_format($order->diskon, 0, ',', '.') }}</p>
                                            <p><strong>Produk:</strong></p>
                                            <ul>
                                                @foreach ($order->checkoutDetail as $detail)
                                                    <li>
                                                        {{ $detail->product->nama_produk ?? 'Produk tidak ditemukan' }}
                                                        @if ($detail->variant)
                                                            ({{ $detail->variant->nama_variant }} 
                                                            @if ($detail->variant->ukuran)
                                                                - Ukuran: {{ is_array($detail->variant->ukuran) ? implode(', ', $detail->variant->ukuran) : $detail->variant->ukuran }}
                                                            @endif)
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    <form method="POST" action="{{ route($role.'.checkout.selesai', $order->id) }}" class="status-form" onsubmit="return confirmUpdateStatus(event, this)">
                                        @csrf
                                        <input type="hidden" name="status" value="Selesai">
                                        <button type="submit" class="btn btn-warning btn-xs">
                                            <i class="icon-check"></i> Tandai Selesai
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="fh5co-tab-content tab-content" data-tab-content="3">
                    <h4>Pesanan Sedang Dikirim</h4>
                    @if ($myhistory->isEmpty())
                        <div class="text-center"><p>Tidak ada data pesanan.</p></div>
                    @else
                    <div class="row">
                        @foreach ($myhistory as $order)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        Pesanan #{{ $order->no_faktur }}
                                    </div>
                                    <div class="order-card-body">
                                        <div class="order-details">
                                            <p><strong>Status:</strong> {{ $order->latestStatus->status ?? 'Tidak ada status' }}</p>
                                            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                            <p><strong>Ekspedisi:</strong> {{ $order->expedition->nama_ekspedisi ?? 'Tidak ada ekspedisi' }}</p>
                                            <p>
                                                <strong>Resi:</strong> {{ $order->resi ?? 'Tidak ada resi' }}
                                                @if ($order->resi && $order->expedition && $order->expedition->link_ekspedisi)
                                                    <button type="button" class="btn btn-success btn-xs" onclick="window.open('{{ $order->expedition->link_ekspedisi }}', '_blank')">
                                                        <i class="icon-truck"></i> Lacak
                                                    </button>
                                                @endif
                                            </p>
                                            <p><strong>Estimasi sampai :</strong> {{ $order->expedition->perkiraan_sampai ?? 'Tidak ada resi' }}</p>
                                            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                            <p><strong>Diskon:</strong> Rp {{ number_format($order->diskon, 0, ',', '.') }}</p>
                                            <p><strong>Produk:</strong></p>
                                            <ul>
                                                @foreach ($order->checkoutDetail as $detail)
                                                    <li>
                                                        {{ $detail->product->nama_produk ?? 'Produk tidak ditemukan' }}
                                                        @if ($detail->variant)
                                                            ({{ $detail->variant->nama_variant }} 
                                                            @if ($detail->variant->ukuran)
                                                                - Ukuran: {{ is_array($detail->variant->ukuran) ? implode(', ', $detail->variant->ukuran) : $detail->variant->ukuran }}
                                                            @endif)
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <span class="badge badge-success badge-xs">{{ $order->latestStatus->status ?? 'Tidak ada status' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let alamatCount = {{ $user->addresses->count() ?: 1 }};

function tambahAlamat() {
    const timestamp = Date.now();
    const wrapper = document.getElementById('alamat-wrapper');

    const html = `
        <div class="alamat-group" data-id="new_${timestamp}">
            <div class="d-flex align-items-center mb-2">
                <div class="flex-grow-1 me-2">
                    <label class="form-label">Alamat</label>
                    <input type="hidden" name="address_id[]" value="">
                    <input type="text" class="form-control" name="alamat[]" placeholder="Alamat Baru">
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check form-switch">
                    <label class="switch me-2">
                        <input type="radio" name="is_main" class="is-main-checkbox" value="new_${timestamp}">
                        <span class="slider"></span>
                    </label>
                    <label class="form-check-label">Jadikan Alamat Utama</label>
                </div>

                <button type="button" class="btn btn-danger btn-xs" onclick="hapusAlamat(this)">
                    <i class="icon-trash"></i>
                </button>
            </div>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
}

async function hapusAlamat(el) {
    const group = el.closest('.alamat-group');

    if (!group) {
        toastr.error('Alamat group tidak ditemukan.');
        return;
    }

    const addressId = group.getAttribute('data-id');
    const totalGroups = document.querySelectorAll('.alamat-group').length;

    if (totalGroups <= 1) {
        toastr.error('Minimal satu alamat harus ada.');
        return;
    }

    const removeGroup = () => {
        group.remove();
        toastr.success('Alamat berhasil dihapus.');
    };

    if (addressId && !addressId.startsWith('new')) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch(`/User/profile/delete-alamat/${addressId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (!response.ok) throw new Error('Gagal hapus dari server.');

            removeGroup();
        } catch (err) {
            console.error(err);
            toastr.error('Terjadi kesalahan saat menghapus dari server.');
        }
    } else {
        removeGroup();
    }
}

document.addEventListener('change', function (e) {
    if (e.target.classList.contains('is-main-checkbox')) {
        document.querySelectorAll('.is-main-checkbox').forEach((cb) => cb.checked = false);
        e.target.checked = true;
    }
});

// Toastr notification dari Laravel flash message
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 5000
};

@if (session('success'))
    toastr.success('{{ session('success') }}');
@endif

@foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
@endforeach

// SweetAlert2 confirmation for status update
function confirmUpdateStatus(event, form) {
    event.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Status',
        text: 'Apakah Anda yakin ingin menandai pesanan ini sebagai Selesai?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Tandai Selesai',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    return false;
}
</script>
@endpush

