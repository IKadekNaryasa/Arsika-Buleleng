@props(['arsips'])
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .d-none {
        display: none !important;
    }

    .form-disabled {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<div id="loadingOverlay" class="loading-overlay d-none">
    <div class="loading-content text-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Memproses Legalisasi...</p>
    </div>
</div>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Arsip Belum dilegalisasi</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table w-100 table-striped" id="arsipTable">
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
                            <td style="font-size: small;">{{ $arsip->kodeKlasifikasi->kode }}</td>
                            <td style="font-size: small;">
                                @if ($arsip->status_legalisasi == 'onProgress')
                                <span class="badge bg-warning">{{ $arsip->status_legalisasi }}</span>
                                @elseif($arsip->status_legalisasi == 'legal')
                                <span class="badge bg-success">{{ $arsip->status_legalisasi }}</span>
                                @endif
                            </td>
                            <td style="font-size: small;">{{ $arsip->type }}</td>
                            <td style="font-size: small;">{{ $arsip->user->bidang->kode_bidang }}</td>
                            <td style="font-size: small;" class="text-center">
                                <div class="list-unstyled d-flex mb-0 text-start">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="Pratinjau">
                                        <a href="{{ route('legalizer.arsip.show', $arsip->id) }}" target="_blank" class="mx-2 text-primary">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Detail">
                                        <button type="button" class="btn btn-link p-0 mx-2 text-info" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $arsip->kode_arsip }}">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                    </li>
                                    <!-- modal -->
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
                                                            <div class="col-8">: {{ $arsip->kodeKlasifikasi->kode  }}</div>
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
                                                        <hr>
                                                        <div class="row mb-2">
                                                            <div class="col-4 fw-bold">Legalisasi</div>
                                                            <div class="col-8 d-flex">:
                                                                <form action="{{ route('legalizer.arsip.legalisasi') }}?v={{ $arsip->updated_at->timestamp }}" method="post" class="form-legalisasi">
                                                                    @csrf
                                                                    <input type="hidden" name="kode_arsip" value="{{ $arsip->kode_arsip }}">
                                                                    <button class="btn btn-sm btn-primary ms-1" type="submit">Legalisasi</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
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
    let table = new DataTable('#arsipTable', {
        autoWidth: false,
    });
</script>

@push('script')
<script>
    $(document).ready(function() {
        $('#arsipTable').DataTable();

        $('.form-legalisasi').on('submit', function() {
            $('#loadingOverlay').removeClass('d-none');
            $(this).find('button[type=submit]')
                .prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm" role="status"></span> Memproses...');
        });
    });
</script>
@endpush

@endpush