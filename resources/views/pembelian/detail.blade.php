@extends('layouts.main')

@section('container')
    <div class="lime-container">
        <div class="lime-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Detail Pembelian</h5>
                                <p>Ubah data sesuai kebutuhan</p>
                                <form method="POST" action="{{ route('pembelian.update', $pembelian->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Tanggal Nota</label>
                                                <input type="date"
                                                    class="form-control @error('name') is-invalid @enderror" name="tgl_nota"
                                                    id="tgl_nota" placeholder="Masukkan Tgl Nota" required
                                                    value="{{ old('tgl_nota', $pembelian->TglNota) }}" disabled>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="suplier_id">Suplier</label>
                                                <select class="js-states form-control" name="suplier_id" id="suplier_id"
                                                    style="width: 100%" title="Pilih satu" required disabled>
                                                    <option value="">Pilih Suplier</option>
                                                    @foreach ($supliers as $suplier)
                                                        <option value="{{ $suplier->id }}"
                                                            {{ $pembelian->Suplier_id == $suplier->id ? 'selected' : '' }}>
                                                            {{ $suplier->NmSuplier }}</option>
                                                    @endforeach
                                                </select>
                                                @error('suplier_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="diskon">Diskon</label>
                                                <input type="text"
                                                    class="form-control @error('diskon') is-invalid @enderror"
                                                    name="diskon" id="diskon" placeholder="Masukkan Nomor Telepon"
                                                    required value="{{ old('diskon', $pembelian->diskon) }}" disabled>
                                                @error('diskon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <label class="mt-4" for="diskon">Tabel Pembelian</label>
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">

                                                <th>#</th>
                                                <th>Tanggal Nota</th>
                                                <th>Nama Suplier</th>
                                                <th>Nama Obat</th>
                                                <th>Tanggal Beli</th>
                                                <th>Tanggal Kadaluarsa</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($detail->isEmpty())
                                                <tr>
                                                    <td colspan="9" class="text-center">Data kosong atau tidak ada data
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($detail as $detail)
                                                    <tr class="text-center" id = "upt_ids{{ $detail->id }}">
                                                        {{-- <td><input type="checkbox" name="ids[]" class="checkbox_ids" id="{{ $detail->id }}" value="{{ $detail->id }}"></td> --}}
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $detail->pembelian->TglNota }}</td>
                                                        <td>{{ $detail->pembelian->suplier->NmSuplier }}</td>
                                                        <td>{{ $detail->obat->NmObat }}</td>
                                                        <td>{{ $detail->created_at }}</td>
                                                        <td>{{ $detail->obat->kadaluarsa }}</td>
                                                        <td>{{ $detail->Jumlah }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary float-left mt-5" data-toggle="modal"
                                        data-target="#exampleModalback">
                                        Kembali
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penambahan
                                                        Data</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menambahkan data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalback" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabelback" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelback">Konfirmasi Kembali
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin kembali?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <a href="{{ route('pembelian.index') }}" class="btn btn-primary">Ya,
                                                        Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
