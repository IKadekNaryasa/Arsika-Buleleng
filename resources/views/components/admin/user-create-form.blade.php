@props(['bidangs'])
{{-- Loading Overlay --}}
<div id="loadingOverlay" class="loading-overlay d-none">
    <div class="loading-content">
        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="text-primary">Menyimpan Data...</h5>
        <p class="text-muted">Mohon tunggu, sedang menambahkan user!</p>
    </div>
</div>
<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loading-content {
        text-align: center;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .form-disabled {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Tambahkan User</h5>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data" id="userForm">
                @csrf
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="row mb-1">
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Bidang</label>
                                <select name="bidang" class="form-control" required>
                                    <option selected disabled>Pilih Bidang...</option>
                                    @foreach ($bidangs as $bidang )
                                    <option value="{{$bidang->id}}">{{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required placeholder="Nama beserta gelar">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="masukan Email aktif">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="operator" selected>Operator</option>
                                    <option value="admin">Admin</option>
                                    <option value="kepala_badan">Kepala Badan</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="active" selected>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <button type="submit" name="submit" id="submitBtn" class="btn btn-success w-50">
                            <span id="submitText">Submit</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const userForm = document.getElementById('userForm');

    userForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        userForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan user, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>