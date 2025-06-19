@extends('dashboard.admin.home')

@section('konten')
    <p class="card-title">SISWA</p>
    <div class="pb-3">
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>
      
    </div>
    <form action="{{ route('admin.siswa.index') }}" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    @if (count($data) > 0)
        <div class="table-responsive">
            <table class="table table-stripped">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @error('file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th>Kelas</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="col-2">Aksi</th>
                        <th><input type="checkbox" id="checkAll"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ optional($item->kelas)->name }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <div
                                    class="btn btn-sm @if ($item->status == 0) btn-danger @else btn-success @endif">
                                    @if ($item->status == 0)
                                        Belum Memilih
                                    @else
                                        Sudah Memilih
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.siswa.edit', $item->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form onsubmit="return confirm('Yakin ingin menghapus data ini!')"
                                    action="{{ route('admin.siswa.destroy', $item->id) }}" class="d-inline" method="POST">
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
    @else
        <p>No data found.</p>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.siswa.SiswaImport') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteAll() {
            var ids = [];
            $('.checkBox:checked').each(function() {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                alert('Pilih setidaknya satu data untuk dihapus.');
            } else {
                if (confirm('Yakin ingin menghapus data yang dipilih?')) {
                    $.ajax({
                        url: "{{ route('admin.siswa.deleteAll') }}",
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            }
        }

        // Check All Functionality
        $('#checkAll').click(function() {
            $('.checkBox').prop('checked', this.checked);
        });
    </script>
@endsection
