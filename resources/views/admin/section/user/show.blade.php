@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All Users</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> User Details</h5>
                        <div>
                            <a class="btn btn-sm btn-info" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.users.index') }}">View Users</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <div class="row my-2 px-0 mx-0">
                            <div class=" w-100 d-flex justify-content-start align-items-center">
                                <img src="{{ asset('/storage/' . $user->avatar) }}" alt="Image" class="rounded-circle"
                                    width="100px" height="100px" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('register.registration_no') }}</th>
                                        <td>{{ $user?->registrationNo }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <th scope="col">{{ __('register.name') }}</th>
                                        <td scope="row">{{ $user?->name }}</td>
                                    </tr>
                                    <tr class="">
                                        <th scope="col">{{ __('register.dob') }}</th>
                                        <td scope="row">{{ $user?->dob }}</td>
                                    </tr>
                                    <tr class="">
                                        <th scope="col">{{ __('register.gender') }}</th>
                                        <td scope="row">
                                            @switch($user?->gender)
                                                @case('M')
                                                    {{ __('register.male') }}
                                                @break

                                                @case('F')
                                                    {{ __('register.female') }}
                                                @break

                                                @default
                                                    {{ __('register.other') }}
                                            @endswitch

                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th scope="col">{{ __('register.caste') }}</th>
                                        <td scope="row">{{ $user?->caste }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.phone_no') }}</td>
                                        <td><a href="tel:+91{{ $user?->phoneNo }}">{{ $user?->phoneNo }}</a></td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.whatsapp_no') }}</td>
                                        <td><a target="_blank"
                                                href="https://api.whatsapp.com/send/?phone=+91%{{ $user?->whatsappNo }}&text=Hi">{{ $user?->whatsappNo }}</a>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.email') }}</td>
                                        <td><a href="mailto:{{ $user?->email }}">{{ $user?->email }}</a></td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.voter_no') }} </td>
                                        <td>{{ $user?->voterNo }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.vidhanSabha') }} </td>
                                        <td>{{ $user?->vidhansabha }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.district') }} </td>
                                        <td>{{ $user?->district }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.village') }} </td>
                                        <td>{{ $user?->village }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.panchayat') }} </td>
                                        <td>{{ $user?->panchayat }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.ward_no') }} </td>
                                        <td>{{ $user?->wardNo }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.booth_no') }}</td>
                                        <td>{{ $user?->boothNo }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">{{ __('register.date_time') }}</td>
                                        <td>{{ $user?->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        {{-- project list end  --}}

    </div>
@endsection
