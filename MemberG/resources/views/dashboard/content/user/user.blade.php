@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid p-0">

  <h1 class="h3 mb-3">Account</h1>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header pt-4">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">List User</h5>
            <a href="{{route('account.create')}}" role="button" class="btn btn-primary">
              Add User
            </a>
          </div>

        </div>
        <div class="card-body">
          <table id="MyTable" class="table table-bordered" style="width:100%">
            <thead class="table-primary">
              <tr class="text-center">
                <th>No. </th>
                <th>User</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($account as $key=>$accounts)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>
                  {{$accounts->name}}
                </td>
                <td>{{$accounts->email}}</td>
                <td>
                  @if($accounts->isActive==1)
                  <span class="badge bg-success">Active
                  </span>
                  @elseif($accounts->isActive==0)
                  <span class="badge bg-danger">Ban</span>
                  @endif
                </td>

                <td>
                  <div class="dropstart d-flex justify-content-center">
                    <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('account.show', $accounts->id) }}">Show</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.edit', $accounts->id) }}">Edit</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-modal" data-bs-id="{{$accounts->id}}" data-bs-act="{{ route('account.destroy', $accounts->id) }}" data-bs-title="{{$accounts->name}}">Delete</a></li>
                        @if($accounts->isActive==1)
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ban" data-bs-id="{{$accounts->id}}" data-bs-act="{{ route('account-ban.ban', $accounts->id) }}" data-bs-name="{{$accounts->name}}">Ban</a></li>
                        @elseif($accounts->isActive==0)
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#active" data-bs-id="{{$accounts->id}}" data-bs-act="{{ route('account-active.activate', $accounts->id) }}" data-bs-name="{{$accounts->name}}">UnBan</a></li>
                        @endif
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal active -->
<div class="modal fade" id="active" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="activeModalLabel">Activate Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="active-form" action="/" method="post">
        <div class="modal-body">
          Are you sure you want to active user <strong id="active-name"></strong>
        </div>
        @csrf
        @method('PUT')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Active</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal ban -->
<div class="modal fade" id="ban" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="banModalLabel">Ban Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="ban-form" action="/" method="post">
        <div class="modal-body">
          Are you sure you want to ban user <strong id="ban-name"></strong>
        </div>
        @csrf
        @method('PUT')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">ban</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal delete -->
<div class="modal modal-confirmation fade" id="delete-modal" tabindex='-1' role="dialog" aria-labelledby="deleteData" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="delete-form" action="/" method="post">
        <div class="modal-body">
          <h4>Konfirmasi</h4>
          <p class="mb-0">Yakin untuk menghapus <strong id="del-name"> </strong></p>
        </div>
        <div class="modal-footer">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-link" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('page-script')
<script>
  document.addEventListener("DOMContentLoaded", x => {

    const activeModal = document.getElementById('active');
    const activeForm = document.getElementById('active-form');

    const banModal = document.getElementById('ban');
    const banForm = document.getElementById('ban-form');

    const deleteModal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');

    // active Modal Script
    activeModal.addEventListener('show.bs.modal', evt => {
      let activeBtn = event.relatedTarget;
      activeForm.action = activeBtn.getAttribute('data-bs-act');
      activeModal.querySelector('#active-name').textContent = '"' + activeBtn.getAttribute('data-bs-name') + '" ?'
    })

    // ban Modal Script
    banModal.addEventListener('show.bs.modal', evt => {
      let banBtn = event.relatedTarget;
      banForm.action = banBtn.getAttribute('data-bs-act');
      banModal.querySelector('#ban-name').textContent = '"' + banBtn.getAttribute('data-bs-name') + '" ?'
    })

    // Delete Modal Script
    deleteModal.addEventListener('show.bs.modal', evt => {
      let deleteBtn = event.relatedTarget;
      deleteForm.action = deleteBtn.getAttribute('data-bs-act');
      deleteModal.querySelector('#del-name').textContent = '"' + deleteBtn.getAttribute('data-bs-title') + '" ?'
    })

  });
</script>
@endsection
