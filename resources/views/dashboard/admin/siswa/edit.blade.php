@extends('dashboard.admin.home')
@section('konten')
    <p class="card-title">EDIT SISWA</p>
    <div class="pb-3"><a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
            << Kembali</a>

    </div>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control">
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" class="form-control" value="{{ $siswa->nisn }}">
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $siswa->name }}">
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $siswa->email }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" minlength="5">
        </div>
        <div class="form-group">
            <label for="cpassword">Konfirmasi Password</label>
            <input type="password" name="cpassword" id="cpassword" class="form-control" minlength="5">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
