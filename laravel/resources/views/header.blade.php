<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title><?='biblioglobus.com '.$h1;?></title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/authorization.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        h1{text-align: center;}
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <img src="{{asset('pic/logo.png')}}" height="80px">
            </div>
            <div class="col-lg-4 ">
                Городское библиотечное объединение "Библиоглобус"
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('index')}}">Главная <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('biblioteka')}}">Библиотеки</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('book')}}">Книги</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('author')}}">Авторы</a>
                            </li>
                            <?php
                            if(isset($_SESSION['userid'])):
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="exit">Выход</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>