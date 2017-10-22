<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- Styles -->
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
    <div class="row">
        <div class="col-xs-12">
            <div data-table-wrap></div>
            <form data-calculator-form>
                <div class="form-group">
                    <label for="usr">Amount:</label>
                    <input type="text" class="form-control" name="amount">
                </div>
                <div class="row">
                    <div class="col-xs-5">
                        <div class="form-group">
                            <label>From:</label>
                            <select class="form-control" name="from">
                                @foreach($symbols as $symbol)
                                    <option>{{$symbol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <label>Switch</label>
                        <button type="button" data-invert class="form-control btn btn-default"><span
                                    class="glyphicon glyphicon-retweet"
                                    aria-hidden="true"></span></button>
                    </div>
                    <div class="col-xs-5">
                        <div class="form-group">
                            <label>To:</label>
                            <select class="form-control" name="to">
                                @foreach($symbols as $symbol)
                                    <option>{{$symbol}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usr">Result:</label>
                    <input disabled type="text" class="form-control" name="result">
                </div>
                <button type="button" data-calculate class="btn btn-default">
                    Calculate
                </button>
            </form>
        </div>
    </div>
</div>

<script src="{{ mix('/js/app.js') }}"></script>
<div id="target"></div>

<script id="template-row" type="text/html">
    <tr>
        <td><span data-content="from"></span></td>
        <td><span data-content="amount"></span></td>
        <td><span data-content="result"></span></td>
        <td><span data-content="to"></span></td>
    </tr>
</script>
<script id="template-table" type="text/html">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Currency in</th>
            <th>Amount</th>
            <th>Result</th>
            <th>Currency out</th>
        </tr>
        </thead>
        <tbody data-history-body></tbody>
    </table>
</script>
</body>
</html>
