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
      <h1 class="h3 mb-3">Show User</h1>
      <div class="card">
        <div class="card-body">
          <!-- Start - Member Card -->
          <div class="cap">
            <div class="card-member">
              <img src="{{asset('assets/header.jpg')}}" alt="Member" class="card-member-bg">
              @if ($user->photo_images)
                <img src="{{asset($user->photo_images)}}" alt="" class="card-member-avatar">
              @else
                <img src="{{asset('assets/avatar.jpg')}}" alt="" class="card-member-avatar">

              @endif
              <h6 class="card-member-name"> {{$user->name}} </h6>
              <h6 class="card-member-ceo"> {{$user->role->nama}} </h6>
              <p class="card-member-id">
                    Email - {{$user->email}} |
                    @if ($user->isActive==1)
                        Status - Aktiv
                    @else
                        Status - Tidak Aktiv
                    @endif


                </p>
            </div>
          </div>
          <!-- End - Member Card -->

        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')
@endsection
