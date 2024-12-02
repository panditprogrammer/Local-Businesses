@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Home Sliders</h4>

        {{-- Media list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Home Sliders</h5>
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">Upload
                            Slider</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <td>
                                            <strong>{{ $slider->id }}</strong>
                                        </td>
                                        <td>
                                            <img loading="lazy" height="50px" class="rounded"
                                                src="{{ str_starts_with($slider->image, 'http') ? $slider->image : asset('/storage/' . $slider->image) }}"
                                                alt="{{ $slider->title }}">
                                        </td>
                                        <td>
                                            <strong>{{ $slider->title }}</strong>
                                        </td>
                                        <td>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.sliders.status', $slider->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button data-toggle="tooltip" data-placement="top" title="Click to Change"
                                                    class="btn btn-sm {{ $slider->status ? 'btn-outline-success' : 'btn-outline-danger' }}"><i
                                                        class="bx {{ $slider->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <button title="Copy to clipboard"
                                                data-url="{{ str_starts_with($slider->image, 'http') ? $slider->image : asset('/storage/' . $slider->image) }}"
                                                class="copyLinkBtn btn btn-sm btn-outline-success">
                                                <i class="bx bx-clipboard"></i>
                                            </button>
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.sliders.edit', $slider->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('admin.sliders.destroy', $slider->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-sm btn-outline-danger"><i class="bx bx-trash me-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center py-4">
                                        <td colspan="5">No record found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        {{-- Media list end  --}}

    </div>
@endsection
