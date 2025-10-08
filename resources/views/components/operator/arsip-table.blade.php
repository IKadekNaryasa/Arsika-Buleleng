@props(['arsips'])

{{-- CSS untuk Loading Overlay --}}
<style>
    .delete-loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 999999;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .delete-loading-content {
        text-align: center;
        background-color: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        min-width: 300px;
    }

    .delete-button-loading {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

{{-- Loading Overlay untuk Delete --}}
<div id="deleteLoadingOverlay" class="delete-loading-overlay">
    <div class="delete-loading-content">
        <div class="spinner-border text-danger mb-3" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="text-danger">Menghapus Arsip...</h5>
        <p class="text-muted">Mohon tunggu, sedang menghapus data dan file!</p>
    </div>
</div>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Arsip</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped" id="arsipTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;">No</th>
                            <th style="font-size: small;">Kode Arsip</th>
                            <th style="font-size: small;">Klasifikasi</th>
                            <th style="font-size: small;">Legalisasi</th>
                            <th style="font-size: small;">Type</th>
                            <th style="font-size: small;">Bidang</th>
                            <th style="font-size: small;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arsips as $arsip)
                        <tr>
                            <td style="font-size: small;">{{ $loop->iteration }}</td>
                            <td style="font-size: small;">{{ $arsip->kode_arsip }}</td>
                            <td style="font-size: small;">{{ $arsip->kode_klasifikasi }}</td>
                            <td style="font-size: small;">
                                @if ($arsip->status_legalisasi == 'onProgress')
                                <span class="badge bg-warning">{{ $arsip->status_legalisasi }}</span>
                                @elseif($arsip->status_legalisasi == 'legal')
                                <span class="badge bg-success">{{ $arsip->status_legalisasi }}</span>
                                @endif
                            </td>
                            <td style="font-size: small;">{{ $arsip->type }}</td>
                            <td style="font-size: small;">{{ $arsip->user->bidang->kode_bidang }}</td>
                            <td style="font-size: small;" class="justify-content-center d-flex">
                                <ul class="list-unstyled d-flex mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="Pratinjau">
                                        <a href="{{ route('arsip.show', $arsip->id) }}?v={{ $arsip->updated_at->timestamp }}" target="_blank" class="mx-2 text-primary">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Detail">
                                        <button type="button" class="btn btn-link p-0 mx-2 text-info" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $arsip->kode_arsip }}">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Delete">
                                        <button type="button" class="btn btn-link p-0 mx-2 text-danger" onclick="confirmDelete(this, '{{ $arsip->id }}', '{{ $arsip->kode_arsip }}')">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </li>
                                </ul>

                                <form method="POST" id="deleteForm-{{ $arsip->id }}" action="{{ route('arsip.destroy', $arsip->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <div class="modal fade" id="modalDetail-{{ $arsip->kode_arsip }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Arsip {{ $arsip->kode_arsip }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Kode Arsip</div>
                                                        <div class="col-8">: {{ $arsip->kode_arsip }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Kategori</div>
                                                        <div class="col-8">: {{ $arsip->kategori }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Kode Klasifikasi</div>
                                                        <div class="col-8">: {{ $arsip->kode_klasifikasi }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Tanggal Arsip</div>
                                                        <div class="col-8">: {{ $arsip->tanggal_arsip }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Nama File</div>
                                                        <div class="col-8">: {{ $arsip->nama_file }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Type</div>
                                                        <div class="col-8">: {{ $arsip->type }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Status Legalisasi</div>
                                                        <div class="col-8">: {{ $arsip->status_legalisasi }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Kode Bidang</div>
                                                        <div class="col-8">: {{ $arsip->user->bidang->kode_bidang }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Bidang</div>
                                                        <div class="col-8">: {{ $arsip->user->bidang->nama_bidang }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Uraian</div>
                                                        <div class="col-8">: {{ $arsip->uraian }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-4 fw-bold">Pratinjau</div>
                                                        <div class="col-8">:
                                                            <a href="{{ route('arsip.show', $arsip->id) }}?v={{ $arsip->updated_at->timestamp }}" target="_blank" class="mx-2 text-primary">
                                                                <i class='bx bxs-show'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @if ($arsip->status_legalisasi == 'onProgress')
                                                    <!-- <div class="row mb-2">
                                                        <form action="" method="">
                                                            @csrf
                                                            <div class="col-12"><strong>LEGALISASI</strong> : <button class="btn btn-primary btn-sm">Tambahkan Legalisasi</button></div>
                                                        </form>
                                                    </div> -->
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let table = new DataTable('#arsipTable');
</script>
<script>
    function confirmDelete(button, arsipId, kodeArsip) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Data arsip "${kodeArsip}" akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                $(button).addClass('delete-button-loading');
                const overlay = document.getElementById('deleteLoadingOverlay');
                overlay.style.display = 'flex';
                const form = document.getElementById('deleteForm-' + arsipId);
                if (form) {
                    form.submit();
                } else {
                    console.error('Form delete tidak ditemukan: deleteForm-' + arsipId);
                    overlay.style.display = 'none';
                    $(button).removeClass('delete-button-loading');
                }
            }
        });
    }

    function hideDeleteLoading() {
        const loadingOverlay = document.getElementById('deleteLoadingOverlay');
        if (loadingOverlay) {
            loadingOverlay.style.display = 'none';
        }
        $('.delete-button-loading').removeClass('delete-button-loading');
    }

    window.addEventListener('pageshow', function(event) {
        hideDeleteLoading();
    });
</script>
@endpush