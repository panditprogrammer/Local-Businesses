@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage Categories</h4>

        <!-- create category -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit category</h5>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">View Categories</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.update',$category->id) }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="John Doe" required maxlength="25" value="{{ old('name', $category->name) }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create category end -->

        <hr class="my-5">


    </div>
@endsection
