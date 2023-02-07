@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid p-0">

  <h1 class="h3 mb-3">Member</h1>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header pt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Member</h5>
                @if (Auth::user()->id_role==2)
                    <a href="{{route('members.create')}}" type="button" class="btn btn-primary">Add Member</a>
                @endif
            </div>
        </div>
        <div class="card-body">
          <table id="MyTable" class="table table-bordered" style="width:100%">
            <thead class="table-primary">
              <tr class="text-center">
                <th>
                  No.
                </th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>


                {{-- @if (Auth::user()->id_role==1) --}}
                  <th>Action</th>
                {{-- @endif --}}
              </tr>
            </thead>
            <tbody>
              @forelse($member as $item)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->no_ktp}}</td>
                <td>{{$item->jenis_kelamin}}</td>
                <td>
                    {{$item->alamat}}
                </td>

                {{-- @if (Auth::user()->id_role==1) --}}
                <td>
                    <div class="dropstart d-flex justify-content-center">
                      <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="{{ route('members.show', $item->id) }}">Show</a></li>
                          <li><a class="dropdown-item" href="{{ route('members.edit', $item->id) }}">Edit</a></li>
                            @if (Auth::user()->id_role==2)
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-modal" data-bs-id="{{$item->id}}" data-bs-act="{{ route('members.destroy', $item->id) }}" data-bs-nama="{{$item->nama}}">Delete</a></li>
                            @endif
                        </ul>
                    </div>
                  </td>
                {{-- @endif --}}

              </tr>
              @empty
              <tr>
                <td colspan="8">
                  <center>Data kosong</center>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-confirmation fade" id="delete-modal" tabindex='-1' role="dialog" aria-labelledby="deleteData" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
          <form id="delete-form" action="/" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                  <h4>Konfirmasi</h4>
                  <p class="mb-0">Yakin untuk menghapus <strong id="del-name"> </strong></p>
              </div>
              <div class="modal-footer">
                  @method('DELETE')
                  <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection
<script>
  document.addEventListener("DOMContentLoaded", x => {

      const deleteModal = document.getElementById('delete-modal');
      const deleteForm = document.getElementById('delete-form');

      // Delete Modal Script
      deleteModal.addEventListener('show.bs.modal', evt => {
          let deleteBtn = event.relatedTarget;
          deleteForm.action = deleteBtn.getAttribute('data-bs-act');
          deleteModal.querySelector('#del-name').textContent = '"' + deleteBtn.getAttribute('data-bs-nama') + '" ?'
      })

  });
</script>
