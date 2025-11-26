@props(['klasifikasies'])
{{-- Loading Overlay --}}

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Kode Klasifikasi</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="klasifikasiTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;">No</th>
                            <th style="font-size: small;">Kode Klasifikasi</th>
                            <th style="font-size: small;">Keterangan</th>
                            <th style="font-size: small;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($klasifikasies as $klasifikasi)
                        <tr>
                            <td style="font-size: small;">{{ $loop->iteration }}</td>
                            <td style="font-size: small;">{{ $klasifikasi->kode }}</td>
                            <td style="font-size: small;">{{ $klasifikasi->keterangan }}</td>
                            <td style="font-size: small;" class="justify-content-center d-flex">
                                <ul class="list-unstyled text-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="edit">
                                        <a href="{{ route('admin.klasifikasi.edit',['klasifikasi' => $klasifikasi->id]) }}" class="mx-2 text-warning">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                    </li>
                                </ul>
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
    let table = new DataTable('#klasifikasiTable', {
        ordering: false,
        autoWidth: false,
    });
</script>
@endpush()