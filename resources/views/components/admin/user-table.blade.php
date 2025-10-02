@props(['users'])
<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Data User</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped" id="userTable">
                    <thead>
                        <tr>
                            <th style="font-size: small;">No</th>
                            <th style="font-size: small;">Nama</th>
                            <th style="font-size: small;">Instansi/Bidang</th>
                            <th style="font-size: small;">Email</th>
                            <th style="font-size: small;">Role</th>
                            <th style="font-size: small;">Status</th>
                            <th style="font-size: small;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td style="font-size: small;">{{ $loop->iteration }}</td>
                            <td style="font-size: small;">{{ $user->name }}</td>
                            <td style="font-size: small;">{{ $user->bidang->nama_bidang }}</td>
                            <td style="font-size: small;">{{ $user->email }}</td>
                            <td style="font-size: small;">{{ $user->role }}</td>
                            <td style="font-size: small;">{{ $user->status }}</td>
                            <td style="font-size: small;" class="justify-content-center d-flex">
                                <ul class="list-unstyled d-flex mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="Pratinjau">
                                        <a href="" class="mx-2 text-primary">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Detail">
                                        <button type="button" class="btn btn-link p-0 mx-2 text-info" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                            <i class='bx bxs-info-circle'></i>
                                        </button>
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
    let table = new DataTable('#userTable');
</script>
@endpush()