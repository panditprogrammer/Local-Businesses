@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">New Admin Registration</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> Fill Admin Details Here</h5>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.admins.index') }}">View admins</a>
                    </div>
                    <form class="card-body" method="POST" action="{{ route('admin.admins.store') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="boothNo" class="col-md-4 col-form-label">{{ __('register.booth_no') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="number" min="1" name="boothNo"
                                    value="{{ old('boothNo') }}" id="boothNo" placeholder="Enter Booth No" required>
                                <x-input-error :messages="$errors->get('boothNo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="fullname" class="col-md-4 col-form-label">{{ __('register.name') }} </label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="name"
                                    value="{{ old('name') }}" id="fullname" placeholder="Enter full name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                       

                        <div class="mb-3 row">
                            <label for="phoneNumber" class="col-md-4 col-form-label">{{ __('register.phone_no') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="tel" name="phoneNumber"
                                    value="{{ old('phoneNumber') }}" id="phoneNumber" placeholder="Enter phone number" required>
                                <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                            </div>
                        </div>

                      
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label">{{ __('register.email') }} <sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="email" name="email"
                                    value="{{ old('email') }}" id="email" placeholder="Enter email address">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label small">{{ __('register.password') }} <sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="password"
                                    value="{{ old('password') }}" id="password"
                                    placeholder="Enter password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="row my-4">
                            <div class="col-12 text-center">
                                <button type="submit"
                                    class="w-100 btn btn-warning">{{ __('register.submit_details') }}</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        {{-- project list end  --}}

    </div>
@endsection
