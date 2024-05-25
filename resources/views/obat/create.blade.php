@extends('layouts/main')

@section('container')
<div class="lime-container">
    <div class="lime-body">
        <div class="container">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Obat</h5>
                            <p>Isi data dengan lengkap dan tepat</p>
                            <form method="POST" action="{{ route('obat.store') }}" enctype="multipart/form-data">
                                @csrf  
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Nama" required value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis">Jenis</label>
                                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis" placeholder="Masukkan Jenis" required value="{{ old('jenis') }}">
                                            @error('jenis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan" placeholder="Masukkan Satuan" required value="{{ old('satuan') }}">
                                            @error('satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" name="harga_beli" id="harga_beli" placeholder="Masukkan Harga Beli" required value="{{ old('harga_beli') }}">
                                            @error('harga_beli')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                           
                                            <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" id="harga_jual" placeholder="Masukkan Harga Jual" required value="{{ old('harga_jual') }}">
                                            @error('harga_jual')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" placeholder="Masukkan Stok" required value="{{ old('stok') }}">
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kadaluarsa">Kadaluarsa</label>
                                            <input type="date" class="form-control @error('kadaluarsa') is-invalid @enderror" name="kadaluarsa" id="kadaluarsa" required value="{{ old('kadaluarsa') }}">
                                            @error('kadaluarsa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="suplier_id">Suplier</label>
                                            <select class="js-states form-control" name="suplier_id" id="suplier_id" style="width: 100%"  title="Pilih satu"required>
                                                <option value="">Pilih Suplier</option>
                                                @foreach($supliers as $suplier)
                                                    <option value="{{ $suplier->id }}">{{ $suplier->NmSuplier }}</option>
                                                @endforeach
                                            </select>
                                            @error('suplier_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                                                
                                
                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-left mr-2" data-toggle="modal" data-target="#exampleModal">
                                    Tambah
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary float-left" data-toggle="modal" data-target="#exampleModalback">
                                    Kembali
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penambahan Data</h5>
                                        </div>
                                        <div class="modal-body">
                                        Apakah Anda yakin ingin menambahkan data ini?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelback" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabelback">Konfirmasi Kembali</h5>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin kembali?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <a href="{{ route('obat.index') }}" class="btn btn-primary">Ya, Kembali</a>
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