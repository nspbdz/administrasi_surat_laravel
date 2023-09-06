
<script>
    $(function () {
        const Alert = swal.mixin({
            showConfirmButton: true,
        });

        @if(session('success'))
        swal({
            icon: 'success',
            title: `{{ session('success') }}`
        })
        @endif

        @if(session('error'))
        swal({
            icon: 'error',
            title: `{{ session('error') }}`,
            text: `{{ request()->session()->has('error_message')? session('error_message'): null }}`
        })
        @endif
    })

</script>
