@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage Categories</h4>

        <!-- create category -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create New category</h5>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">View Categories</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="John Doe" required maxlength="25">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create category end -->

        <hr class="my-5">

        {{-- category list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Recent Categories</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->name }}
                                        </td>

                                        <td>
                                            {{ $category->status }}
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                                href="{{ route('admin.categories.show', $category->id) }}"><i
                                                    class="bx bx-show"></i></a>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
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
                </div>

            </div>
        </div>
        {{-- category list end  --}}

    </div>
@endsection
