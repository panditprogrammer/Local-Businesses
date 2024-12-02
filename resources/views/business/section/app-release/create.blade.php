@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage App Release</h4>

        <!-- create Slider -->
        <div class="row">
            <div class="col-xl-12">

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Upload New Release App</h5>
                        <a href="{{ route('admin.app-release.index') }}" class="btn btn-primary btn-sm">View App Release</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.app-release.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">                                    
                                    <label class="form-label" for="apk">Upload APK File</label>
                                    <input type="file" class="filepond" id="file" name="file" accept=".apk, application/vnd.android.package-archive" />
                                    <input type="hidden" name="url" id="url">
                                    <x-input-error :messages="$errors->get('url')" class="mt-2" />
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="version">version</label>
                                    <input type="text" placeholder="eg: 1.0.0" class="form-control" id="version"
                                        name="version" value="{{old('version')}}">
                                    <x-input-error :messages="$errors->get('version')" class="mt-2" />
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Release Now </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create Slider end -->

        <hr class="my-5">

    </div>
@endsection

@push('scripts')
    <script>
        ajaxFileUpload('/api/file-upload', "#file", "url")
    </script>
@endpush
