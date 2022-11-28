
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <title>{{ config("app.name") }}</title>
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    @stack("styles")
    <style>
        .card, .card-body{
            background-color:transparent !important;
        }

        .page-wrapper{
            background-color: transparent;
        }

        .btn{
            color:#fff;
        }

        body, td, th{
            color:black !important;
        }
    </style>
</head>
