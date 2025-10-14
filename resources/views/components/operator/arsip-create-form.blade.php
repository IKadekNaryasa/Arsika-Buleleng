{{-- Loading Overlay --}}
<div id="loadingOverlay" class="loading-overlay d-none">
    <div class="loading-content">
        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="text-primary">Menyimpan Arsip...</h5>
        <p class="text-muted">Mohon tunggu, sedang mengupload file!</p>
    </div>
</div>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Tambahkan Arsip</h5>
        <div class="card-body">
            <form action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data" id="arsipForm">
                @csrf
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Data Arsip #1</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-form d-none">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Kategori Arsip</label>
                                <select name="arsip[0][kategori_arsip]" class="form-control" required>
                                    <option value="arsip_aktif">Arsip Aktif</option>
                                    <option value="arsip_inAktif">Arsip In-Aktif</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Kode Klasifikasi</label>
                                <input type="text" name="arsip[0][kode_klasifikasi]" class="form-control" required
                                    placeholder="Masukan Kode Klasifikasi" value="{{ old('arsip[0][kode_klasifikasi]') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Tanggal Arsip</label>
                                <input type="date" name="arsip[0][tanggal_arsip]" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Legalisasi</label>
                                <select name="arsip[0][status_legalisasi]" class="form-control" required>
                                    <option value="belum" selected>Belum Dilegalisasi</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Type</label>
                                <select name="arsip[0][type]" class="form-control" required>
                                    <option value="asli" selected>Asli</option>
                                    <option value="copy">Copy</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload File (*.pdf)</label>
                                <input type="file" name="arsip[0][nama_file]" class="form-control" required accept=".pdf">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Uraian</label>
                                <input type="text" name="arsip[0][uraian]" class="form-control" required value="{{ old('arsip[0][uraian]') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" id="addForm" class="btn btn-secondary w-50">
                            <i class="fas fa-plus"></i> Tambah Form
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let formIndex = 1;
        const formContainer = document.getElementById('formContainer');
        const addFormBtn = document.getElementById('addForm');
        const arsipForm = document.getElementById('arsipForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');
        const loadingOverlay = document.getElementById('loadingOverlay');



        addFormBtn.addEventListener('click', function() {
            const newForm = createNewForm(formIndex);
            formContainer.insertAdjacentHTML('beforeend', newForm);
            toggleRemoveButtons();
            formIndex++;
        });


        function createNewForm(index) {
            return `
            <div class="form-item border p-3 mb-3 rounded" data-index="${index}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Data Arsip #${index + 1}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-form">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                
                <div class="row mb-1">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Kategori Arsip</label>
                        <select name="arsip[${index}][kategori_arsip]" class="form-control" required>
                            <option value="arsip_aktif">Arsip Aktif</option>
                            <option value="arsip_inAktif">Arsip In-Aktif</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kode Klasifikasi</label>
                        <input type="text" name="arsip[${index}][kode_klasifikasi]" class="form-control" required 
                               placeholder="Masukan Kode Klasifikasi">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Tanggal Arsip</label>
                        <input type="date" name="arsip[${index}][tanggal_arsip]" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Legalisasi</label>
                        <select name="arsip[${index}][status_legalisasi]" class="form-control" required>
                            <option value="belum" selected>Belum Dilegalisasi</option>
                        </select>
                    </div>
                     <div class="col-md-2 mb-3">
                        <label class="form-label">Type</label>
                            <select name="arsip[${index}][type]" class="form-control" required>
                                <option value="asli" selected>Asli</option>
                                <option value="copy" >Copy</option>
                            </select>
                        </div>                  
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Upload File (*.pdf)</label>
                        <input type="file" name="arsip[${index}][nama_file]" class="form-control" required accept=".pdf">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Uraian</label>
                        <input type="text" name="arsip[${index}][uraian]" class="form-control" required>
                    </div>
                </div>
            </div>
        `;
        }

        formContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-form') || e.target.parentElement.classList.contains('remove-form')) {
                const formItem = e.target.closest('.form-item');
                formItem.remove();
                updateFormNumbers();
                toggleRemoveButtons();
            }
        });

        function updateFormNumbers() {
            const forms = document.querySelectorAll('.form-item');
            forms.forEach((form, index) => {
                const title = form.querySelector('h6');
                title.textContent = `Data Arsip #${index + 1}`;
            });
        }

        function toggleRemoveButtons() {
            const forms = document.querySelectorAll('.form-item');
            const removeButtons = document.querySelectorAll('.remove-form');

            if (forms.length <= 1) {
                removeButtons.forEach(btn => btn.classList.add('d-none'));
            } else {
                removeButtons.forEach(btn => btn.classList.remove('d-none'));
            }
        }

        arsipForm.addEventListener('submit', function(e) {
            loadingOverlay.classList.remove('d-none');
            arsipForm.classList.add('form-disabled');
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan arsip, mohon tunggu...';
            submitSpinner.classList.remove('d-none');
        });

    });
</script>