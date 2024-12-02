@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Update Information</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> User Details</h5>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.users.index') }}">View Users</a>
                    </div>
                    <form class="card-body" method="POST" action="{{ route('admin.users.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Important for the update method -->

                        <div class="mb-3 row">
                            <div class="form-label small">{{ __('register.registration_no') }}
                                <strong class="ms-4">{{ $user->registrationNo }}</strong>
                            </div>
                        </div>



                        <div class="mb-3 row">
                            <label for="avatar" class="col-md-4 col-form-label small">{{ __('register.image') }}
                                <sup class="text-danger">(max: 2MB) </sup> </label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="file" accept="image/*" name="avatar"
                                    id="avatar">
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                            </div>

                        </div>

                        <div class="mb-3 row col-12 col-md-8 mx-auto">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img src="{{ asset('/storage/' . $user->avatar) }}" alt="Old Image" class="rounded-circle"
                                        width="100px" height="100px" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="rounded-circle"
                                        width="100px" height="100px" style="display:none;" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="fullname" class="col-md-4 col-form-label small">{{ __('register.name') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="name"
                                    value="{{ old('name', $user->name) }}" id="fullname" placeholder="Enter full name"
                                    required>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="dob" class="col-md-4 col-form-label small">{{ __('register.dob') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="date" max="2010-12-31" name="dob"
                                    value="{{ old('dob', $user->dob) }}" id="dob" placeholder="Enter date of birth"
                                    required>
                                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="gender" class="col-md-4 col-form-label small">{{ __('register.gender') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <select id="gender" class="form-select form-select-sm" name="gender" required>
                                    <option value="M" {{ old('gender', $user->gender) == 'M' ? 'selected' : '' }}>
                                        {{ __('register.male') }}</option>
                                    <option value="F" {{ old('gender', $user->gender) == 'F' ? 'selected' : '' }}>
                                        {{ __('register.female') }}</option>
                                    <option value="O" {{ old('gender', $user->gender) == 'O' ? 'selected' : '' }}>
                                        {{ __('register.other') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="caste" class="col-md-4 col-form-label small">{{ __('register.caste') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="caste"
                                    value="{{ old('caste', $user->caste) }}" id="caste" placeholder="Enter caste"
                                    required>
                                <x-input-error :messages="$errors->get('caste')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="phoneNo" class="col-md-4 col-form-label small">{{ __('register.phone_no') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="tel" name="phoneNo"
                                    value="{{ old('phoneNo', $user->phoneNo) }}" id="phoneNo"
                                    placeholder="Enter phone number" required>
                                <x-input-error :messages="$errors->get('phoneNo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="whatsappNo"
                                class="col-md-4 col-form-label small">{{ __('register.whatsapp_no') }}</label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="tel" name="whatsappNo"
                                    value="{{ old('whatsappNo', $user->whatsappNo) }}" id="whatsappNo"
                                    placeholder="Enter WhatsApp number">
                                <x-input-error :messages="$errors->get('whatsappNo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email"
                                class="col-md-4 col-form-label small">{{ __('register.email') }}</label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="email" name="email"
                                    value="{{ old('email', $user->email) }}" id="email"
                                    placeholder="Enter email address">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="voterNo"
                                class="col-md-4 col-form-label small">{{ __('register.voter_no') }}</label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="voterNo" name="voterNo"
                                    value="{{ old('voterNo', $user->voterNo) }}" id="voterNo"
                                    placeholder="Enter voterNo address">
                                <x-input-error :messages="$errors->get('voterNo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="vidhansabha"
                                class="col-md-4 col-form-label small">{{ __('register.vidhanSabha') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="vidhansabha"
                                    value="{{ old('vidhansabha', $user->vidhansabha) }}" id="vidhansabha"
                                    placeholder="Enter Vidhan Sabha" required>
                                <x-input-error :messages="$errors->get('vidhansabha')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="district" class="col-md-4 col-form-label small">{{ __('register.district') }}
                                <sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="district"
                                    value="{{ old('district', $user->district) }}" id="district"
                                    placeholder="Enter district name" required>
                                <x-input-error :messages="$errors->get('district')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="village" class="col-md-4 col-form-label small">{{ __('register.village') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="village"
                                    value="{{ old('village', $user->village) }}" id="village"
                                    placeholder="Enter village name" required>
                                <x-input-error :messages="$errors->get('village')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="panchayat" class="col-md-4 col-form-label small">{{ __('register.panchayat') }}
                                <sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="text" name="panchayat"
                                    value="{{ old('panchayat', $user->panchayat) }}" id="panchayat"
                                    placeholder="Enter panchayat" required>
                                <x-input-error :messages="$errors->get('panchayat')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="wardNo" class="col-md-4 col-form-label small">{{ __('register.ward_no') }} <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="number" min="1" name="wardNo"
                                    value="{{ old('wardNo', $user->wardNo) }}" id="wardNo"
                                    placeholder="Enter ward number" required>
                                <x-input-error :messages="$errors->get('wardNo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="boothNo" class="col-md-4 col-form-label small">{{ __('register.booth_no') }}
                                </label>
                            <div class="col-md-8">
                                <input class="form-control form-control-sm" type="number" min="1" name="boothNo"
                                    value="{{ old('boothNo', $user->boothNo) }}" id="boothNo"
                                    placeholder="Enter booth number">
                                <x-input-error :messages="$errors->get('boothNo')" class="mt-2" />
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
