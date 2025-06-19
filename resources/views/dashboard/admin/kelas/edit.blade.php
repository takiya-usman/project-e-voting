@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">EDIT KELAS</p>
<div class="pb-3"><a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary"><< Kembali</a></div>
<form action="{{ route('admin.kelas.update', $data->id) }}" method="POST">
    @csrf
    @method('put')
    <table id="table" width="40%">
      <tr>
          <td>
              <div class="form-group">
                  <label for="kelas" class="form-label">Kelas</label>
                  <input type="text" name="kelas" id="kelas" class="form-control form-control-sm" placeholder="kelas" value="{{ $data->name }}">
              </div>
          </td>
          <td>
            <button type="button" class="btn btn-danger btn-xs" style="margin-top: 8px; padding: 1px 10px;" disabled><i class="mdi mdi-window-minimize"></i></button>
        </td>
      </tr>
  </table>


    <button class="btn btn-primary" name="simpan" type="submit">Update</button>

</form>
@endsection