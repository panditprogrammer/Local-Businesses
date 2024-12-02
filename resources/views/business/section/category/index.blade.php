@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Categories</h4>

        {{-- Category list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Categories</h5>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">Create New
                            Category</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <strong>{{ $category->id }}</strong>
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.categories.status', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button data-toggle="tooltip" data-placement="top" title="Click to Change" class="btn btn-sm {{ $category->status ? "btn-outline-success": "btn-outline-danger"}}"><i
                                                        class="bx {{ $category->status ? "bx-check-circle": "bx-x-circle"}}"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('All Posts related to this category will be deleted permanently. Are you sure to delete?')"
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
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- Category list end  --}}

    </div>
@endsection
