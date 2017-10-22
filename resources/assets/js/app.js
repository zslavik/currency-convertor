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
CalculatorController = {
    fields: {
        from: '[name="from"]',
        to: '[name="to"]',
        amount: '[name="amount"]',
        result: '[name="result"]'
    },
    buttons: {
        invert: '[data-invert]',
        calculate: '[data-calculate]'
    },
    templates: {
        history: {
            body: '[data-template-table]',
            row: '[data-template-row]',
        },
        alert: '[data-alert-template]'
    },
    oldCalculation: {},
    calculation: {},
    calculatorForm: '[data-calculator-form]',
    historyTableBody: '[data-history-body]',
    alertWrap: '[data-alert]',
    calculatorUrl: '/api/calculate',
    historyCount: 5,
    calculatorValidationRules: {
        amount: {
            required: true,
            number: true
        }
    },
    historyTableWrap: '[data-table-wrap]',

    init: function () {
        this.initActions();
        $([this.fields.from, this.fields.to].join()).select2({
            theme: 'bootstrap'
        });
        $(this.calculatorForm).validate({
            rules: this.calculatorValidationRules
        });

    },
    initActions: function () {
        var $this = this;
        $(this.buttons.calculate).on('click', function () {
            $this.calculate();
        });
        $(this.buttons.invert).on('click', function () {
            $this.invertCurrency();
        });
    },
    calculate: function () {
        var $this = this;
        var pending;
        if (!pending && $(this.calculatorForm).valid()) {
            pending = true;
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: this.calculatorUrl,
                data: $(this.calculatorForm).serialize(),
            }).done(function (res) {
                $($this.fields.result).val(res);
                $this.setHistory();
                pending = false;
            }).fail(function (err) {
                $($this.alertWrap).loadTemplate(
                    $($this.templates.alert),
                    {
                        message: err.responseJSON
                    }
                );
                pending = false;
            });
        }
    },
    setHistory: function () {
        this.setLayout();
        this.calculation = {
            from: $(this.fields.from).val(),
            amount: $(this.fields.amount).val(),
            result: $(this.fields.result).val(),
            to: $(this.fields.to).val()
        };
        if (JSON.stringify(this.oldCalculation) !== JSON.stringify(this.calculation)) {
            $(this.historyTableBody).loadTemplate(
                $(this.templates.history.row),
                this.calculation,
                {
                    append: true
                }
            );
            this.oldCalculation = this.calculation;
        }

        if ($(this.historyTableBody + ' tr').length > this.historyCount) {
            $(this.historyTableBody + ' tr').first().remove();
        }
    },
    invertCurrency: function () {
        var from = $(this.fields.from).val();
        $(this.fields.from).val($(this.fields.to).val()).trigger('change');
        $(this.fields.to).val(from).trigger('change');
    },
    setLayout: function () {
        if ($(this.historyTableWrap).children().length == 0) {
            $(this.historyTableWrap).loadTemplate(
                $(this.templates.history.body));
        }
    }
};
