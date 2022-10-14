@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.customer'])
@section('admin-content')
<div class="row mb-3">
    <div class="col-md-4">
        <a href="{{ route('customer.index') }}" class="btn btn-dark mb-3">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back
        </a>
    </div>
</div>

<h1 class="h2 text-gray-800 text-center">Detail Customer</h1>

<div class="row justify-content-center">
    <div class="card border-0 shadow-lg my-3" style="width: 22rem;">
        @if ($detail->image)
            <img src="{{ asset('storage/' . $detail->image) }}" alt="profile-customers" class="card-img-top">
        @else
            <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-customers" class="card-img-top">
        @endif
        <div class="card-body">
            <h5 class="card-title">Name : {{ $detail->name }}</h5>
            <h6 class="card-title">Email : {{ $detail->email }}</h6>
            <p class="card-text">Address : {{ $detail->alamat }}</p>
            <p class="card-text">Phone Number : {{ $detail->number_phone }}</p>
        </div>
    </div>
</div>
@endsection