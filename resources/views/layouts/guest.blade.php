<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Autentikasi</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('dakon/html5-qrcode.min.js') }}"></script>
        <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
    <script>
        function onScanSuccess(qrCodeMessage) {
            // handle on success condition with the decoded message
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
            $.ajax({
                
                type: "POST",
                cache: false,
                url : "{{ route('qr.login') }}",
                data: {"_token": "{{ csrf_token() }}",data:qrCodeMessage},
                    success: function(data) {
                    console.log(data);
                    if (data==1) {
                        $(location).attr('href', '{{url('/login')}}');
                    }else{
                        return confirm('Belum terdaftar, silhakan muat ulang halaman untuk kembali login'); 
                        html5QrcodeScanner.render();
                    }
                          // 
                    }
                })
        }

        function onScanError(errorMessage) {
            //
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanError);

    </script>
</html>
