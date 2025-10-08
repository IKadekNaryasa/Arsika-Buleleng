@props(['users'])
{{-- Loading Overlay --}}
<x-overlay></x-overlay>

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
                            <td style="font-size: small;">
                                @if ($user->status == 'active')
                                <span class="badge bg-success">{{ $user->status }}</span>
                                @elseif($user->status == 'nonActive')
                                <span class="badge bg-danger">{{ $user->status }}</span>
                                @endif
                            </td>
                            <td style="font-size: small;" class="justify-content-center d-flex">
                                <ul class="list-unstyled d-flex ">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="left" class="pull-up" title="edit">
                                        <a href="{{ route('admin.user.edit',$user->id) }}" class="mx-2 text-warning">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="pull-up" title="Confirm">
                                        <form action="{{ route('admin.user.setStatus', $user->id) }}" method="POST" id="formUpdateUser{{ $user->id }}">
                                            @csrf
                                            @method('PUT')
                                            @if ($user->status == 'active')
                                            <input type="hidden" name="status" value="nonActive">
                                            <button type="button" class="btn btn-link p-0 mx-2 text-success"
                                                onclick="confirmNonactive('{{ $user->id }}', '{{ $user->name }}', 'Non Aktifkan')">
                                                <i class='bx bxs-info-circle'></i>
                                            </button>
                                            @elseif($user->status == 'nonActive')
                                            <input type="hidden" name="status" value="active">
                                            <button type="button" class="btn btn-link p-0 mx-2 text-danger" name="btnConfirm" value="active"
                                                onclick="confirmNonactive('{{ $user->id }}', '{{ $user->name }}', 'Aktifkan')">
                                                <i class='bx bxs-info-circle'></i>
                                            </button>
                                            @endif
                                        </form>
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
<script>
    const formUpdateUser = document.getElementById('formUpdateUser');

    function confirmNonactive(id, name, status) {
        Swal.fire({
            title: "Konfirmasi",
            text: `User ${name} akan di ${status}. Lanjutkan?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjutkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`formUpdateUser${id}`).submit();
                loadingOverlay.classList.remove('d-none');
                formUpdateUser.classList.add('form-disabled');
                submitBtn.disabled = true;
                submitText.textContent = 'Menyimpan data, mohon tunggu...';
                submitSpinner.classList.remove('d-none');
            }
        });
    }
</script>
@endpush()