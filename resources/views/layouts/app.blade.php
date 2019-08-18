<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta name="google-site-verification" content="GXSqfDj5nXJZVKo-sfLpIUAGLJzvIYLuND58GmYsoiE" />
        <meta charset="utf-8">
        <title>YouTubeまとめ×コミュニケーション</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <link href="{{ asset('/cropper/dist/cropper.css') }}" rel="stylesheet" type="text/css" media="all"/>
        <!--<link href="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.css" rel="stylesheet" type="text/css" media="all"/>-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->

        <script src="{{ asset('/cropper/dist/cropper.js') }}"></script>
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.js"></script>-->


    </head>

    <body>

        @include('commons.navbar')

        <div class="container">
            @include('commons.error_messages')

            @yield('content')
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

    </body>
</html>