@props(['bidangs'])
{{-- Loading Overlay --}}

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data Bidang</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="bidangTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;">No</th>
                            <th style="font-size: small;">Kode Bidang</th>
                            <th style="font-size: small;">Nama Bidang</th>
                            <th style="font-size: small;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bidangs as $bidang)
                        <tr>
                            <td style="font-size: small;">{{ $loop->iteration }}</td>
                            <td style="font-size: small;">{{ $bidang->kode_bidang }}</td>
                            <td style="font-size: small;">{{ $bidang->nama_bidang }}</td>
                            <td style="font-size: small;" class="text-center">
                                <div class="list-unstyled text-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="edit">
                                        <a href="{{ route('admin.bidang.edit',$bidang->id) }}" class="mx-2 text-warning">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                    </li>
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
    let table = new DataTable('#bidangTable', {
        ordering: false,
        autoWidth: false,
    });
</script>
@endpush()