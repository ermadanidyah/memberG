@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid p-0">
  <div class="row d-flex justify-content-center">
    <div class="col-8">
        @if($action == 'add')
            <h1 class="h3 mb-3">Add New Member</h1>
        @else
            <h1 class="h3 mb-3">Edit member</h1>
        @endif
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            @if($action == 'add')
                <form id="member-action" action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @else
                <form id="member-action" action="{{ route('members.update', $member->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
            @endif
                @csrf
                <input type="text" name="type" hidden value="add">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label><span class="text-danger">*</span>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" id="nama" placeholder="Nama anda">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">NIK</label><span class="text-danger">*</span>
                    <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" value="{{ old('no_ktp') }}" id="no_ktp" placeholder="NIK anda">
                    @error('no_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="fullname" class="form-label">Email</label><span class="text-danger">*</span>
                  <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" placeholder="email anda">
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

                <!-- Jenis Kelamin -->
                <div class="mb-3">
                    <label for="job" class="form-label">Jenis Kelamin</label><span class="text-danger">*</span>
                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" aria-label="Default select example" id="jenis_kelamin">
                        <option selected disabled value="">Jenis Kelamin Anda</option>
                        @if ($action == 'add')
                            <option value="perempuan">Perempuan</option>
                            <option value="laki">Laki-Laki</option>
                        @endif

                        @if ($action == 'edit')
                            <option value="perempuan" <?php if($member->jenis_kelamin == "perempuan") { echo "selected";} ?>>Perempuan</option>
                            <option value="laki" <?php if($member->jenis_kelamin == "laki") { echo "selected";} ?>>Laki-Laki</option>
                        @endif

                        @if(old('jenis_kelamin'))
                            <option value="perempuan" <?php if(old('provinsi') == "perempuan") { echo "selected";} ?>>Perempuan</option>
                            <option value="laki" <?php if(old('provinsi') == "laki") { echo "selected";} ?>>Laki-Laki</option>
                        @endif
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label><span class="text-danger">*</span>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

              <!-- Provinsi -->
              <div class="mb-3">
                    <label for="category" class="form-label">Provinsi</label><span class="text-danger">*</span>
                    <select class="form-select @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" >
                    <option selected disabled value="">Provinsi</option>
                    @foreach($data_provinsi as $provinsi)
                        <option value="{{$provinsi['id']}}" >{{$provinsi['name']}}</option>
                    @endforeach

                    @if ($action == 'edit')
                      @foreach($data_kabupaten as $kabupaten)
                        @foreach($data_provinsi as $provinsi)
                          @if($member->kabupaten==$kabupaten['id'])
                              <option value="{{$provinsi['id']}}" <?php if($kabupaten['province_id'] == $provinsi['id']) { echo "selected";} ?>>{{$provinsi['name']}}</option>
                          @endif
                        @endforeach
                      @endforeach
                    @endif

                    @if(old('provinsi'))
                      @foreach($data_kabupaten as $kabupaten)
                       <option value="{{$provinsi['id']}}" {{ ($kabupaten['province_id'] == old('provinsi')) ? 'selected="selected"' : '' }}>{{$provinsi['name']}}</option>

                      @endforeach
                    @endif
                    </select>
                    @error('provinsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              <!-- Kab/Kota -->
              <div class="mb-3">
                <label for="category" class="form-label">Kab/Kota</label><span class="text-danger">*</span>
                <select class="form-select @error('kabupaten') is-invalid @enderror"  name="kabupaten" id="kabupaten" >
                  <option selected disabled value="">Kab/Kota</option>

                  @if ($action == 'edit')
                    @foreach($data_kabupaten as $kabupaten)
                      <option value="{{$kabupaten['id']}}" <?php if($member->kabupaten == $kabupaten['id']) { echo "selected";} ?>>{{$kabupaten['name']}}</option>
                    @endforeach
                  @endif

                  @if(old('kabupaten'))
                    @foreach($data_kabupaten as $kabupaten)
                      <option value="{{$kabupaten['id']}}" {{ ($kabupaten['id'] == old('kabupaten')) ? 'selected="selected"' : '' }}>{{$kabupaten['name']}}</option>
                    @endforeach
                  @endif
                </select>
                @error('kabupaten')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Kecamatan -->
              <div class="mb-3">
                <label for="category" class="form-label">Kecamatan</label><span class="text-danger">*</span>
                <select class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" >
                  <option selected disabled value="">Kecamatan</option>

                  @if ($action == 'edit')
                    @foreach($data_kecamatan as $kecamatan)
                      <option value="{{$kecamatan['id']}}" <?php if($member->kecamatan == $kecamatan['id']) { echo "selected";} ?>>{{$kecamatan['name']}}</option>
                    @endforeach
                  @endif

                  @if(old('kecamatan'))
                    @foreach($data_kecamatan as $kecamatan)
                      <option value="{{$kecamatan['id']}}" {{ ($kecamatan['id'] == old('kecamatan')) ? 'selected="selected"' : '' }}>{{$kecamatan['name']}}</option>
                    @endforeach
                  @endif
                </select>
                @error('kecamatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Alamat -->
              <div class="mb-3">
                <label for="fullname" class="form-label">Alamat</label><span class="text-danger">*</span>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat anda" value="{{ old('alamat') }}">
                @error('alamat')
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
                <a href="{{route('members.index')}}" class="btn btn-light me-2">
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
  const member = {!! json_encode($member->toArray()) !!}
    nama.value = member.nama
    phone.value = member.user.phone
    tanggal_lahir.value = member.tanggal_lahir
    email.value = member.user.email
    no_ktp.value = member.no_ktp
    alamat.value = member.alamat
    imgpre.src = "/" +  member.user.photo_images
    photo_name.value = member.user.photo_name
@endif

    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
          url: url,
          type: 'GET',
          dataType: "json",
          data: {
            id: id
          },
          success: function (data) {

            $('#' + name).empty();
            if(name=="provinsi"){
              $('#' + name).append('<option selected disabled value="">Provinsi</option> ');
            }else if(name=="kabupaten"){
              $('#' + name).append('<option selected disabled value="">Kab/Kota</option> ');
            }else if(name=="kecamatan"){
              $('#' + name).append('<option selected disabled value="">Kecamatan</option> ');
            }
            data.forEach(el=>{
              $('#' + name).append('<option value="' + el.id + '">' + el.name    + '</option>');
            })
              // $.each(data, function (key, value) {
              //   console.log(key + value);
              //   // $('#sub_district' + name).append('<option value="' + key + '">' + value + '</option>');
              // });
          }
        });
      }
      $(function () {
        $('#provinsi').on('change', function () {
          onChangeSelect('{{ route("kabupaten.kabupaten") }}', $(this).val(), 'kabupaten');
        });
        $('#kabupaten').on('change', function () {
          onChangeSelect('{{ route("kecamatan.kecamatan") }}', $(this).val(), 'kecamatan');
        });
      });

</script>
@endsection
