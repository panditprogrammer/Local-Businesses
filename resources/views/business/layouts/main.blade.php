<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-menu-fixed"
  dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/apex-charts/apex-charts.css') }}">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/js/config.js') }}"></script>

     {{-- alertify  --}}
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css" />

     {{-- filepond  --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.1/filepond.css" integrity="sha512-oISBE7Kir5CCsDuDtfghE9V/NbxLyJICOJNUuhxlXQLs9SnQIEwZvjavZtNoaArYobZBJ2hcqpZTYCAPqR7Zdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
   <!-- Layout wrapper -->
   <div class="buy-now">
    <a href="{{ route('index') }}" target="_blank" title="Go to Home" class="btn btn-success btn-sm btn-buy-now pb-2"> <i class="tf-icons bx bx-home-circle"></i> </a>
  </div>
   <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      
        @include('admin.layouts.sidebar-menu')

      <!-- Layout container -->
      <div class="layout-page">
        
        @include('admin.layouts.header-menu')

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          @yield('bodyContent')
         
          <!-- / Content -->

          @include('admin.layouts.footer')

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/ckeditor/ckeditor.js') }}"></script>

    {{-- filepond  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.32.1/filepond.min.js" integrity="sha512-clggEUZ2GsOGilTqwnU+10y6RBsvY1ZOjRLssejZDjAyWms2jlvK3ZKAWqNyN8C4Uu4o817CKOr/108wNXb4aQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Main JS -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/js/dashboards-analytics.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>

    @stack('scripts')

<script>
    alertify.set('notifier', 'position', 'top-right');
    alertify.set('notifier', 'delay', 10);
    @if (session('success'))
        alertify.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        alertify.error("{{ session('error') }}");
    @endif

    @if (session('warning'))
        alertify.warning("{{ session('warning') }}");
    @endif



    $(document).ready(function() {
        $('#avatar').change(function(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
  </body>
</html>
