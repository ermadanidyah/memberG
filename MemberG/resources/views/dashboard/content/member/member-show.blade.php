@extends('dashboard.dashboard')

<head>
  <style>
    :root {
      --white: #ffffff;

      --black-darker: #2c2c2c;
      --blue: #005099;
      --gray: #f3f3f3;
      --gray-darker: #d0d0d0;
      --gray-more-darker: #8a8a8e;
      --border-radius: 6px;
      --body-font-size: 18px;
      --small-font-size: 14px;
      --smaller-font-size: 12px;
    }

    #cta {
      margin-bottom: 43px;
    }

    .card-member {
      border-radius: calc(var(--border-radius) * 2);
      border: 1px solid var(--gray-darker);
      background-color: var(--white);
      overflow: hidden;
      padding: 240px 40px 40px 40px;
      position: relative;
    }

    .card-member .card-member-bg {
      position: absolute;
      width: 100%;
      top: 0;
      left: 0;
      right: 0;
      height: 300px;
      object-fit: contain;
    }

    .card-member .card-member-avatar {
      display: block;
      margin: 0 auto;
      width: 120px;
      height: 120px;
      position: relative;
      z-index: 2;
      margin-bottom: 32px;
      border-radius: 50%;
      object-fit: cover;
      background-color: white;
    }

    .card-member .card-member-name {
      font-size: 28px;
      font-weight: 700;
      color: var(--blue);
      margin-bottom: 12px;
      text-align: center;
    } .card-member .card-member-ceo {
      font-size: 18px;
      font-weight: 600;
      color: var(--black-darker);
      margin-bottom: 12px;
      text-align: center;
    }

    .card-member .card-member-id{
            margin-bottom: 10px;
            font-weight: 600;
            text-align: center;
            color: var(--cyan);
    }

    .card-member-info-wrapper {
      max-width: 100%;
      width: 528px;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 35px;
    }

    .card-member-info {
      padding: 16px;
      border-radius: calc(var(--border-radius) * 2);
      background-color: var(--gray);
      text-align: center;
    }

    .card-member-info .card-member-info-title {
      margin-bottom: 12px;
    }

    .card-member-info .card-member-info-amount {
      margin-bottom: 0;
      font-size: 28px;
      font-weight: 700;
      color: var(--blue);
    }

    .card-member .card-member-desc {
      margin-bottom: 33px;
    }

    .table-detail {
      margin-bottom: 32px;
    }

    table tr td:last-child {
      display: flex;
      align-items: flex-start;
    }

    .cap {
    text-transform: capitalize;
    }
  </style>
</head>
@section('content')
<div class="container-fluid p-0">
  <div class="row d-flex justify-content-center">
    <div class="col-8">
      <h1 class="h3 mb-3">Show Member</h1>
      <div class="card">
        <div class="card-body">
          <!-- Start - Member Card -->
          <div class="cap">
            <div class="card-member">
              <img src="{{asset('assets/header.jpg')}}" alt="Member" class="card-member-bg">
              @if ($member->user->photo_images)
                <img src="{{asset($member->user->photo_images)}}" alt="" class="card-member-avatar">
              @else
                <img src="{{asset('assets/avatar.jpg')}}" alt="" class="card-member-avatar">

              @endif
              <h6 class="card-member-name"> {{$member->nama}} </h6>
              @if ($member->jenis_kelamin=="laki")
                <h6 class="card-member-ceo"> Laki Laki </h6>
              @else
                <h6 class="card-member-ceo"> Perempuan </h6>
              @endif
              <p class="card-member-id">
                    Email - {{$member->user->email}} |
                    Phone - {{$member->user->phone}}
                </p>
            </div>
          </div>
          <!-- End - Member Card -->

        </div>
      </div>
      <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Data Pribadi
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-3 text-end text-secondary">NIK</div>
                                <div class="col-9">{{$member->no_ktp}}</div>
                                <div class="col-3 text-end text-secondary">Tanggal Lahir</div>
                                <div class="col-9">{{ Carbon\Carbon::parse($member->tanggal_lahir)->format('d F Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Alamat
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-3 text-end text-secondary">Provinsi</div>
                                @foreach ($data_provinsi as $item)
                                    @if ($member->provinsi==$item['id'])
                                        <div class="col-9">{{$item['name']}}</div>
                                    @endif
                                @endforeach

                                <div class="col-3 text-end text-secondary">Kab/Kota</div>
                                @foreach ($data_kabupaten as $item)
                                    @if ($member->kabupaten==$item['id'])
                                        <div class="col-9">{{$item['name']}}</div>
                                    @endif
                                @endforeach

                                <div class="col-3 text-end text-secondary">Kecamatan</div>
                                @foreach ($data_kecamatan as $item)
                                    @if ($member->kecamatan==$item['id'])
                                        <div class="col-9">{{$item['name']}}</div>
                                    @endif
                                @endforeach
                                <div class="col-3 text-end text-secondary">Alamat</div>
                                <div class="col-9">{{$member->alamat}}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('members.index')}}" class="btn btn-light me-2">
                    <span class="btn-icon-label">
                        <i data-feather="arrow-left" class="me-2"></i>
                        <span> Kembali </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')
@endsection
