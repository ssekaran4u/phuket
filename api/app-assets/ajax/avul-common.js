$(document).ready(function() {
    var baseurl   = $('.geturl').val();
    var directory = $('.directory').val();
    var cntrl     = $('.cntrl').val();
    var func      = $('.func').val();

    var basicPickr = $('.flatpickr-add');
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat : 'd-m-Y',
            minDate    : "today"
        });
    }

    var basicPickr = $('.flatpickr-edit');
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat : 'd-m-Y',
        });
    }
    
    $(document).on('change','.on_state_change',function(){
        var n_state = $('.on_state_change').val();
        $.ajax({
            method: 'POST',
            data: {
                'n_state' : n_state,
                'method'  : '_cityList',
            },
            url  : baseurl+directory+'/'+cntrl+'/'+func,
            dataType: 'json',
        }).done(function (response) {
            if(response['status'] == 1)
            {
                $('.on_city_change').empty('').html(response['data']);
            }
        });
    });

    $(document).on('change','.districtOnChange',function(){
        $('#n_district').empty('').html('<option value="0">Select Option</option>');
        $('#n_town').empty('').html('<option value="0">Select Option</option>');
        var n_city = $(this).val();
        $.ajax({
            method: 'POST',
            data: { 'n_city' : n_city},
            url  : baseurl+'app/master/town/getDistrict',
            dataType: 'json',
        }).done(function (response) {
            if(response['status'] == 1) {
                $('#n_district').empty('').html(response['data']);
            }
        });
    });

    function percentageCalc() {
        var n_coupon_price = $('#n_coupon_price').val();
        var n_discount_percentage = $('#n_discount_percentage').val();
        if(n_coupon_price && n_discount_percentage) {
            var _letc  = parseFloat(n_coupon_price) * parseFloat(n_discount_percentage);
            var letc_ = _letc/100;
            $('#n_payable').val(parseFloat(n_coupon_price) - parseFloat(letc_).toFixed());
        }
    }

    $(document).on('keyup','#n_coupon_price,#n_discount_percentage',function(){
        percentageCalc();
    });

    $(document).on('change','.townOnChange',function(){
        var n_district = $(this).val();
        $.ajax({
            method: 'POST',
            data: { 'n_district' : n_district},
            url  : baseurl+'app/master/town/getTown',
            dataType: 'json',
        }).done(function (response) {
            if(response['status'] == 1)
            {
                $('#n_town').empty('').html(response['data']);
            }
        });
    });
    
    
    if($('.coupon-code').length) {
        $(document).on('change','#n_type',function(e){
            if($("#n_type").prop('checked') == true) {
                $('#spendingAmount').show();
            }
            else {
                $('#spendingAmount').hide();
            }
        })
    }

    if($('.maintain-vendor, .socialDiv').length) {
        $(document).on('change','#n_is_social',function(e){
            if($("#n_is_social").prop('checked') == true)
            {
                $('#isSocial').hide();
            }
            else
            {
                $('#isSocial').show();
            }
        })
    }

    if($('.maintain-vendor').length)
    {
        $(document).on('click','.openTwo',function(e){
            $("#accordionMarginTwo").collapse('toggle');
        });
        $(document).on('click','.openThree',function(e){
            $("#accordionMarginThree").collapse('toggle');
        });
        $(document).on('click','.openFour',function(e){
            $("#accordionMarginFour").collapse('toggle');
        });

        $(document).on('click','.openFive',function(e){
            $("#accordionMarginFive").collapse('toggle');
        });


        $(document).on('change','.n_start_',function(e){
            var n_find = $(this).val();
        })

        $(document).on('change','.c_conflict',function(e){
            var n_value = $(this).val();
            if(n_value)
            {
                var finder = $(this).closest('.clearfix').data("item");
                var n_process = $(this).data("process");
                var _c_timeformat ='<option></option><option value="1">24 Hours</option><option value="2">01:00</option><option value="3">01:30</option><option value="4">02:00</option><option value="5">02:30</option><option value="6">03:00</option><option value="7">03:30</option><option value="8">04:00</option><option value="9">04:30</option><option value="10">05:00</option><option value="11">05:30</option><option value="12">06:00</option><option value="13">06:30</option><option value="14">07:00</option><option value="15">07:30</option><option value="16">08:00</option><option value="17">08:30</option><option value="18">09:00</option><option value="19">09:30</option><option value="20">10:00</option><option value="21">10:30</option><option value="22">11:00</option><option value="23">11:30</option><option value="24">12:00</option><option value="25">12:30</option><option value="26">13:00</option><option value="27">13:30</option><option value="28">14:00</option><option value="29">14:30</option><option value="30">15:00</option><option value="31">15:30</option><option value="32">16:00</option><option value="33">16:30</option><option value="34">17:00</option><option value="35">17:30</option><option value="36">18:00</option><option value="37">18:30</option><option value="38">19:00</option><option value="39">19:30</option><option value="40">20:00</option><option value="41">20:30</option><option value="42">21:00</option><option value="43">21:30</option><option value="44">22:00</option><option value="45">22:30</option><option value="46">23:00</option><option value="47">23:30</option><option value="1">24 Hours</option>';
                if(n_process==1)
                {
                    if(n_value==1)
                    {
                        $('.n_week_day_'+finder+' .init_end').hide();
                        $('.n_week_day_'+finder+' ._end').val(null).change();
                    }
                    else
                    {
                        $('.n_week_day_'+finder+' ._end').html(_c_timeformat);
                        $('.n_week_day_'+finder+' .init_end').show();
                        $('.n_week_day_'+finder+' ._end').val(null).change();
                    }
                }
                else
                {
                    if(n_value==1)
                    {
                        $('.n_week_day_'+finder+' ._start').val(1).change();
                        $('.n_week_day_'+finder+' .init_end').hide();
                        $('.n_week_day_'+finder+' .init_start').show();
                        $('.n_week_day_'+finder+' ._end').val(null).change();
                    }
                }
            }
        })
        
        
        $(document).on('click','.fe_working_hrs',function(e){
            var n_find = $(this).val();
            var n_process = $(this).data("item");
            var _c_timeformat ='<option></option><option value="1">24 Hours</option><option value="2">01:00</option><option value="3">01:30</option><option value="4">02:00</option><option value="5">02:30</option><option value="6">03:00</option><option value="7">03:30</option><option value="8">04:00</option><option value="9">04:30</option><option value="10">05:00</option><option value="11">05:30</option><option value="12">06:00</option><option value="13">06:30</option><option value="14">07:00</option><option value="15">07:30</option><option value="16">08:00</option><option value="17">08:30</option><option value="18">09:00</option><option value="19">09:30</option><option value="20">10:00</option><option value="21">10:30</option><option value="22">11:00</option><option value="23">11:30</option><option value="24">12:00</option><option value="25">12:30</option><option value="26">13:00</option><option value="27">13:30</option><option value="28">14:00</option><option value="29">14:30</option><option value="30">15:00</option><option value="31">15:30</option><option value="32">16:00</option><option value="33">16:30</option><option value="34">17:00</option><option value="35">17:30</option><option value="36">18:00</option><option value="37">18:30</option><option value="38">19:00</option><option value="39">19:30</option><option value="40">20:00</option><option value="41">20:30</option><option value="42">21:00</option><option value="43">21:30</option><option value="44">22:00</option><option value="45">22:30</option><option value="46">23:00</option><option value="47">23:30</option><option value="1">24 Hours</option>';
            if($('.n_week_days_'+n_process+' input').is(':checked'))
            {
                $('.n_week_day_txt_'+n_process).hide();
                $('.n_week_day_'+n_process).show();
                $('.n_week_day_'+n_process+' .init_end').show();
                $('.n_week_day_'+n_process+' .init_start').show();

                $('.n_week_day_'+n_process+' ._start').html(_c_timeformat);
                $('.n_week_day_'+n_process+' ._end').html(_c_timeformat);
                $('.n_week_day_'+n_process+' ._start').val(null).change(); 
                $('.n_week_day_'+n_process+' ._end').val(null).change(); 
            }
            else
            {
                $('.n_week_day_'+n_process+' ._start').val(null).change(); 
                $('.n_week_day_'+n_process+' ._end').val(null).change(); 
                $('.n_week_day_txt_'+n_process).show();
                $('.n_week_day_'+n_process).hide();
            }
        });
    }
    if($('.numbersOnly').length)
    {
        $(document).on('keyup', '.numbersOnly', function () {
            this.value = this.value.replace(/[^0-9]/g,'');
        });
    }

    if($( "input.typeahead" ).length) {
        $( "input.typeahead" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url  : baseurl+directory+'/'+cntrl+'/'+func,
                    type: 'post',
                    dataType: "json",
                    data: {
                        method: 'data_autocomplete',
                        c_search: request.term
                    },
                    success: function( data ) {
                        response( data.result );
                        $('.name_in_thai').val(data.translate);
                    }
                });
            },
            select: function (event, ui) {
                $("input.typeahead" ).val('');
                $('.name_in_thai').val('');
                return false;
            },
            focus: function(event, ui){
                $( "input.typeahead" ).val(ui.item.label);
                return false;
            }
        });
    }

    if($('.additional_field').length)
    {
        $(document).on('click','.additional_field',function(e){
            var _add_mobile = '';
            if($(this).data("access")==1)
            {
                // _add_mobile = "<div class='mb-1 position-relative'><input type='text' class='form-control input_field numbersOnly' placeholder='Mobile Number' name='c_mobile_numbers[]' maxlength='10' /><div class='remove'><i class='icon-trash'></i></div></div>";

                _add_mobile = '<div class="country_lists position-relative"><div class="mb-1 position-relative"><input maxlength="10" type="text" id="c_mobile_numbers" class="form-control input_field numbersOnly" placeholder="Contact Number" name="c_mobile_numbers[]" maxlength10/><div class="country_list top-sb-0"><select class="form-control" name="c_contact_number_pre"><option selected value="2">(+66)</option></select></div></div><div class="remove"><i class="icon-trash"></i></div></div>';
                $('.additional_mobile').append(_add_mobile);
            }
            else
            {
                 _add_mobile = "<div class='mb-1 position-relative'><input type='email' class='form-control input_field' placeholder='Business Email Id' name='c_emailids[]' /><div class='remove'><i class='icon-trash'></i></div></div>";
                $('.additional_email').append(_add_mobile);   
            }
        });
        $(document).on('click','.additional_mobile .remove, .additional_email .remove',function(e){
            $(this).closest('.position-relative').remove();
        });
        
    }
    
    // Delete Data
    $(document).on('click', '.del_btn', function () {
        
        var id    = $(this).data('id');
        var pid   = $(this).data('pid');
        var dir   = $(this).data('directory');
        var cntrl = $(this).data('cntrl');
        var func  = $(this).data('func');
        var t = $("#basic-alert");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't to delete this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-outline-danger ms-1"
            },
            buttonsStyling: !1
        }).then((function (t) {
            if(t.isConfirmed == true)
            {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url  : baseurl+directory+'/'+cntrl+'/'+func,
                    data: {
                        'n_id'   : id,
                        'p_id'   : pid,
                        'method' : 'data_delete',
                    },
                }).done(function( response, status )  {
                    if(response['status'] == 1)
                    {
                        $('.row_'+id).remove();
                        if(response['records']['total_record']==0)
                        {
                            $('.table_value').removeClass('show').addClass('hide');
                            $('#error').removeClass('hide').addClass('show');
                        }

                        $('.total_val').empty('').html(response['records']['total_record']);
                        $('.active_val').empty('').html(response['records']['active_record']);
                        $('.inactive_val').empty('').html(response['records']['inactive_record']);

                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: response['message'],
                            // text: "response['message']",
                            customClass: {
                                confirmButton: "btn btn-success"
                            }
                        })
                    }
                    else
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Cancelled",
                            text: response['message'],
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        })
                    }
                });
            }
            else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your file is safe.",
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger"
                    }
                })
            }
        }));    
    });

    $(document).on('click','.display_mode',function(e){

        var dir_val   = $(this).attr("data-dir");
        var cntrl_val = $(this).attr("data-cntrl");
        var func_val  = $(this).attr("data-func");   
        var view_val  = $(this).attr("data-val");

        var form_data = new FormData(); 
        form_data.append('view_val',view_val);
        form_data.append('method','_setLayoutView');

        $.ajax({
            type : 'POST',
            url  : baseurl+dir_val+'/'+cntrl_val+'/'+func_val,
            data :form_data,
            contentType : false,
            cache : false,
            processData : false,
            dataType : 'json',
        }).done(function (response)
        {   
            if(view_val == 'moon')
            {
                $('.display_mode').attr('data-val','sun');
                $('.sun_view').removeClass('hide').addClass('show');
                $('.moon_view').removeClass('show').addClass('hide');

                // $('.loaded').removeClass('light-layout').addClass('dark-layout');
                // $('.header-navbar').removeClass('navbar-light').addClass('navbar-dark');
                // $('.main-menu').removeClass('menu-dark').addClass('menu-light');
            }
            else
            {
                $('.display_mode').attr('data-val','moon');
                $('.sun_view').removeClass('show').addClass('hide');
                $('.moon_view').removeClass('hide').addClass('show');

                // $('.loaded').removeClass('dark-layout').addClass('light-layout');
                // $('.header-navbar').removeClass('navbar-dark').addClass('navbar-light');
                // $('.main-menu').removeClass('menu-light').addClass('menu-light');
            }
            
            location.reload(); 
        }); 
    });

    $(document).on('change','#file_upload',function(e){
        if (this.files) {

            $('.img_val').removeClass('hide').addClass('show');
            $('.img_msg').removeClass('show').addClass('hide');

            var img_cnt   = this.files.length;
            var array_val = [];
            for (var i = 0; i < img_cnt; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var src = e.target.result;
                    array_val.push({src});

                    var div = document.createElement('div');
                    div.classList.add('col-md-2');
                    div.innerHTML = ['<div class="img_list mt-8" data-closable><img class="thumb gallery_img img_val" src="', e.target.result,
                        '"/><span aria-hidden="true" class="close close_btn hide" data-close>&times;</span></div>'
                    ].join('');
                    document.getElementById('img_list').insertBefore(div, null);
                };
                reader.readAsDataURL(this.files[i]);
            }
        }
    });

    $(document).on('change','.n_page_type',function(e){
        var n_page_type = $('.n_page_type').val();

        if(n_page_type == 2)
        {
            $('.text_page').removeClass('show').addClass('hide');
            $('.google_form').removeClass('hide').addClass('show');
        }
        else
        {
            $('.text_page').removeClass('hide').addClass('show');
            $('.google_form').removeClass('show').addClass('hide');
        }
    });
    $(document).on('change','.accessModule',function(){
        if($(this).data("item")==1)
        {
            $(".vendorChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==2)
        {
            $(".cityChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==3)
        {
            $(".districtChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==4)
        {
            $(".townChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==5)
        {
            $(".couponChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==6)
        {
            $(".roleChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==7)
        {
            $(".userChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==8)
        {
            $(".categoryChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==9)
        {
            $(".bannerChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==10)
        {
            $(".manageChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==11)
        {
            $(".demographicChk").prop('checked', $(this).prop("checked"));
        }
        else if($(this).data("item")==12)
        {
            $(".pagesChk").prop('checked', $(this).prop("checked"));
        }
        
    });

    $("#checkAll").on('change',function() {
        $(".table-responsive-md td input").prop('checked', $(this).prop("checked"));
    });

    $(document).on('change','.n_banner_type',function(){
        var type_val = $('select.n_banner_type option:selected').val();

        if(type_val == 2)
        {
            $(".date-picker").removeAttr("disabled").button('refresh');
            $('.required').removeClass('hide').addClass('contents');
        }
        else
        {
            $(".date-picker").attr("disabled", "disabled").button('refresh');
            $('.required').removeClass('contents').addClass('hide');
        }
    });
});

var accountUserImage = $('.uploadedAvatar'), accountUploadImg = $('#account-upload-img'), accountResetBtn = $('#account-reset');
  if (accountUserImage.length) {
    var resetImage = accountUserImage.attr('src');
    $('#account-upload').on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (accountUploadImg) {
          accountUploadImg.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
    });

    accountResetBtn.on('click', function () {
      accountUserImage.attr('src', resetImage);
    });
  }