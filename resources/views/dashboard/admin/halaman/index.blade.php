@extends('dashboard.admin.home')
@section('konten')
    <p class="card-title">HALAMAN UTAMA E-VOTING</p>


    <div class="container" style="text-align: center;">
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="mdi mdi-account-multiple-plus me-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Siswa</small>
                            <h5 class="me-2 mb-0">{{ $total_users }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="text-align: center;">
                <div class="card h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="mdi mdi-chart-areaspline me-3 icon-lg text-success"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total suara </small>
                            <h5 class="me-2 mb-0">{{ $total_suara }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-warning btn-icon-text mdi mdi-reload btn-icon-prepend" onclick="resetSuara()">
            Reset Perolehan Suara
        </button>
    </div>


    <div class="chart-container mt-3" style="height: 400px; width: 100%;">
        <canvas id="myChart"></canvas>
    </div>



    <script>
        function resetSuara() {
            window.location.href = "{{ route('admin.halaman.index') }}";
        }
    
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
                        beginAtZero: true,
                       
                    }
                }
            }
        });
    </script>
@endsection
