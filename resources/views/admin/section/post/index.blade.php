@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Posts</h4>

        {{-- Post list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Your Posts</h5>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">Create New Post</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Published</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>
                                            <strong>{{ $post->id }}</strong>
                                        </td>
                                        <td>
                                            {{ substr($post->title,0,50) }}
                                        </td>
                                        <td>
                                            <img loading="lazy" height="50px" class="rounded"
                                                src="{{ str_starts_with($post->image, 'http') ? $post->image : asset('/storage/' . $post->image) }}"
                                                alt="post-image">
                                        </td>
                                        <td>
                                            {{ $post->category->name }}
                                        </td>
                                        <td>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.posts.status', $post->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button data-toggle="tooltip" data-placement="top" title="Click to Change"
                                                    class="btn btn-sm {{ $post->status ? 'btn-outline-success' : 'btn-outline-danger' }}"><i
                                                        class="bx {{ $post->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.posts.edit', $post->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
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
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
        {{-- Post list end  --}}

    </div>
@endsection
