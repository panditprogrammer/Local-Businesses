@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All News Letters</h4>

        {{-- Category list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Subscribed Users </h5>
                        <a href="{{ route('admin.newsletters.create') }}" class="btn btn-primary btn-sm">Add User to News
                            Letter</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($newsletters as $newsletter)
                                    <tr>
                                        <td>
                                            <strong>{{ $newsletter->id }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $newsletter->email }}">{{ $newsletter->email }}</a>
                                        </td>
                                        <td>
                                            <a href="tel:+{{ $newsletter->phone }}">{{ $newsletter->phone }}</a>
                                        </td>
                                        <td>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.newsletters.status', $newsletter->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button data-toggle="tooltip" data-placement="top" title="Click to Change"
                                                    class="btn btn-sm {{ $newsletter->status ? 'btn-outline-success' : 'btn-outline-danger' }}"><i
                                                        class="bx {{ $newsletter->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.newsletters.edit', $newsletter->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.newsletters.destroy', $newsletter->id) }}"
                                                method="post">
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

                    <div class="col-12 my-4 px-2">
                        <div class="d-flex justify-content-end small">
                            {{ $newsletters->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- Category list end  --}}

    </div>
@endsection
