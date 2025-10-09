@props(['bidang'])
{{-- Loading Overlay --}}
<x-overlay></x-overlay>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Edit Bidang {{ $bidang->nama_bidang }}</h5>
        <div class="card-body">
            <form action="{{ route('admin.bidang.update',$bidang->id) }}" method="post" id="bidangForm">
                @csrf
                @method('PUT')
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="row mb-1">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nama Bidang</label>
                                <input type="text" name="nama_bidang" class="form-control" value="{{ old('nama_bidang') ?? $bidang->nama_bidang }}" required placeholder="Nama Bidang">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kode Bidang</label>
                                <input type="text" name="kode_bidang" class="form-control" value="{{ old('kode_bidang' ) ?? $bidang->kode_bidang }}" required placeholder="Kode Bidang">
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
    const bidangForm = document.getElementById('bidangForm');

    bidangForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        bidangForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan Bidang, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>