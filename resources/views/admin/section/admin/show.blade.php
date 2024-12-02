@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">All admins</h4>

        {{-- project list  --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> admin Details</h5>
                        <div>
                            <a class="btn btn-sm btn-info" href="{{ route('admin.admins.edit', $admin->id) }}">Edit</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.admins.index') }}">View admins</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                       
                        <div class="table-responsive">
                            <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">ID/Role</th>
                                        <td>{{ $admin?->id . " / ".$admin?->role}}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <th scope="col">{{ __('register.booth_no') }}</th>
                                        <td scope="row">{{ $admin?->boothNo }}</td>
                                    </tr>
                                    
                                    <tr class="">
                                        <th scope="col">{{ __('register.name') }}</th>
                                        <td scope="row">{{ $admin?->name }}</td>
                                    </tr>
                                  
                                    <tr class="">
                                        <td scope="row">{{ __('register.phone_no') }}</td>
                                        <td><a href="tel:+91{{ $admin?->phoneNumber }}">{{ $admin?->phoneNumber }}</a></td>
                                    </tr>
                                 
                                    <tr class="">
                                        <td scope="row">{{ __('register.email') }}</td>
                                        <td><a href="mailto:{{ $admin?->email }}">{{ $admin?->email }}</a></td>
                                    </tr>
                                   
                                    <tr class="">
                                        <td scope="row">{{ __('register.date_time') }}</td>
                                        <td>{{ $admin?->created_at }}</td>
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
