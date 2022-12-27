$(document).ready(function() {
    var baseurl   = $('.geturl').val();
    var directory = $('.directory').val();
    var cntrl     = $('.cntrl').val();
    var func      = $('.func').val();

    var _LS = function() {
        $("#butf2").attr("disabled", "disabled").button('refresh');
        $('.first_btn').removeClass('show').addClass('hide');
        $('.span_btn').removeClass('hide').addClass('show');
    }

    var _LR = function() {
        $("#butf2").removeAttr("disabled").button('refresh');
        $('.span_btn').removeClass('show').addClass('hide');
        $('.first_btn').removeClass('hide').addClass('show');
    }

    var _LR = function() {
        $('.span_btn').removeClass('show').addClass('hide');
        $('.first_btn').removeClass('hide').addClass('show');
    }

    var _AL = function(hide_email='', send_email='') {
        $('.login_card').removeClass('show').addClass('hide');
        $('.auth_card').removeClass('hide').addClass('show');
        $('.hide_email').empty('').html(hide_email);
        $('.send_email').empty('').val(send_email);
    }        

    var _AR = function() {
        $('.auth_card').removeClass('show').addClass('hide');
        $('.login_card').removeClass('hide').addClass('show');
        $('.auth-input').empty('').val('');
    }

    var _success = function(text) {
        var o = "rtl" === $("html").attr("data-textdirection");

        toastr.success(text, "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        });
    }

    var _error = function(text) {
        var o = "rtl" === $("html").attr("data-textdirection");

        toastr.error(text, "Error!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        });
    }

    var _login_alert = function(text) {
        Swal.fire({
            title: "Success",
            text: text,
            icon: "success",
            timer: 2e3,
            timerProgressBar: !0,
        })
    }

    $(document).on('click','.login_btn',function(e){
        // _LS();

        var email    = $('#email').val();
        var password = $('#password').val();

        e.preventDefault();
        var form_data = new FormData(); 

        form_data.append('email',email);
        form_data.append('password',password);
        form_data.append('method','_adminLogin');

        $.ajax({
            type : 'POST',
            url  : baseurl+directory+'/'+cntrl+'/'+func,
            data :form_data,
            contentType : false,
            cache : false,
            processData : false,
            dataType : 'json',
        }).done(function (response)
        {
            // _LR();
            if (response['status'] == 1)
            {
                if(response['data']['n_auth'] == 1)
                {
                    var hide_email = response['data']['hide_email'];
                    var send_email = response['data']['c_emailid'];
                    _AL(hide_email, send_email);
                }
                else
                {
                    var log_url = response['data']['log_url'];
                    _login_alert(response['message']);

                    window.location = log_url;
                }
            }
            else
            {
                _error(response['message']);
            }
        });
    });

    $(document).on('click','.pre_form',function(){
        _AR();
    });

    $(document).on('click','.verify_btn',function(e){

        // _LS();
        var send_email = $('.send_email').val();
        const otp_val  = $("input[name='otp[]']").map(function(){return $(this).val();}).get();
        var otp_res    = otp_val.join('');

        var form_data = new FormData(); 

        form_data.append('email',send_email);
        form_data.append('otp_res',otp_res);
        form_data.append('method','_verifyOTP');

        $.ajax({
            type : 'POST',
            url  : baseurl+directory+'/'+cntrl+'/'+func,
            data :form_data,
            contentType : false,
            cache : false,
            processData : false,
            dataType : 'json',
        }).done(function (response)
        {
            // _LR();
            if (response['status'] == 1)
            {
                var log_url = response['data']['log_url'];
                _login_alert(response['message']);
                
                window.location = log_url;
            }
            else
            {
                _error(response['message']);
            }
        });
    });

    $(document).on('click','.resend_otp',function(e){
        var send_email = $('.send_email').val();
        var form_data = new FormData(); 

        form_data.append('email',send_email);
        form_data.append('method','_resendOTP');

        $.ajax({
            type : 'POST',
            url  : baseurl+directory+'/'+cntrl+'/'+func,
            data :form_data,
            contentType : false,
            cache : false,
            processData : false,
            dataType : 'json',
        }).done(function (response)
        {
            if (response['status'] == 1)
            {
                _success(response['message']);
            }
            else
            {
                _error(response['message']);
            }
        }); 
    });
    
});