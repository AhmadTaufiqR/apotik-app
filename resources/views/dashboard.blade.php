@extends('layouts.main')

@section('container')
    <div class="lime-container">
        <div class="lime-body">
            <div class="container">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Pelanggan</h5>
                                <h2 class="float-right">{{ $countPelanggan }}</h2>
                                <p>Pelanggan terdaftar</p>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $countPelanggan }}%" aria-valuenow="{{ $countPelanggan }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Obat</h5>
                                <h2 class="float-right">{{ $countObat }}</h2>
                                <p>Jumlah obat apotik</p>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $countObat }}%"
                                        aria-valuenow="{{ $countObat }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Obat Terjual</h5>
                                <h2 class="float-right">{{ $countPenjualan }}</h2>
                                <p>Total obat terjual</p>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $countPenjualan }}%" aria-valuenow="{{ $countPenjualan }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Last Transactions</h5>
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
                                                        <td><span class="badge badge-success">{{ $obat->created_at }}</span></td>

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

    </div>
@endsection
