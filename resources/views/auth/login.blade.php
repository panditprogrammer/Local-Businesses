@extends('auth.layouts.main')

@section('title')
    Business Login
@endsection

@section('bodyContent')
    <!-- Register Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="{{ route('index') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img width="60px" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </span>
                    <span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-4 text-center">Business Login </h4>

            <form method="POST" class="mb-3" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="Enter your password" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                        <label class="form-check-label" for="terms-conditions">
                            Remember Me
                        </label>
                    </div>
                </div>
                <button class="my-2 btn btn-warning d-grid w-100">Log in</button>
            </form>

        </div>
    </div>
    <!-- Register Card -->
@endsection
