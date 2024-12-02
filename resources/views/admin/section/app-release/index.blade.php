@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All App Releases</h4>

        {{-- Media list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">App Releases</h5>
                        <a href="{{ route('admin.app-release.create') }}" class="btn btn-primary btn-sm">Create New Release</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Release</th>
                                    <th>version</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($appReleases as $appRelease)
                                    <tr>
                                        <td>
                                            <strong>{{ $appRelease->id }}</strong>
                                        </td>
                                        <td>
                                             {{asset('/storage/' . $appRelease->url) }}
                                        </td>
                                        <td>
                                            <strong>{{ $appRelease->version }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $appRelease->created_at }}</strong>
                                        </td>
                                      
                                        <td>
                                            <button title="Copy to clipboard"
                                                data-url="{{ str_starts_with($appRelease->url, 'http') ? $appRelease->url : asset('/storage/' . $appRelease->url) }}"
                                                class="copyLinkBtn btn btn-sm btn-outline-success">
                                                <i class="bx bx-clipboard"></i>
                                            </button>
                                          
                                            <form class="d-inline-block"
                                                action="{{ route('admin.app-release.destroy', $appRelease->id) }}" method="post">
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
