@extends('dashboard.admin.home')

@section('konten')
<p class="card-title">EDIT VISI & MISI</p>
    <div class="pb-3">
        <a href="{{ route('admin.visimisi.index') }}" class="btn btn-secondary"><< Kembali</a>
    </div>

    <form action="{{ route('admin.visimisi.update', $visimisi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_kandidat" class="form-label">Kandidat</label>
            <select class="form-control" name="id_kandidat" id="id_kandidat" disabled>
                <option value="{{ $visimisi->id_kandidat }}">{{ $visimisi->kandidat->nama_calon }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="visi" class="form-label">Visi</label>
            <textarea class="form-control summernote" name="visi" id="visi" rows="5">{{ $visimisi->visi }}</textarea>
            @error('visi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="misi" class="form-label">Misi</label>
            <textarea class="form-control summernote" name="misi" id="misi" rows="5">{{ $visimisi->misi }}</textarea>
            @error('misi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
