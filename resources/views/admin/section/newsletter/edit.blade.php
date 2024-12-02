@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage News Letters</h4>

        <!-- create News Letter -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit News Letter</h5>
                        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-primary btn-sm">View News Letters</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.newsletters.update',$newsletter->id) }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="John Doe" value="{{ old('email', $newsletter->email) }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <p><strong>OR</strong></p>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="John Doe" value="{{ old('phone', $newsletter->phone) }}">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create News Letter end -->

        <hr class="my-5">


    </div>
@endsection
