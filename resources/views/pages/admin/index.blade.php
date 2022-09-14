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

    <div class="col-xl-3 col-md-6 mb-4">
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
    </div>
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
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 51, 51)',
                'rgb(102, 255, 102)',
            ],
            borderColor: 'rgb(255, 250, 255)',
            data: result,
        }]
    };
    
    const config = {
        type: 'bar',
        data: data,
        options: {}
    };
    
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
@endsection