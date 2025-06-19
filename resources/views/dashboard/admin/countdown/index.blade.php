@extends('dashboard.admin.home')

@section('konten')
    <div class="container">
        <div class="row justify-content-center">
            <p class="card-title">Pengaturan Voting</p>
            <div class="col-md-8">
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($countdown)
                        <p id="countdown"></p>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="countdown-item">
                                    <div class="countdown-value" id="days"></div>
                                    <span class="countdown-label">Hari</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="countdown-item">
                                    <div class="countdown-value" id="hours"></div>
                                    <span class="countdown-label">Jam</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="countdown-item">
                                    <div class="countdown-value" id="minutes"></div>
                                    <span class="countdown-label">Menit</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="countdown-item">
                                    <div class="countdown-value" id="seconds"></div>
                                    <span class="countdown-label">Detik</span>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.countdown.updateTime') }}" class="mt-3">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-2">
                                <label for="status">Note:</label>
                                <span class="form-control">{{ $countdown->status === 'active' ? 'Active' : 'Non-Active' }}</span>
                            </div>

                            <div class="form-group mb-2">
                                <label for="countdown_date">Tanggal dan Waktu:</label>
                                <input type="datetime-local" class="form-control form-control-sm" id="countdown_date"
                                    name="countdown_date"
                                    value="{{ $countdown->countdown_date ? $countdown->countdown_date->format('Y-m-d\TH:i') : '' }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    @else
                        <div class="alert alert-info text-center">
                            Belum ada waktu voting yang diatur.
                        </div>

                        <form method="POST" action="{{ route('admin.countdown.store') }}" class="mt-3">
                            @csrf

                            <div class="form-group mb-2">
                                <label for="countdown_date">Tanggal dan Waktu:</label>
                                <input type="datetime-local" class="form-control form-control-sm" id="countdown_date"
                                    name="countdown_date" required>
                            </div>

                            <button type="submit" class="btn btn-success">Buat Countdown</button>
                        </form>
                    @endif
                </div>

                @if ($countdown)
                    <script>
                        function countdown() {
                            var countDownDate = new Date("{{ $countdown->countdown_date }}").getTime();

                            var x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = countDownDate - now;

                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                // Format angka 0 di depan
                                days = days < 10 ? "0" + days : days;
                                hours = hours < 10 ? "0" + hours : hours;
                                minutes = minutes < 10 ? "0" + minutes : minutes;
                                seconds = seconds < 10 ? "0" + seconds : seconds;

                                document.getElementById("days").innerHTML = days;
                                document.getElementById("hours").innerHTML = hours;
                                document.getElementById("minutes").innerHTML = minutes;
                                document.getElementById("seconds").innerHTML = seconds;

                                if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById("countdown").innerHTML = "WAKTU PEMILIHAN BERAKHIR";
                                    document.getElementById("days").innerHTML = "00";
                                    document.getElementById("hours").innerHTML = "00";
                                    document.getElementById("minutes").innerHTML = "00";
                                    document.getElementById("seconds").innerHTML = "00";
                                }

                            }, 1000);
                        }

                        countdown();
                    </script>
                @endif

            </div>
        </div>
    </div>
@endsection
