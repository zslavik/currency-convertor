/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery.loadtemplate');
require('jquery-validation');
require('select2');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(function () {
    var oldCalculation = {};
    var calculation = {};
    $('[name="from"], [name="to"]').select2({
        theme: 'bootstrap'
    });
    $("[data-calculator-form]").validate({
        rules: {
            amount: {
                required: true,
                number: true
            }
        }
    });
    function calculate() {
        var pending;
        if (!pending && $('form').valid()) {
            pending = true;
            $.ajax({
                type: 'GET',
                url: '/api/calculate',
                data: $('form').serialize(),
            }).done(function (res) {
                $('[name="result"]').val(res);
                setHistory();
                pending = false;
            }).fail(function () {
                alert('fail');
                pending = false;
            });
        }
    }

    function setHistory() {
        setLayout();
        calculation = {
            from: $('[name="from"]').val(),
            amount: $('[name="amount"]').val(),
            result: $('[name="result"]').val(),
            to: $('[name="to"]').val(),
        };
        if(JSON.stringify(oldCalculation) !== JSON.stringify(calculation)){
            $('[data-history-body]').loadTemplate(
                $('#template-row'),
                calculation,
                {
                    append: true
                }
            );
            oldCalculation = calculation;
        }

        if ($('[data-history-body] tr').length > 5) {
            $('[data-history-body] tr').first().remove();
        }
    }

    function setLayout() {
        if ($('[data-table-wrap]').children().length == 0) {
            $('[data-table-wrap]').loadTemplate(
                $('#template-table'));
        }
    }

    $('[data-calculate]').on('click', function () {
        calculate();
    });
    $('[data-invert]').on('click', function () {
        var from = $('[name="from"]').val();
        $('[name="from"]').val($('[name="to"]').val()).trigger('change');
        $('[name="to"]').val(from).trigger('change');
    });
});