@include('dashboard.user.layout.header')

<!-- navbar -->
@include('dashboard.user.layout.navbar')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1>SELAMAT DATANG <br /> DI WEB E-VOTING</h1>
                <h2>Gunakan hak suara anda untuk memilih <br /> ketua dan wakil ketua osis yang baru</h2>
                <div class="d-flex">
                    <a href="" class="btn-get-started" data-bs-toggle="modal" data-bs-target="#modallogin">Login</a>
                    <a href="#" class="btn-get-started scrollto" style="margin-left: 20px;" data-bs-toggle="modal"
                        data-bs-target="#modalregister">Registrasi</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                <img src="{{ asset('assets') }}/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<!-- Modal Login -->
<div class="modal fade" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mx-auto text-light" id="exampleModalLabel">Form Login</h5>
            </div>            
            <form action="{{ route('user.check') }}" method="post" autocomplete="off"
                onsubmit="return validateLoginForm()">

                <div class="modal-body">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="nisn">Nisn</label>
                        <input type="text" class="form-control" name="nisn" placeholder="Masukkan Nisn"
                            value="{{ old('nisn') }}">
                        <span class="text-danger">
                            @error('nisn')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password"
                            value="{{ old('password') }}">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Register-->
<div class="modal fade" id="modalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary d-flex justify-content-center">
                <h5 class="modal-title text-light text-center w-100" id="exampleModalLabel">Form Registrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>            
            <form action="{{ route('user.create') }}" method="post" autocomplete="off">
                <div class="modal-body" id="error-message">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @csrf
                    <div class="form-group" style="margin-bottom: 15px;" style="margin-bottom: 15px;">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-select" id="kelas_id" name="kelas_id">
                            <option selected disabled>Pilih Kelas</option>
                            @foreach (App\Models\kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('kelas_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="nisn">Nisn</label>
                        <input type="text" class="form-control" name="nisn" placeholder="Masukkan Nisn anda"
                            value="{{ old('nisn') }}">
                        <span class="text-danger">
                            @error('nisn')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="Masukkan nama Lengkap" value="{{ old('name') }}">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="text-danger">
                            @error('jenis_kelamin')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Masukkan email"
                            value="{{ old('email') }}">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password"
                            value="{{ old('password') }}">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="cpassword">konfirmasi Password</label>
                        <input type="password" class="form-control" name="cpassword"
                            placeholder="Konfirmasi Password" value="{{ old('cpassword') }}">
                        <span class="text-danger">
                            @error('cpassword')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group" style="padding-bottom: 10px;">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <br>
                    <p>Sudah memiliki akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modallogin"
                            data-bs-dismiss="modal">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- ======= Footer ======= -->
@include('dashboard.user.layout.footer')
