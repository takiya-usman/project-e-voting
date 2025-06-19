@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">EDIT CALON KANDIDAT</p>
<div class="pb-3"><a href="{{ route('admin.kandidat.index') }}" class="btn btn-secondary"><< Kembali</a></div>
<form action="{{ route('admin.kandidat.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="row justify-content-between">
      <div class="col-2">
        @if ($data->foto)
        <div class="mb-3">
          <img style="width: 250px; height: 200px; object-fit: cover; border-radius: 0.25rem;" src="{{ url('foto'). '/'. $data->foto }}">
        </div>
            
        @endif
        
      </div>

      
      <div class="col-8">

        <div class="mb-3">
          <label for="kandidat" class="form-label">Kandidat</label>
          <input type="text"
            class="form-control form-control-sm" name="kandidat" id="kandidat" aria-describedby="helpId" placeholder="kandidat" value="{{ $data->nama_kandidat }}" disabled>
        </div>
        <div class="mb-3">
          <label for="calon" class="form-label">Nama Calon</label>
          <input type="text"
            class="form-control form-control-sm" name="calon" id="calon" aria-describedby="helpId" placeholder="calon" value="{{ $data->nama_calon}}">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">foto</label>
          <input type="file"
            class="form-control form-control-sm" name="foto" id="foto" value="{{ $data->foto }}">
        </div>

      </div>

    </div>
    <button class="btn btn-primary" name="simpan" type="submit">Update</button>
</form>
@endsection