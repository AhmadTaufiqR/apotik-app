@extends('layouts/main')

@section('container')
<div class="lime-container">
    <div class="lime-body">
        <div class="container">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Apoteker</h5>
                            <p>Isi data dengan lengkap dan tepat</p>
                            <form method="POST" action="{{ route('apoteker.store') }}" enctype="multipart/form-data">
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
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Masukkan Username" required value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderrorsuplier
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password" required minlength="8">
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
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required minlength="8">
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
                                                <a href="{{ route('apoteker.index') }}" class="btn btn-primary">Ya, Kembali</a>
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