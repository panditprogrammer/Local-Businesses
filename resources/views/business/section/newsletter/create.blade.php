@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage News Letters</h4>

        <!-- create news letter -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Add Email or Phone number to subscriber's records</h5>
                        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-primary btn-sm">View News Letters</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.newsletters.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email address">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <p class="str">OR</p>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone number with country code">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Add to news letter</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create news letter end -->

        <hr class="my-5">

        {{-- news letter list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Recent News Letters</h5>
                    <div class="table-responsive text-nowrap">
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
                                                {{ $newsletter->name }}
                                            </td>
                                            <td>
                                                <form class="d-inline-block"
                                                    action="{{ route('admin.newsletters.status', $newsletter->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="Click to Change"
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
                                                        class="btn btn-sm btn-outline-danger"><i
                                                            class="bx bx-trash me-1"></i>
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
        </div>
        {{-- news letter list end  --}}

    </div>
@endsection
