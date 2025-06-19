@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">CALON KANDIDAT</p>

<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Kandidat</th>
                <th>Nama Calon</th>
                <th style="text-align: center;">Foto</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_kandidat }}</td>
                <td>{{ $item->nama_calon }}</td>
                <td style="text-align: center;">
                    @if ($item->foto)
                    <img style="width: 150px; height: 100px; object-fit: cover; border-radius: 0.25rem; display: inline-block;" src="{{ url('foto'). '/'. $item->foto }}">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.kandidat.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection
