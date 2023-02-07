<!DOCTYPE html>
<html lang="en">
<!-- Head -->
    @include('dashboard.include.head')
<!-- End Head -->
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper"> --}}
            <div class="container-fluid p-0">
              <div class="row d-flex justify-content-center">
                <div class="col-8">

                    <h1 class="h3 mb-3" style="text-align:center; color:white;">Register</h1>
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title mb-0">
                            <form id="member-action" action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="text" name="type" hidden value="register">
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
                                        <option value="perempuan">Perempuan</option>
                                        <option value="laki">Laki-Laki</option>

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
                            <input type="file" class="form-control @error('rekening') is-invalid @enderror" name="photo_images" id="photo_images">
                            <img id="imgpre" width="400" style="margin-top:20px;"/>
                            <input type="hidden" class="form-control @error('rekening') is-invalid @enderror" name="photo_name" id="photo_name">
                          </div>

                          <div class="d-flex justify-content-center">
                            <a href="{{route('view-member')}}" class="btn btn-light me-2">
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

        {{-- </div> --}}
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->
    <!--script-->
    @include('dashboard.include.script')
    <script>
        photo_images.onchange = evt => {
            const [file] = photo_images.files
            if (file) {
                imgpre.src = URL.createObjectURL(file)
            }
        }

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
    <!--end script-->
</body>
</html>
