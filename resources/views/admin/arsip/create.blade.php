<x-admin.layout :active="$active" :link="$link" :open="$open">
    <div class="row">
        <div class="card mb-4">
            <h5 class="card-header text-center">Tambahkan Arsip</h5>
            <div class="card-body">
                <form action="{{ route('arsip.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-1">
                        <div class="col-md-4 mb-3">
                            <label for="kategori" class="form-label">Kategori Arsip</label>
                            <select name="kategori_arsip" class="form-control">
                                <option value="arsip_aktif">Arsip Aktif</option>
                                <option value="arsip_inAktif">Arsip In-Aktif</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="kode_klasifikasi" class="form-label">Kode Klasifikasi</label>
                            <input type="text" name="kode_klasifikasi" class="form-control" value="{{ old('kode_klasifikasi') }}" placeholder="Masukan Kode Klasifikasi">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tanggal_arsip" class="form-label">Tanggal Arsip</label>
                            <input type="date" name="tanggal_arsip" class="form-control" value="{{ old('tanggal_arsip') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status_legalisasi" class="form-label">Legalisasi</label>
                            <select name="status_legalisasi" id="" class="form-control">
                                <option value="belum" selected class="form-select">Belum Dilegalisasi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_file" class="form-label">Upload File (*.pdf)</label>
                            <input type="file" name="nama_file" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="uraian" class="form-label">Uraian</label>
                            <textarea name="uraian" class="form-control" id="">{{ old('uraian') }}</textarea>
                        </div>

                    </div>
                    <div class="row justify-content-center my-3">
                        <div class="col-md-2">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>