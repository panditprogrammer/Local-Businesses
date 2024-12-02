@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (auth("adminGuard")->user()?->role === "super")
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                    class="rounded" />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Projects</span>
                        <h3 class="card-title mb-2">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Contacts</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/img/icons/unicons/cc-primary.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Users</span>
                        <h3 class="card-title mb-2">{{ $userCounts }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                    class="rounded" />
                            </div>
                        </div>
                        <span class="d-block mb-1">Today Registrations</span>
                        <h3 class="card-title mb-2">{{ count($todayUsers) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Registration in Last 7 days</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $weeklyUsers }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> Today Registered Users</h5>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.users.index') }}">View all</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Reg. No.</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($todayUsers as $user)
                                    <tr>
                                        <td>
                                            <strong>{{ $user->id }}</strong>
                                        </td>
                                        <td>{{ $user->name }} </td>
                                        <td>{{ $user->dob }} </td>
                                        <td><a href="mailto:{{ $user?->email }}">{{ $user?->email }}</a></td>
                                       
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.users.show', $user->id) }}"><i
                                                    class="bx bx-show"></i></a>
                                            {{-- <a class="btn btn-sm text-primary" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <a class="btn btn-sm text-danger" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i> </a> --}}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end small">
                            {{ $todayUsers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
