@extends('admin.layouts.main')


@section('bodyContent')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage Sliders</h4>

        <!-- create Slider -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Slider</h5>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary btn-sm">View Sliders</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.sliders.update',$slider->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="image">Slider Name</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="title">title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="describe"  value="{{ old('title', $slider->title) }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-6">
                                 <img height="240px" class="rounded shadow"
                                                src="{{ asset('/storage/' . $slider->image) }}"
                                                alt="{{ $slider->title }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- create Slider end -->

        <hr class="my-5">


    </div>
@endsection
