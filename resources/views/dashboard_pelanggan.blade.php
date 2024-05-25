@extends('layouts.main')

@section('container')
    <div class="lime-container">
        <div class="lime-body">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="dashboard-info row">
                                    <div class="info-text col-md-6">
                                        <h5 class="card-title">Selamat datang di apotek Bima Nusa</h5>
                                        <p>Kenali sistem kami, dengan beberapa langkah berikut:</p>
                                        <ul>
                                            <li>Anda bisa Sign up terlebih dahulu</li>
                                            <li>Cari obat yang anda butuhkan</li>
                                            <li>Tentukan obat yang akan kamu pilih</li>
                                        </ul>
                                    </div>
                                    <div class="info-image col-md-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Obat Terbaru</h5>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <form action="{{ route('dashboard-pelanggan.search') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Masukkan Nama" value="" size="30">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('dashboard-pelanggan.index') }}" id="refreshPage" class="btn btn-outline-info mr-2" data-toggle="tooltip" data-placement="top" title="Segarkan">
                                        <i class="fas fa-sync-alt mr-1"></i>
                                    </a>                                    
                                </div>
                            </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Kadaluarsa</th>
                                                <th>Satuan</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Stok</th>
                                                <th>Tanggal Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($obat->isEmpty())
                                                <tr>
                                                    <td colspan="9" class="text-center">Data kosong atau tidak ada data
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($obat as $obat)
                                                    <tr class="text-center" id = "upt_ids{{ $obat->id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $obat->NmObat }}</td>
                                                        <td>{{ $obat->Jenis }}</td>
                                                        <td>{{ $obat->kadaluarsa }}</td>
                                                        <td>{{ $obat->Satuan }}</td>
                                                        <td>{{ $obat->HargaBeli }}</td>
                                                        <td>{{ $obat->HargaJual }}</td>
                                                        <td>{{ $obat->Stok }}</td>
                                                        <td><span
                                                                class="badge badge-success">{{ $obat->created_at }}</span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="lime-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="footer-text">2019 © stacks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
