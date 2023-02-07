@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid p-0">
  <div class="row d-flex justify-content-center">
    <div class="col-8">
      @if($action == 'add')
        <h1 class="h3 mb-3">Add New User</h1>
      @else
        <h1 class="h3 mb-3">Edit User</h1>
      @endif
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            @if($action == 'add')
              <form id="account-action" action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
            @else
              <form id="account-action" action="{{ route('account.update', $account->id) }}" method="post" enctype="multipart/form-data">
              @method('put')
            @endif
            @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="nama" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              <div class="mb-3">
                <label class="form-label">E-mail</label><span class="text-danger">*</span>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label><span class="text-danger">*</span>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Phone</label><span class="text-danger">*</span>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" class="form-control @error('photo_images') is-invalid @enderror" name="photo_images" id="photo_images">
                <img id="imgpre" width="400" style="margin-top:20px;"/>
                <input type="hidden" class="form-control @error('photo_images') is-invalid @enderror" name="photo_name" id="photo_name">
              </div>
              <div class="d-flex justify-content-center">
                <a href="{{route('account.index')}}" class="btn btn-light me-2">
                    <span class="btn-icon-label">
                      <i data-feather="arrow-left" class="me-2"></i>
                        <span> Kembali </span>
                    </span>
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </h5>
        </div>
        <div class="card-body">
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('page-script')
<script>
    photo_images.onchange = evt => {
          const [file] = photo_images.files
          if (file) {
              imgpre.src = URL.createObjectURL(file)
          }
      }
  @if($action=='edit')
    const account = {!! json_encode($account->toArray()) !!}
    username.value = account.username
    phone.value = account.phone
    nama.value = account.name
    email.value = account.email
    imgpre.src = "/" +  account.photo_images
    photo_name.value = account.photo_name
  @endif

</script>
@endsection
