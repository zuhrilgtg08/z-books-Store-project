@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.penerbit'])
@section('admin-content')
<a href="{{ route('penerbit.index') }}" class="btn btn-dark mb-3">
    <i class="fas fa-fw fa-arrow-left"></i> 
    Back
</a>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg my-5">
            <div class="card-header">
                <h1 class="h2 mb-3 text-gray-800 text-center">Detail Penerbit</h1>
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Nama Penerbit : {{ $penerbit->nama_penerbit }}</h4>
                <h6 class="font-weight-bold card-text">Tahun Terbit: {{ $penerbit->tahun_terbit }}</h6>
                <h6 class="font-weight-bold card-text">Kode Penerbit: {{ $penerbit->kode_terbit }}</h6>
            </div>
        </div>
    </div>
</div>
@endsection