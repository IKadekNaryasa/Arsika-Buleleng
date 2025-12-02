{{-- Loading Overlay --}}
<x-overlay></x-overlay>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Add New Kode Klasifikasi</h5>
        <div class="card-body">
            <form action="{{ route('admin.klasifikasi.store') }}" method="post" id="kodeKlasifikasiForm">
                @csrf
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="row mb-1">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kode Klasifikasi</label>
                                <input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required placeholder="Kode Klasifikasi">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" required placeholder="Keterangan">
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
    const kodeKlasifikasiForm = document.getElementById('kodeKlasifikasiForm');

    kodeKlasifikasiForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        kodeKlasifikasiForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan Kode, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>