@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.customer'])
@section('admin-content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h1 class="h2 text-gray-800 text-center">Customer's Managements</h1>
        </div>
            @if (session()->has('errors'))
                <div class="alert alert-danger col-md-8 mt-3 ml-3 alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Profile</th>
                            <th>Nomor Handphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $i++; }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>
                                @if ($customer->image)
                                    <img src="{{ asset('storage/' . $customer->image) }}" alt="profile-customers" class="img-fluid" width="100">
                                @else
                                    <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-customers" class="img-fluid" width="100">
                                @endif
                            </td>
                            <td>{{ $customer->number_phone }}</td>
                            <td>
                                <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-primary">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                    class="d-inline d-none">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger d-none" type="submit"
                                        onclick="return confirm('Apakah yakin ingin menghapus customer ini ?')">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection