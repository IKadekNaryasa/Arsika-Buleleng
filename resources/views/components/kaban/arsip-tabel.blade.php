@props(['arsips'])


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
                            <td style="font-size: small;">{{ $arsip->status_legalisasi }}</td>
                            <td style="font-size: small;">{{ $arsip->type }}</td>
                            <td style="font-size: small;">{{ $arsip->user->bidang->kode_bidang }}</td>
                            <td style="font-size: small;" class="justify-content-center d-flex">
                                <ul class="list-unstyled d-flex mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="Pratinjau">
                                        <a href="{{ route('kbn.arsip.show', $arsip->id) }}?v={{ $arsip->updated_at->timestamp }}" target="_blank" class="mx-2 text-primary">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Detail">
                                        <button type="button" class="btn btn-link p-0 mx-2 text-info" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $arsip->kode_arsip }}">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach($arsips as $arsip)
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let table = new DataTable('#arsipTable');
</script>
@endpush