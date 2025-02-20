<script>
    document.addEventListener("DOMContentLoaded", function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if (Session::has('berhasil'))
            toastr.success("{{ Session::get('berhasil') }}");
        @endif

        @if (Session::has('gagal'))
            toastr.error("{{ Session::get('gagal') }}");
        @endif
    });
</script>

<!-- Jquery JS-->
<script src="{{ asset('assets/kesiswaan') }}/vendor/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- Vendor JS       -->
<script src="{{ asset('assets/kesiswaan') }}/vendor/slick/slick.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/wow/wow.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/animsition/animsition.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/counter-up/jquery.counterup.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/circle-progress/circle-progress.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="{{ asset('assets/kesiswaan') }}/vendor/select2/select2.min.js"></script>

<!-- Main JS-->
<script src="{{ asset('assets/kesiswaan') }}/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@livewireScripts

@stack('myscript')
