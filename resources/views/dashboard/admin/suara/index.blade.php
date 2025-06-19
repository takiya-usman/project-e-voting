@extends('dashboard.admin.home')
@section('konten')
    <p class="card-title">Suara</p>
    <div class="table-responsive">
        <form method="POST" action="{{ route('admin.suara.delete') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">
            @csrf
            @method('DELETE')
            <div style="text-align:right">
                <button class="btn btn-sm btn-danger" name="submit" type="submit">Delete</button>
            </div>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th>Nama Calon</th>
                        <th>Nama Siswa</th>
                        <th>Waktu Pemilihan</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suaras as $key => $suara)
                        @if ($suara->user->status == 1)
                            <tr>
                                <td>{{ ($suaras->currentPage() - 1) * $suaras->perPage() + $loop->iteration }}</td>
                                <td>{{ $suara->kandidat->nama_calon }}</td>
                                <td>{{ $suara->user->name }}</td>
                                <td>{{ $suara->waktu_pemilihan }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selected[]" value="{{ $suara->id }}">
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $suaras->appends(['data' => $suaras->currentPage()])->links() }}
            </div>
        </form>
    </div>
@endsection
