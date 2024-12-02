@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Admin Users</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> Users </h5>
                       <div>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.admins.export') }}" target="_blank"> Export  <i class='bx bxs-file-export'></i> </a>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.admins.create') }}">New Admin Registration</a>
                       </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Booth No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td>
                                            <strong>{{ $loop->index +1 }}</strong>
                                        </td>
                                        <td>
                                            {{ $admin->boothNo }}
                                        </td>
                                        <td>
                                            {{ $admin->name }}
                                        </td>
                                        <td>
                                            {{ $admin->email }}
                                        </td>
                                        <td><a href="tel:{{ $admin?->phoneNumber }}">{{ $admin?->phoneNumber }}</a></td>
                                        <td>
                                            {{ $admin?->role }}
                                        </td>
                                        <td>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.admins.status', $admin->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button data-toggle="tooltip" data-placement="top" title="Click to Change"
                                                    class="btn btn-sm {{ $admin->status ? 'btn-outline-success' : 'btn-outline-danger' }}"><i
                                                        class="bx {{ $admin->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                                href="{{ route('admin.admins.show', $admin->id) }}"><i
                                                    class="bx bx-show"></i></a>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.admins.edit', $admin->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.admins.destroy', $admin->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-sm btn-outline-danger"><i class="bx bx-trash me-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center py-4">
                                        <td colspan="7">No record found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end small">
                            {{ $admins->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- project list end  --}}

    </div>
@endsection
