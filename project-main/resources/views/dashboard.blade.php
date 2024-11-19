@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Menu Verifikasi BPJS</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="row g-3 p-3">
            <div class="col-md-6">
              <a href="{{ route('user-profile') }}" class="text-decoration-none">
                <div class="card bg-primary text-white h-100 clickable-card">
                  <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="mb-0">Klaim</h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('user-management') }}" class="text-decoration-none">
                <div class="card bg-primary text-white h-100">
                  <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="mb-0">Estimasi Biaya Pasien</h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Recent Users</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">John Michael</h6>
                        <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">Active</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Alexa Liras</h6>
                        <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Programmer</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Tabel Data Perbandingan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No RM</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No BPJS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Klaim</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Estimasi</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perbandinganData as $data)
                                <tr class="{{ $data->is_exceeded ? 'bg-light-danger' : 'bg-light-success' }}">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $data->nama_lengkap }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $data->no_rm }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $data->no_bpjs }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $data->alamat }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Rp. {{ number_format($data->total_klaim, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Rp. {{ number_format($data->total_estimasi, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        @if($data->is_exceeded)
                                            <span class="badge badge-sm bg-gradient-danger">Melebihi Klaim</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success">Dalam Batas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data perbandingan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<style>
.bg-light-danger {
    background-color: rgba(253, 227, 227, 0.5);
}
.bg-light-success {
    background-color: rgba(227, 253, 235, 0.5);
}
</style>

@endsection
