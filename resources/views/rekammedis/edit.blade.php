<h5 class="modal-title text-center mb-5" id="editRegisterPasienLabel">Edit Register Pasien</h5>
          <form action="/Register/{{ $data->id }}" method="post">
              @method('put')
              @csrf
              <input type="hidden" name="pasien_id" value="{{ $data->id }}">
              <div class="row mb-3 px-2">
                <label for="subject">Subject</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="subject" value="diisi" id="subject" {{ ($data->subject === 'diisi') ? 'checked' : '' }}>
                    <label for="subject" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="subject" value="tidak diisi" id="no_subject" {{ ($data->subject === 'tidak diisi') ? 'checked' : '' }}>
                    <label for="no_subject" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="object">Object</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="object" value="diisi" id="object" {{ ($data->object === 'diisi') ? 'checked' : '' }}>
                    <label for="object" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="object" value="tidak diisi" id="no_object" {{ ($data->object === 'tidak diisi') ? 'checked' : '' }}>
                    <label for="no_object" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="analisa">Analisa</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="analisa" value="diisi" id="analisa" {{ ($data->analisa === 'diisi') ? 'checked' : '' }}>
                    <label for="analisa" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="analisa" value="tidak diisi" id="no_analisa" {{ ($data->analisa === 'tidak diisi') ? 'checked' : '' }}>
                    <label for="no_analisa" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3 px-2">
                <label for="penata_laksana">Penata Laksana</label>
                <div class="ml-auto mr-2 row">
                  <div class="form-check mr-2">
                    <input type="radio" class="form-check-input" name="penata_laksana" value="diisi" id="penataLaksana" {{ ($data->penata_laksana === 'diisi') ? 'checked' : '' }}>
                    <label for="penataLaksana" class="form-check-label">diisi</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" name="penata_laksana" value="tidak diisi" id="no_penataLaksana" {{ ($data->penata_laksana === 'tidak diisi') ? 'checked' : '' }}>
                    <label for="no_penataLaksana" class="form-check-label">tidak diisi</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Ttd dan Nama</label>
                <input type="text" name="name" class="form-control shadow-none" id="name" value="{{ old('name', $data->name) }}" required>
              </div>
              <div class="form-group">
                <label for="poli">Poli</label>
                <input type="text" name="poli" class="form-control shadow-none" id="poli" value="{{ old('poli', $data->poli) }}" required>
              </div>
              <div class="form-group">
                <label for="desc">Keterangan</label>
                <input type="text" name="desc" class="form-control shadow-none" id="desc" value="{{ old('desc', $data->desc) }}" required>
              </div>
              <div class="form-group">
                <label for="created_at">Dibuat Pada</label>
                <input type="datetime-local" name="created_at" class="form-control shadow-none" id="created_at" value="{{ old('created_at', $data->created_at) }}" required>
              </div>
              <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali</label>
                <input type="datetime-local" name="tanggal_kembali" class="form-control shadow-none" id="tanggal_kembali" value="{{ old('tanggal_kembali', $data->tanggal_kembali) }}" required>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Edit Sekarang</button>
            </div>
          </form>