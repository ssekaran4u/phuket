$(document).ready(function() {
    var baseurl   = $('.geturl').val();
    var directory = $('.directory').val();
    var cntrl     = $('.cntrl').val();
    var func      = $('.func').val();
    var pre_menu  = $('.pre_menu').val();

    _success = function(text) {
        var o = "rtl" === $("html").attr("data-textdirection");

        toastr.success(text, "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        });
    }

    _error = function(text) {
        var o = "rtl" === $("html").attr("data-textdirection");

        toastr.error(text, "Error!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        });
    }

    _TL = function() {
        $('.table_value').removeClass('show').addClass('hide');
        $('.table_load').removeClass('hide').addClass('show');
    }

    _TR = function() {
        $('.table_load').removeClass('show').addClass('hide');
        $('.table_value').removeClass('hide').addClass('show');
    }

    // Form Submit
    if($('.form_submit').length)
    {
        $('.form_data').on('submit', function(e) {

            e.preventDefault();
            $.ajax({
                type : 'POST',
                url  : baseurl+directory+'/'+cntrl+'/'+func,
                data: new FormData(this),
                contentType: false,
                cache      : false,
                processData: false,
                dataType: 'json',
            }).done(function (response)
            {
                if(response['status'] == 1)
                {
                    _success(response['message']);
                    window.location = baseurl+pre_menu;
                }
                else
                {
                    _error(response['message']);
                }
            });
        });
    }

    if($('.category_page').length)
    {
        $(document).on('change', '#n_parent', function () {
            if ($("#n_parent").is(":checked")) {
                $('#n_category').val(0).change();
            }
        });
        $(document).on('change', '#n_category', function () {
            if($(this).val()>0) {
                $('#n_parent').prop('checked', false);
            }
        });
    }
    // List Data
    loadInDataitems = function(page, search, load_data, limitval, page_type)
    {
        if(page_type == 'list')
        {
            var sort_type, sort_column;
            var sort_type_ = $('.sorting.active').attr("data-sort");
            var sort_column_ = $('.sorting.active').attr("data-item");
            if(sort_type_)
            {
                sort_type = sort_type_;
            }
            else
            {
                 sort_type = '1';
            }

            if(sort_column_)
            {
                sort_column = sort_column_;
            }
            else
            {
                sort_column = '';
            }
            var add_fields = {};
            if($('#n_city').length)
            {
                add_fields['n_city'] = $('#n_city').val();
            }
            if($('#n_district').length)
            {
                add_fields['n_district'] = $('#n_district').val();
            }
            if($('#n_parent').length)
            {
                if ($("#n_parent").is(":checked")) {
                    add_fields['n_parent'] = 1;   
                }
                else {
                     add_fields['n_parent'] = 0;      
                }
            }
            if($('#n_category').length)
            {
                add_fields['n_category'] = $('#n_category').val();   
            }
            _TL();
            $.ajax({
                method: 'POST',
                data: {
                    'page'       : page,
                    'search'     : search,
                    'load_data'  : load_data,
                    'add_fields' : add_fields,
                    'limitval'   : limitval,
                    'sort_column': sort_column,
                    'sort_type'  : sort_type,
                    'method'     : 'data_list',
                },
                url  : baseurl+directory+'/'+cntrl+'/'+func,
                dataType: 'json',
            }).done(function (response) {
                _TR();
                if(response['status'] == 1)
                {
                    $('#error').removeClass('show').addClass('hide');
                    $('#getTableValue').empty('').html(response['result']);
                    $('.page_val').empty('').html(response['page_val']);

                    $('.pagnext').empty().html(response['next']);
                    $('.pagprev').empty().html(response['prev']);

                    $('.total_val').empty('').html(response['records']['total_record']);
                    $('.active_val').empty('').html(response['records']['active_record']);
                    $('.inactive_val').empty('').html(response['records']['inactive_record']);
                }
                else
                {
                    $('.table_value').removeClass('show').addClass('hide');
                    $('#error').removeClass('hide').addClass('show');
                }
            });
        }
    }

    $(document).on('click', '.sorting', function () {
        $('.sorting').removeClass('active');
        $(this).addClass('active');
        $('.sorting .up, .sorting .down').removeClass('show-inline').addClass('hide');
        var _sort_column = $(this).attr('data-item');
        var _finder = $(this).closest('.sorting');
        if($(this).attr('data-sort')==1)
        {
            // 1 up
            _finder.find('.up').removeClass('show-inline').addClass('hide')
            _finder.find('.down').removeClass('hide').addClass('show-inline');
            $(this).attr('data-sort',2);
        }
        else
        {
            // 2 down
            _finder.find('.down').addClass('hide').removeClass('show-inline');
            _finder.find('.up').removeClass('hide').addClass('show-inline');
            $(this).attr('data-sort',1);
        }
        // console.log(
        //     "_sort_column "+_sort_column,
        //     "_sort_type "+$(this).attr('data-sort')
        //     );
        var search    = $('#searchval').val();
        var page_type = $('#page_type').val();
        var load_data = $('#load_data').val();
        var limitval  = $('.getlimitval').val();
        loadInDataitems(1, search, load_data, limitval, page_type);
    });
    
    function getSort() {
        var sort = $('.sorting.active').data("sort");
        var item = $('.sorting.active').data("item");
    }

    $(document).on('click', '.searchdata', function () {
        var search    = $('#searchval').val();
        var page_type = $('#page_type').val();
        var load_data = $('#load_data').val();
        var limitval  = $('.getlimitval').val();
        loadInDataitems(1, search, load_data, limitval, page_type);
    });

    $(document).on('change', '.getlimitval', function () {
        var search    = $('#searchval').val();
        var page_type = $('#page_type').val();
        var load_data = $('#load_data').val();
        var limitval  = $('.getlimitval').val();
        loadInDataitems(1, search, load_data, limitval, page_type);    
    });

    $(document).on('click', '.pages', function () {
        var page      = $(this).data('page');
        var search    = $('#searchval').val();
        var page_type = $('#page_type').val();
        var load_data = $('#load_data').val();
        var limitval  = $('.getlimitval').val();
        loadInDataitems(page, search, load_data, limitval, page_type);    
    });

    var search    = $('#searchval').val();
    var page_type = $('#page_type').val();
    var load_data = $('#load_data').val();
    var limitval  = $('.getlimitval').val();
    loadInDataitems(1, search, load_data, limitval, page_type);    

    function countRows() {
        var i = 0;
        $('#getTableValue tbody td input').each(function () {
            $(this).attr("value", ++i);
        });
    }    

    function countRows() {
        var i = 0;
        $('#getTableValue tr').each(function() {
            $(this).children('td:first').html(++i);
        });
    }



    $( "#getTableValue" ).sortable({
        placeholder : "ui-state-highlight",
        update  : function(event, ui)
        {
            var section_ids = new Array();
            $('#getTableValue tr').each(function(){
                section_ids.push($(this).data("section-id"));
            });
            $.ajax({
                url: baseurl+'/'+directory+'/'+cntrl+'/'+func+'/sorting',
                method:"POST",
                dataType: 'json',
                data:{section_ids:section_ids},
                success:function(response)
                {
                    var _tab = '#o-message';

                    if(response['status'] == 1)
                    {
                        $(_tab).empty();
                        $(_tab).removeClass().addClass('p-1 alert alert-success').html(response['message']);
                        setTimeout(function() {
                            $(_tab).empty().removeClass();
                        }, 5000);


                    }
                    else
                    {
                        $(_tab).removeClass().addClass('p-1 alert alert-danger');
                        $(_tab).html(response['message']);
                        setTimeout(function() {
                            $(_tab).empty().removeClass();
                        }, 5000);
                    }
                }
            });
        },
        stop: function(event, ui) {
            countRows();
        }
    });


});