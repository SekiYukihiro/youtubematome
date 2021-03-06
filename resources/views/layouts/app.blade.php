<!DOCTYPE html>
<html lang="ja">
    <head>

        <meta name="google-site-verification" content="GXSqfDj5nXJZVKo-sfLpIUAGLJzvIYLuND58GmYsoiE" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>YouTubeまとめ×コミュニケーション</title>

        <link rel="icon" href="{{ Storage::disk('s3')->url('favicon.jpg') }}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ secure_asset('/css/styles.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('/cropper/dist/cropper.css') }}" type="text/css" media="all"/>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147404358-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-147404358-1');
        </script>


    </head>

    <body>

        @include('commons.navbar')

        <div class="container">
            @include('commons.error_messages')
            @yield('content')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

        <script src="{{ secure_asset('/cropper/dist/cropper.js') }}"></script>

    </body>

        @include('commons.footer')

</html>