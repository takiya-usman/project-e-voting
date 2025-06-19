@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">VISI & MISI</p>
<div class="pb-3"><a href="{{ route('admin.visimisi.create') }}" class="btn btn-primary">+ Tambah Visi dan Misi</a></div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Kandidat</th>
                <th>Visi</th>
                <th>Misi</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td  style="font-weight: bold;">{{ $item->kandidat->nama_calon ?? ''}}</td>
                <td>{!! $item->visi !!}</td>
                <td>{!! $item->misi !!}</td>

                <td>
                    <a href="{{ route('admin.visimisi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form onsubmit="return confirm('Yakin ingin menghapus data ini!')"
                        action="{{ route('admin.visimisi.destroy', $item->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" name="submit" type="submit">Delete</button>
                    </form>
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</div>
@endsection
