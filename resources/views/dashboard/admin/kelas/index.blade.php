@extends('dashboard.admin.home')
@section('konten')
<p class="card-title">KELAS</p>
<div class="pb-3"><a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">+ Tambah Kelas</a></div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Kelas</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ ($data->currentPage()-1) * $data->perPage() + $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ route('admin.kelas.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form onsubmit="return confirm('Yakin ingin menghapus data ini!')"
                        action="{{ route('admin.kelas.destroy', $item->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" name="submit" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    <div>
        {{ $data->appends(['data' => $data->currentPage()])->links() }}
    </div>
</div>
@endsection
