@include('dashboard.user.layout.header')

<!-- navbar -->
@include('dashboard.user.layout.navbar')



<section id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pt-4 pt-lg-0 content">
                <h1 class="text-center mt-5">Perolehan Suara</h1>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</section>


<div>
    <div id="countdown"></div>
</div>
<div class="countdown-container">
    <div class="countdown-item">
        <div class="countdown-value" id="days"></div>
        <span class="countdown-label">Hari</span>
    </div>
    <div class="countdown-item">
        <div class="countdown-value" id="hours"></div>
        <span class="countdown-label">Jam</span>
    </div>
    <div class="countdown-item">
        <div class="countdown-value" id="minutes"></div>
        <span class="countdown-label">Menit</span>
    </div>
    <div class="countdown-item">
        <div class="countdown-value" id="seconds"></div>
        <span class="countdown-label">Detik</span>
    </div>
</div>



<!-- ======= vote Section ======= -->
@if ($remainingTime > 0)
    <section id="team" class="team section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Vote Kandidat</h2>
            </div>
            <div class="row">
                @foreach ($kandidats as $kandidat)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="member">
                            <img src="{{ asset('foto/' . $kandidat->foto) }}" class="card-img-top"
                                alt="{{ $kandidat->nama_calon }}">
                            <h5 class="card-title">{{ $kandidat->nama_kandidat }}</h5>
                            <p class="card-text">{{ $kandidat->nama_calon }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $kandidat->id }}">Lihat Visi & Misi</a>
                                <form action="{{ route('user.updateStatus') }}" class="d-inline vote-form"
                                    method="POST" data-kandidat="{{ $kandidat->id }}">
                                    @csrf
                                    <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">
                                    @if (Auth::user()->status == 1 && Auth::user()->kandidat_id == $kandidat->id)
                                        <button class="btn btn-success btn-sm" name="submit" type="submit"
                                            disabled>Pilih Calon</button>
                                    @elseif (Auth::user()->status == 1)
                                        <button class="btn btn-success btn-sm" name="submit" type="submit"
                                            disabled>Anda Sudah Memilih</button>
                                    @elseif (Auth::user()->kandidat_id == $kandidat->id)
                                        <button class="btn btn-success btn-sm" name="submit" type="submit"
                                            disabled>Anda Sudah Memilih</button>
                                    @else
                                        <button class="btn btn-success btn-sm submit-btn" name="submit"
                                            type="submit">Pilih Calon</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section id="testimonials" class="testimonials section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Pemenang</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                    <div class="card-body">
                        <div class="section-title">
                            <h3>Pemenang Pertama</h3>
                        </div>
                        @if($pemenang)
                            <img src="{{ asset('foto/' . $pemenang->foto) }}" class="card-img-top" alt="Foto">
                            <h5 class="card-title">{{ $pemenang->nama_calon }}</h5>
                            <p>Jumlah Suara: {{ $jumlah_suara_terbanyak }}</p>
                        @else
                            <p>Tidak ada suara yang masuk.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                    <div class="card-body">
                        <div class="section-title">
                            <h3>Pemenang Kedua</h3>
                        </div>
                        @if($pemenang_kedua)
                            <img src="{{ asset('foto/' . $pemenang_kedua->foto) }}" class="card-img-top" alt="Foto">
                            <h5 class="card-title">{{ $pemenang_kedua->nama_calon }}</h5>
                            <p>Jumlah Suara: {{ $jumlah_suara_terbanyak_kedua }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                    <div class="card-body">
                        <div class="section-title">
                            <h3>Pemenang Ketiga</h3>
                        </div>
                        @if($pemenang_ketiga)
                            <img src="{{ asset('foto/' . $pemenang_ketiga->foto) }}" class="card-img-top" alt="Foto">
                            <h5 class="card-title">{{ $pemenang_ketiga->nama_calon }}</h5>
                            <p>Jumlah Suara: {{ $jumlah_suara_terbanyak_ketiga }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ======= vote script ======= -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const submitBtns = document.querySelectorAll('.submit-btn');
        const voteForms = document.querySelectorAll('.vote-form');

        submitBtns.forEach(function(submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const kandidatId = this.closest('form').getAttribute('data-kandidat');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        voteForms.forEach(function(voteForm) {
                            if (voteForm.getAttribute('data-kandidat') ==
                                kandidatId) {
                                const formData = new FormData(voteForm);
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', voteForm.action);
                                xhr.setRequestHeader('X-CSRF-TOKEN',
                                    '{{ csrf_token() }}');
                                xhr.onload = function() {
                                    if (xhr.status === 200 && xhr
                                        .responseText !== '') {
                                        Swal.fire({
                                            title: 'Sukses!',
                                            text: 'Terima kasih telah memberikan suaramu.',
                                            icon: 'success'
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: 'Terjadi kesalahan saat memilih kandidat. Silakan coba lagi.',
                                            icon: 'error'
                                        });
                                    }
                                };
                                xhr.send(formData);
                            }
                        });
                    }
                });
            });
        });
    });
