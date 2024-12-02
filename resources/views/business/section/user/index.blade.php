@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Registrations</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> Users </h5>
                       <div>
                        @if (auth('adminGuard')->user()->role === 'super')
                        <a class="btn btn-sm btn-info" href="{{ route('admin.users.export') }}" target="_blank"> Export  <i class='bx bxs-file-export'></i> </a>
                        @endif

                        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.create') }}">New Registration</a>
                       </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Reg. No.</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>Village</th>
                                    <th>Booth No.</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <strong>{{ $user->registrationNo }}</strong>
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->dob }}
                                        </td>
                                        <td><a href="tel:{{ $user?->phoneNo }}">{{ $user?->phoneNo }}</a></td>
                                        <td>
                                            {{ $user?->village }}
                                        </td>
                                        <td>{{ $user?->boothNo }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                                href="{{ route('admin.users.show', $user->id) }}"><i
                                                    class="bx bx-show"></i></a>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.users.edit', $user->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- project list end  --}}

    </div>
@endsection
