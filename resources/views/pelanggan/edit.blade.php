@extends('layouts/main')

@section('container')
<div class="lime-container">
    <div class="lime-body">
        <div class="container">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ubah Pelanggan</h5>
                            <p>Ubah data sesuai kebutuhan</p>
                            <form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Nama" required value="{{ old('name', $pelanggan->NmPelanggan) }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Masukkan Nomor Telepon" required value="{{ old('phone_number', $pelanggan->Telpon) }}" maxlength="13">
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Masukkan Alamat" required value="{{ old('address', $pelanggan->Alamat) }}">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Kota</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" placeholder="Masukkan Kota" required value="{{ old('city', $pelanggan->Kota) }}">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Masukkan Username" required value="{{ old('username', $pelanggan->Username) }}">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password" minlength="8">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i id="togglePassword" class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" minlength="8">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i id="toggleConfirmPassword" class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback" id="password-feedback" style="display: none;">
                                                Password tidak cocok
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-primary float-left mr-2" data-toggle="modal" data-target="#exampleModal">
                                    Ubah
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
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Perubahan Data</h5>
                                        </div>
                                        <div class="modal-body">
                                        Apakah Anda yakin ingin mengubah data ini?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
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
                                                <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">Ya, Kembali</a>
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
