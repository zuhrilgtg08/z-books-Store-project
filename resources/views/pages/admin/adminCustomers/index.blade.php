@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.customer'])
@section('admin-content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h1 class="h2 text-gray-800 text-center">Customers Manage</h1>
        </div>
            @if (session()->has('errors'))
                <div class="alert alert-danger col-md-8 mt-3 ml-3" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Profile</th>
                            <th>Phone Number</th>
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
                                    {{-- <div class="col-md-4 text-center" style="overflow:hidden; width: 300px"> --}}
                                        <img src="{{ asset('storage/' . $customer->image) }}" alt="profile-customers" class="img-fluid" width="100">
                                    {{-- </div> --}}
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
                                    class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit"
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