<x-admin-layout-app>

    @section('title', 'Dashboard Admin')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">IMPACT - Dashboard</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Hadir</p>
                                    <h4 class="card-title">{{ $rekapPresensi->jmlhadir }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Izin</p>
                                    <h4 class="card-title">
                                        {{ $rekapizin['jmlizin'] != null ? $rekapizin['jmlizin'] : 0 }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round ">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-bed"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Sakit</p>
                                    <h4 class="card-title">
                                        {{ $rekapizin['jmlsakit'] != null ? $rekapizin['jmlsakit'] : 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Telat</p>
                                    <h4 class="card-title">
                                        {{ $rekapPresensi->jmltelat != null ? $rekapPresensi->jmltelat : 0 }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">IKHTISAR</h4>
                            {{-- <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div> --}}
                        </div>
                        <p class="card-category">Berisi Ringkasan Kehadiran Peserta Magang</p>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="delayChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Kampus</h4>
                            <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        <p class="card-category">Daftar Kampus Mahasiswa Magang Telkom Indonesia - Branch Jambi</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-round " style="min-height: 500px;">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Intern Stats</div>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="userChart"></canvas>
                                        </div>
                                        <div id="myChartLegend"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mapcontainer">
                                    <div id="presensiChart" class="w-100" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <!-- Chart JS -->
        <script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>

        <!-- jQuery Sparkline -->
        <script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- Chart Circle -->
        <script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>

        {{-- UserChart --}}
        <script>
            // Mengambil URL dari nama route 'chart.data'
            var url = "{{ route('chart.data') }}";

            // Menggunakan URL tersebut dalam fetch
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    const counts = new Array(12).fill(0);

                    data.forEach(item => {
                        counts[item.month - 1] = item.count;
                    });

                    var lineChart = document.getElementById("userChart").getContext("2d");

                    var myLineChart = new Chart(lineChart, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Active Interns",
                                borderColor: "#1d7af3",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#1d7af3",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: "transparent",
                                fill: true,
                                borderWidth: 2,
                                data: counts,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                position: "bottom",
                                labels: {
                                    padding: 10,
                                    fontColor: "#1d7af3",
                                },
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode: "nearest",
                                intersect: 0,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10,
                            },
                            layout: {
                                padding: {
                                    left: 15,
                                    right: 15,
                                    top: 15,
                                    bottom: 15
                                },
                            },
                        },
                    });
                });
        </script>
        <script>
            var url = "{{ route('presensi.chart') }}";

            // Menggunakan URL tersebut dalam fetch
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const labels = ["Mon", "Tue", "Wed", "Thu", "Fri"];
                    const hadir = [0, 0, 0, 0, 0];
                    const tidakHadir = [0, 0, 0, 0, 0];

                    data.forEach(item => {
                        if (item.day_of_week >= 2 && item.day_of_week <= 6) {
                            const index = item.day_of_week - 2;
                            hadir[index] = item.hadir;
                            tidakHadir[index] = item.tidak_hadir;
                        }
                    });

                    var ctx = document.getElementById("attendanceChart").getContext("2d");

                    var attendanceChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: "Hadir",
                                    backgroundColor: "#4caf50", // Warna untuk hadir
                                    data: hadir,
                                },
                                {
                                    label: "Tidak Hadir",
                                    backgroundColor: "#f44336", // Warna untuk tidak hadir
                                    data: tidakHadir,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 20, // Padding kiri
                                    right: 20, // Padding kanan
                                    top: 20, // Padding atas
                                    bottom: 20 // Padding bawah
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true,
                                    ticks: {
                                        padding: 10 // Padding untuk label sumbu X
                                    },
                                    grid: {
                                        drawBorder: false, // Menghapus border sumbu X
                                    }
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    ticks: {
                                        padding: 10 // Padding untuk label sumbu Y
                                    },
                                    grid: {
                                        drawBorder: false, // Menghapus border sumbu Y
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: "top",
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ": " + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        </script>
        <script>
            var url = "{{ route('keterlambatan.chart') }}";

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const labels = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];
                    const hadir = [0, 0, 0, 0, 0];
                    const terlambat = [0, 0, 0, 0, 0];
                    const tidakHadir = [0, 0, 0, 0, 0];

                    data.forEach(item => {
                        if (item.day_of_week >= 2 && item.day_of_week <= 6) { // Hanya hari Senin-Jumat
                            const index = item.day_of_week - 2;
                            hadir[index] = item.hadir;
                            terlambat[index] = item.terlambat;
                            tidakHadir[index] = item.tidak_hadir;
                        }
                    });

                    var ctx = document.getElementById("delayChart").getContext("2d");

                    var delayChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: "Hadir",
                                    backgroundColor: "rgba(165, 214, 167, 1)", // Warna lembut untuk hadir
                                    data: hadir
                                },
                                {
                                    label: "Terlambat",
                                    backgroundColor: "rgba(255, 224, 130, 1)", // Warna lembut untuk keterlambatan
                                    data: terlambat
                                },
                                {
                                    label: "Tidak Hadir",
                                    backgroundColor: "rgba(239, 154, 154, 1)", // Warna lembut untuk tidak hadir
                                    data: tidakHadir
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 20,
                                    right: 20,
                                    top: 20,
                                    bottom: 20
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true,
                                    ticks: {
                                        padding: 10
                                    },
                                    grid: {
                                        drawBorder: false
                                    }
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    ticks: {
                                        padding: 10
                                    },
                                    grid: {
                                        drawBorder: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: "top"
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ": " + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        </script>
    @endpush
</x-admin-layout-app>
