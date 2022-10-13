@extends('dashboard.layouts.admin', ['title' => 'Admin Dashboard', 'sbActive' => 'dashboard'])
@section('admin-content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            Data Buku
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $buku->count() . " Buku" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            Data Author
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $author->count() . " Author" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            Data Penerbit
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $penerbit->count() . " Penerbit" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-globe-asia fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1">
                            Categories
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-dark">{{ $category->count() . " Category" }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-fw fa-buffer fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div class="row justify-content-center">
    <div class="col-md-8 mt-5">
        <canvas id="myChart" height="100px"></canvas>
    </div>
</div>


<script type="text/javascript">
    var labels = {{ Js::from($labels) }};
    var result = {{ Js::from($data) }};
    
    const data = {
    labels: labels,
    datasets: [{
            label: 'Total Data',
            backgroundColor: [
                'rgba(39, 127, 245, 0.8)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(39, 127, 245, 0.8)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: result,
        }]
    };
    
    const config = {
        type: 'line',
        data: data,
        // options: {
        //     scales: {
        //         y: {
        //             beginAtZero: true
        //         }
        //     }
        // }
    };
    
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
@endsection