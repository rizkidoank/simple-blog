<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    @yield('header')
    <!-- Scripts -->
    <script>
        window.Laravel =<?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
</head>
<body>
<div id="app">
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dashboard</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="/home" class="list-group-item">Home</a>
                                    <a href="/post/new" class="list-group-item">Buat Post Baru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dashboard</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="/home" class="list-group-item">Home</a>
                                    <a href="/post/new" class="list-group-item">Buat Post Baru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="/js/all.js"></script>
@yield('script')
</body>
</html>