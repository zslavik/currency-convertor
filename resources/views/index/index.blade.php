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
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">
                Convertor
            </a>
        </div>
    </div>
</nav>
<div class="wrap full-height flex-center">
    <div class="calculator ">
        <div class="container">
            <div data-alert></div>
            <div class="row">
                <div class="col-xs-12">
                    <div data-table-wrap></div>
                    <form data-calculator-form>
                        <div class="row">
                            <div class="col-xs-12 col-lg-2">
                                <div class="form-group">
                                    <select class="form-control" name="from">
                                        @foreach($symbols as $symbol)
                                            <option>{{$symbol}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Amount" name="amount">
                                </div>
                            </div>

                            <div class="col-xs-12 col-lg-1 text-center">
                                <div class="form-group">
                                    <button type="button" data-invert class="btn btn-default"><span
                                                class="glyphicon glyphicon-retweet"
                                                aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-2">
                                <div class="form-group">
                                    <select class="form-control" name="to">
                                        @foreach($symbols as $symbol)
                                            <option>{{$symbol}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <input disabled type="text" placeholder="Result" class="form-control" name="result">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-1 text-center">
                                <button type="button" data-calculate class="btn btn-default">
                                    Calculate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ mix('/js/app.js') }}"></script>
<script>
    CalculatorController.init();
</script>
<script data-template-row type="text/html">
    <tr>
        <td><span data-content="from"></span></td>
        <td><span data-content="amount"></span></td>
        <td><span data-content="result"></span></td>
        <td><span data-content="to"></span></td>
    </tr>
</script>
<script data-alert-template type="text/html">
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span data-content="message"></span>
    </div>
</script>
<script data-template-table type="text/html">
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
