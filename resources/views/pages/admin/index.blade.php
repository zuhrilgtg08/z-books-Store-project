@extends('dashboard.layouts.admin', ['sbActive' => 'dashboard'])
@section('admin-content')
    <style>
        .box:hover {
            transform: scale(1.1);
            transition: .3s ease-in-out;
        }

        .box a:hover {
            text-decoration: underline;
            color: #333;
        }

        a{
            text-decoration: none;
            color: #333;
        }
    </style>

<div class="row justify-content-center mt-3">
    <div class="col-xl-3 col-md-6 mb-4 box">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            <a href="{{ route('buku.index') }}">Data Buku</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $buku->count() . " Buku" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-book fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 box">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            <a href="{{ route('author.index') }}">Data Author</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $author->count() . " Author" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-user fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 box">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            <a href="{{ route('penerbit.index') }}">Data Penerbit</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $penerbit->count() . " Penerbit" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-globe-asia fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 box">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            <a href="{{ route('categories.index') }}">Data Category</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $category->count() . " Categories" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-fw fa-buffer fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-around mt-5">
    <div class="col-md-6">
        <canvas id="myChart1" height="100px"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="myChart2" height="100px"></canvas>
    </div>
</div>


<script type="text/javascript">
    var labels1 = {{ Js::from($labels1) }};
    var result1 = {{ Js::from($data1) }};
    var labels2 = {{ Js::from($labels2) }};
    var result2 = {{ Js::from($data2) }};
    
    const data1 = {
    labels: labels1,
        datasets: [{
            label: 'Chart Bar',
            backgroundColor: [
                'rgba(235, 210, 22, 1)',
                'rgba(22, 235, 197, 1)',
                'rgba(250, 15, 15, 0.96)',
            ],
            borderColor: [
                'rgba(73, 68, 68, 0.13)',
            ],
            data: result1,
        }]
    };

    const data2 = {
    labels: labels2,
        datasets: [{
            label: 'Chart Line',
            backgroundColor: [
                'rgb(75, 192, 192)',
                'rgba(22, 235, 24, 1)',
                'rgba(235, 22, 228, 1)',
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            data: result2,
            tension: 0.1
        }]
    }
    
    const config1 = {
        type: 'bar',
        data: data1,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const config2 = { 
        type: 'line',
        data: data2,
    }
    
    const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
    );

    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>
@endsection