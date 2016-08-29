var transactionModule = (function(commonModule) {

    var datatableBaseURL = commonModule.datatableBaseURL + 'transactions';
    var select2BaseURLItem = commonModule.select2BaseURL + 'items';


    var init = function() {
        _applyDatatable();
        _applyDatepicker();
        _applySelect2Product();
        _submit();
        _disableNumberInputScroll();
        _printTransaction();
    };

    var _disableNumberInputScroll = function() {
        $('form').on('focus', 'input[type=number]', function(e) {
            $(this).on('mousewheel.disableScroll', function(e) {
                e.preventDefault();
            });
        });
        $('form').on('blur', 'input[type=number]', function(e) {
            $(this).off('mousewheel.disableScroll');
        });
    };

    var _saveItem = function() {
        $("#saveItem").on("click", function() {
            console.log($("#supplier_return_detail").serialize());
        });
    };

    var addItem = function() {
        var item_table = $("table#item_table");
        var template_row = $("#new_row").find('tbody');
        var new_row = template_row.clone();
        new_row.find('select').addClass('product_ajax');
        new_row = new_row.html();
        item_table.find('tbody').append(new_row);
        _applySelect2Product();
    };

    var removeItem = function(me) {
        me.closest('tr').remove();
    };

    var _submit = function() {

    };

    var _applyDatepicker = function() {
        $('.datepicker').datepicker({
            weekStart: 1,
            todayHighlight: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    var _applySelect2Product = function() {

        $('select.product_ajax').select2({
            minimumInputLength: 2,
            ajax: {
                url: select2BaseURLItem,
                dataType: "json",
                type: "POST",
                data: function(params) {
                    /* Based on supplier selection TODO*/
                    var item_id = $("#item_id option:selected").val();

                    var queryParameters = {
                        term: params.term,
                        item_id: item_id
                    };
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.model + ' - ' + item.size + ' ' + item.color,
                                id: item.id
                            };
                        })
                    };
                }
            }

        });
    };



    var _applyDatatable = function() {
        /* Tambah Input Field di TFOOT */
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            if (title !== '') {
                $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
            if (title == 'Created at') {
                $(this).html('<input type="text" class="datepicker form-control" placeholder="Search ' + title + '" style="width: 100%;" />');
            }
        });

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": datatableBaseURL,
                "type": "POST"
            },
            language: {
                "decimal": ",",
                "thousands": "."
            },
            columns: [{
                data: 'check',
                name: 'check',
                orderable: false,
                searchable: false
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'address',
                name: 'address'
            }, {
                data: 'source',
                name: 'source'
            }, {
                data: 'total',
                name: 'total'
            }, {
                data: 'created_at',
                name: 'created_at'
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });

        /* Ketika Value pada Input di TFOOT berubah, Maka Search Sesuai Kolom */
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                var keyword = this.value;

                if (this.placeholder == 'Search Code' || this.placeholder == 'Search Supplier') {
                    keyword = keyword.toUpperCase();
                }

                if (this.placeholder == 'Search Status') {
                    keyword = keyword.replace(" ", "_").toLowerCase();
                }

                if (that.search() !== keyword) {
                    that
                        .search(keyword)
                        .draw();
                }
            });
        });

    };

    var _printTransaction = function() {
        $("button#printTransaction").on('click', function() {
            var query = $('form#print input[name="selected_transactions[]"]').serialize();
            window.location = '/transaction/print?' + query;
            // $.ajax({
            //     method: "POST",
            //     url: "/transaction/print",
            //     data: $('form#print').serialize(),
            //     dataType: 'json'
            // }).done(function(response) {
            //     if (response.status == 1) {
            //         swal({
            //             title: "Good!",
            //             text: response.message,
            //             type: "success",
            //             timer: 3000
            //         }, function() {
            //             window.location = "/transaction";
            //         });
            //     } else {
            //         swal({
            //             title: "Oops!",
            //             text: response.message,
            //             type: "error",
            //             timer: 3000
            //         });
            //     }
            // });

        });

    };

    return {
        init: init,
        addItem: addItem,
        removeItem: removeItem
    };

})(commonModule);