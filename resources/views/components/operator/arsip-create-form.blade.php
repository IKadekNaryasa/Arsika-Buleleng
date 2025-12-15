@props(['klasifikasies'])

{{-- Loading Overlay --}}
<x-overlay></x-overlay>

<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    .select2-dropdown {
        border: 1px solid #ced4da;
    }
</style>

<div class="row">
    <div class="card mb-4">
        <h5 class="card-header text-center">Tambahkan Arsip</h5>
        <div class="card-body">
            <form action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data" id="arsipForm">
                @csrf
                <div id="formContainer">
                    <div class="form-item border p-3 mb-3 rounded" data-index="0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <button type="button" class="btn btn-sm btn-danger remove-form d-none">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Kategori Arsip</label>
                                <select name="kategori_arsip" class="form-control" required>
                                    <option value="arsip_aktif">Arsip Aktif</option>
                                    <option value="arsip_inAktif">Arsip In-Aktif</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-7 mb-3">
                                <label class="form-label">Kode Klasifikasi</label>
                                <select name="klasifikasi_id" id="klasifikasiSelect" class="form-control" required>
                                    <option value="" disabled selected>Pilih atau ketik kode/keterangan...</option>
                                    @foreach ($klasifikasies as $klasifikasi)
                                    <option value="{{ $klasifikasi->id }}">{{ $klasifikasi->kode }} - {{ $klasifikasi->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Tanggal Arsip</label>
                                <input type="date" name="tanggal_arsip" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Legalisasi</label>
                                <select name="status_legalisasi" class="form-control" required>
                                    <option value="belum" selected>Belum Dilegalisasi</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Nomor Dokumen</label>
                                <input type="text" class="form-control" name="nomor_dokumen" required value="{{ old('nomor_dokumen') }}" placeholder="Nomor Dokumen">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="copy" selected>Copy</option>
                                    <option value="asli">Asli</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Masa Aktif <strong class="text-danger">*(Tahun)</strong></label>
                                <input type="number" class="form-control" name="masa_aktif" required value="{{ old('masa_aktif') }}" placeholder="Contoh : 2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload File (*.pdf) (Max : 3 MB)</label>
                                <input type="file" name="nama_file" class="form-control" required accept=".pdf">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Uraian</label>
                                <textarea name="uraian" class="form-control" required>{{ old('uraian') }}</textarea>
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

@push('script')
<script>
    const arsipForm = document.getElementById('arsipForm');

    $(document).ready(function() {
        $('#klasifikasiSelect').select2({
            placeholder: 'Pilih atau ketik kode/keterangan...',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Kode klasifikasi tidak ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });
    });

    arsipForm.addEventListener('submit', function(e) {
        loadingOverlay.classList.remove('d-none');
        arsipForm.classList.add('form-disabled');
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan arsip, mohon tunggu...';
        submitSpinner.classList.remove('d-none');
    });
</script>
@endpush