@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid p-0">
  <h1>Dashboard</h1>
  <div class="row">
    <div class="col-12">
      <main class="content">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">User Aktiv</h5>
                  <h1 class="fw-bold text-primary mb-0"> {{$count_user_aktif}}</h1>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">User Non Aktiv</h5>
                  <h1 class="fw-bold text-primary mb-0">{{$count_user_Nonaktif}} </h1>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Member</h5>
                  <h1 class="fw-bold text-primary mb-0">{{$count_member}}</h1>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card ">
                <div class="card-body">
                  <h5 class="card-title">Administrasi</h5>
                  <h1 class="fw-bold text-primary mb-0">{{$count_admin}} </h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>
@endsection
@section('page-script')

@endsection