</script>

<!-- Modal visi dan misi -->
@foreach ($kandidats as $kandidat)
    <div class="modal fade" id="exampleModal{{ $kandidat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-header">
                    <img src="{{ asset('foto/' . $kandidat->foto) }}" class="card-img-top"
                        alt="{{ $kandidat->nama_calon }}">

                </div>
                <div class="modal-body">
                    @foreach (App\Models\visimisi::where('id_kandidat', $kandidat->id)->get() as $visiMisi)
                        <h6 class="card-title">{!! $visiMisi->visi !!}</h6>
                        <p class="card-text">{!! $visiMisi->misi !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- script  Chart-->
<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Calon Ke-1', 'Calon Ke-2', 'Calon Ke-3'],
            datasets: [{
                label: 'Suara Masuk',
                data: [
                    <?php echo $jumlah_suara_kandidat1; ?>,
                    <?php echo $jumlah_suara_kandidat2; ?>,
                    <?php echo $jumlah_suara_kandidat3; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // warna untuk bar pertama
                    'rgba(54, 162, 235, 0.2)', // warna untuk bar kedua
                    'rgba(255, 206, 86, 0.2)' // warna untuk bar ketiga
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // warna border untuk bar pertama
                    'rgba(54, 162, 235, 1)', // warna border untuk bar kedua
                    'rgba(255, 206, 86, 1)' // warna border untuk bar ketiga
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<script>
    // Mendapatkan waktu countdown dari PHP view
    var countdownDate = "{{ $countdown->countdown_date }}";

    // Fungsi untuk menampilkan countdown
    function showCountdown() {
        // Konversi waktu countdown ke milidetik
        var countDownTime = new Date(countdownDate).getTime();

        // Konversi waktu sekarang ke milidetik
        var now = new Date().getTime();

        // Hitung selisih waktu antara countdown dengan sekarang
        var remainingTime = countDownTime - now;

        // Konversi selisih waktu ke detik
        var seconds = Math.floor(remainingTime / 1000) % 60;
        var minutes = Math.floor(remainingTime / (1000 * 60)) % 60;
        var hours = Math.floor(remainingTime / (1000 * 60 * 60)) % 24;
        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));

        // Menampilkan nilai countdown pada div dengan class "countdown-container"
        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);

        // Menghentikan countdown jika waktu sisa sudah habis
        if (remainingTime < 0) {
            clearInterval(countdown);
            $("#days").html("0");
            $("#hours").html("0");
            $("#minutes").html("0");
            $("#seconds").html("0");
            $("#countdown").html("Waktu telah habis ! </br> Terima kasih Sudah Berpartisipasi");
            $("#team").addClass("d-none");
        }
    }

    // Memanggil fungsi showCountdown() setiap detik
    var countdown = setInterval(showCountdown, 1000);
</script>



<!-- ======= Footer ======= -->
@include('dashboard.user.layout.footer')
