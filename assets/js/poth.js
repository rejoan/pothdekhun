$(document).ready(function () {
    site_url = $('#site_url').val();
    base_url = $('#base_url').val();
    $('.selectpicker').selectpicker();
    $('input[type=file]').bootstrapFileInput();

//add dynamic stoppgae as many user can
    $('#add_stoppage').click(function () {
        $('#stoppage_section').show();
        $('<div class="form-group"><div class="col-xs-10 col-md-3"><input maxlength="150" type="text" class="form-control" name="place_name[]" placeholder="জায়গার নাম"></div><div class="col-xs-10 col-md-4"><textarea maxlength="1000" class="form-control" name="comments[]" placeholder="মন্তব্য"></textarea></div><div class="col-xs-10 col-md-2"><input maxlength="10" type="text" class="form-control" name="rent[]" placeholder="ভাড়া"></div><a class="btn btn-danger" href="javascript:void(0)" id="cancel">বাতিল</a></div>').appendTo($('#stoppage_section')).hide().slideDown();

    });

    $('#cancel').live('click', function () {
        $(this).parent().fadeOut('normal', function () {
            $(this).remove();
        });
    });

    //add file as many user can
//    $('#add_file').click(function () {
//        if ($('#file_section').is(':visible')) {
//            $('.file_field:last-child').clone().appendTo($('#file_section')).hide().slideDown();
//            $('.file_field:last-child').find('.file-input-name').remove();
//             $('.file_field:last-child').find('.file-input-wrapper input').val('');
//           
//        } else {
//            $('#file_section').slideDown();
//        }
//
//    });
//
//    $('#cancel_file').live('click', function () {
//        $(this).parent().fadeOut('normal', function () {
//            $(this).remove();
//        });
//    });

    //departure_time
    $('#departure_time').change(function () {
        if ($(this).val() == 'perticular') {
            $('<div id="departure_dynamic" class="form-group"><label class="col-sm-3 control-label"></label><div class="col-xs-10 col-md-6"><input maxlength="200" type="text" class="form-control"  name="departure_dynamic" placeholder="যেমন:  প্রতিদিন সকাল ৭টায়"></div></div>').insertAfter('#departure_perticular').hide().slideDown();
        } else {
            $("#departure_dynamic").slideUp(500, function () {
                $('#departure_dynamic').remove();
            });

        }
    });


    //when user submit for providing route
    $('#provide_poth').submit(function () {

        var from_push = $('#from_push').val();
        var to_push = $('#to_push').val();
        var english = /[^A-Za-z0-9(,| |_)]/;

        if (!english.test(from_push)) {
            var flag1 = 'eng';
        } else {
            flag1 = 'bn';
        }

        if (!english.test(to_push)) {
            var flag2 = 'eng';
        } else {
            flag2 = 'bn';
        }

        if (flag1 != flag2) {
            if ($('.error').length < 1) {
                $('<div class="error alert alert-danger">অনুগ্রহ দুটো ফিল্ডেই একই ভাষা ব্যবহার করুন</div>').insertAfter('#lang_error');
            }
            return false;
        } else {
            $('.error').remove();
            return true;
        }

    });

    $('#submit_route').click(function () {
        //e.preventDefault();
        var is_open = $('#user_reg').is(':visible');
        if (!is_open) {
            $('#user_reg').slideDown();
            return false;
        } else {
            if (onlyEmpty('username', 'userInfo', 'ইউজার নাম') && validateEmail('email', 'emailInfo', 'ইমেইল')) {
                $('#add_route').submit();
                return true;
            } else {

                return false;
            }
        }
    });

    $('#chkUsername').live('blur', function () {
        is_exist('chkUsername','username', 'users', 'userInfo');
    });
    
    $('#chkEmail').live('blur', function () {
        is_exist('chkEmail','email', 'users', 'emailInfo');
    });

});