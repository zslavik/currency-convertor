<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .vertical-center {
            min-height: 100%; /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh; /* These two lines are counted as one :-)       */

            display: flex;
            align-items: center;
        }

        .vertical-align {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">
                Convertor
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Currency in</th>
            <th>Amount</th>
            <th>Result</th>
            <th>Currency out</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>UAH</td>
            <td>10</td>
            <td>270</td>
            <td>USD</td>
        </tr>
        </tbody>
    </table>
    <div class="form-group">
        <label for="usr">Amount:</label>
        <input type="text" class="form-control" id="usr">
    </div>
    <div class="form-group">

        <label for="sel1">given:</label>
        <select class="form-control" id="sel1">
            @foreach($symbols as $symbol)
                <option>{{$symbol}}</option>
            @endforeach
        </select>
    </div>
    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-retweet"
                                                        aria-hidden="true"></span></button>
    <div class="form-group">
        <label for="sel1">desired:</label>
        <select class="form-control" id="sel1">
            @foreach($symbols as $symbol)
                <option>{{$symbol}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="usr">Amount:</label>
        <input disabled type="text" class="form-control" id="usr">
    </div>
</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
