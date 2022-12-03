@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'ordersCustomer'])
@section('admin-content')
    {{ $order->uuid }}
@endsection