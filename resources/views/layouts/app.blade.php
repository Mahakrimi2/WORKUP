<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="shortcut icon" href="{{asset('assets/images/loader.gif')}}" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/backend.min.css?v=1.0.1') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
        <!-- Fullcalendar CSS -->
        <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/core/main.css') }}"/>
        <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/daygrid/main.css') }}"/>
        <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/timegrid/main.css') }}" />
        <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/list/main.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @if (Request::is("user/profile"))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="fixed-top-navbar">

        <div id="loading">
            <div id="loading-center">
            </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
        @livewire("navigation-menu")
        <div class="content-page">
          <div class="container-fluid container">


            <!-- Page Heading -->


            <!-- Page Content -->

                {{ $slot }}


            </div>
        </div>
        @livewire('layout.footer')
      </div>

        @stack('modals')

<script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/js/customizer.js') }}"></script>

<!-- Fullcalendar Javascript -->

<script src='{{ asset('assets/vendor/fullcalendar/core/main.js') }}'></script>
<script src='{{ asset('assets/vendor/fullcalendar/daygrid/main.js') }}'></script>
<script src='{{ asset('assets/vendor/fullcalendar/timegrid/main.js') }}'></script>
<script src='{{ asset('assets/vendor/fullcalendar/list/main.js') }}'></script>
<script src='{{ asset('assets/vendor/fullcalendar/interaction/main.js') }}'></script>

<!-- app JavaScript -->
<script src="{{ asset('assets/js/app.js') }}"></script>

        @stack('scripts')
        @stack('calendrier')
        @livewireScripts

    </body>
</html>
