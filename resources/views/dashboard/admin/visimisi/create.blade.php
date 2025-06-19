@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">TAMBAH VISI & MISI</p>
<div class="pb-3"><a href="{{ route('admin.visimisi.index') }}" class="btn btn-secondary"><< Kembali</a>
</div>

<form action="{{ route('admin.visimisi.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <select class="form-control" name="id_kandidat" id="id_kandidat">
            <option disabled selected value>Pilih Kandidat</option>
            @foreach ($kandi as $item)
                <option value="{{ $item->id }}">{{ $item->nama_calon }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="visi" class="form-label">Visi</label>
        <textarea class="form-control summernote" name="visi" id="visi" rows="5">{{ Session::get('visi') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="misi" class="form-label">Misi</label>
        <textarea class="form-control summernote" name="misi" id="misi" rows="5">{{ Session::get('misi') }}</textarea>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
</form>
@endsection
