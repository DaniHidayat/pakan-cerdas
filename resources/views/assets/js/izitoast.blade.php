
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
@if (session()->has('success'))
    <script>
        iziToast.success({
            title: 'Success !',
            message: "{{ session('success') }}",
            position: 'topRight'
        });
        // toastr.success("{{ session('success') }}", 'Berhasil !');
    </script>
@endif

@if (session()->has('warning'))
    <script>
        iziToast.warning({
            title: 'Warning !',
            message: "{{ session('warning') }}",
            position: 'topRight'
        });
        // toastr.warning("{{ session('warning') }}", 'Peringatan !');
    </script>
@endif

@if (session()->has('info'))
    <script>

        iziToast.error({
            title: 'Information !',
            message: "{{ session('info') }}",
            position: 'topRight'
        });
        // toastr.info("{{ session('info') }}", 'Informasi !');
    </script>
@endif

@if (session()->has('error'))
    <script>
        iziToast.error({
            title: 'Error !',
            message: "{{ session('error') }}",
            position: 'topRight'
        });
        // toastr.error("{{ session('error') }}", 'Error !');
    </script>
@endif