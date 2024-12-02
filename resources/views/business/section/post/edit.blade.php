@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage Projects</h4>

        <!-- Update project -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update New Project</h5>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-sm">View Posts</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.posts.update',$post->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="title">Post Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter post title" required maxlength="150" value="{{ old('title',$post->title) }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="description">Post Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter post description" required value="{{ old('description',$post->description) }}">
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="smallSelect" class="form-label">Category</label>
                                    <select id="smallSelect" class="form-select form-select" required name="category_id">
                                        @forelse ($categories as $category)
                                            <option {{ old('category_id',$post->category_id) === $category->id ? 'selected' : null }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option disabled>No Category Available</option>
                                        @endforelse
                                    </select>
                                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image">Post Image (max: 2MB)</label>
                                    <input type="file" accept="image/*" class="form-control" id="image"
                                        name="image" placeholder="Enter post image" value="{{ old('image') }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="content">Write Here...</label>
                                <textarea id="content" class="form-control" placeholder="Describe Here" rows="5" name="content" required>{{ old('content',$post->content) }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>


                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- Update project end -->

        <hr class="my-5">


    </div>
@endsection
