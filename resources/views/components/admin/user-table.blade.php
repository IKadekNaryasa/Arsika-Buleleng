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
                            <th style="font-size: small;">Instansi</th>
                            <th style="font-size: small;">Email</th>
                            <th style="font-size: small;">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td style="font-size: small;">{{ $loop->iteration }}</td>
                            <td style="font-size: small;">{{ $user->name }}</td>
                            <td style="font-size: small;">{{ $user->bidang->nama_bidang }}</td>
                            <td style="font-size: small;">{{ $user->email }}</td>
                            <td style="font-size: small;">{{ $user->role }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada User!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
</script>
@endpush()