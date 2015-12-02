$(document).ready(function () {
    site_url = $('#site_url').val();
    base_url = $('#base_url').val();
    $('.selectpicker').selectpicker();
    $('input[type=file]').bootstrapFileInput();

//add dynamic stoppgae as many user can
    $('#add_stoppage').click(function () {
        var cancel = $('#cancel').val();
        var place_name = $('#place_name').val();
        var comment = $('#comment').val();
        var rents = $('#rents').val();
        $('#stoppage_section').show();
        $('<div class="form-group"><div class="col-xs-10 col-md-3"><input maxlength="150" type="text" class="form-control" name="place_name[]" placeholder="' + place_name + '"></div><div class="col-xs-10 col-md-4"><textarea maxlength="1000" class="form-control" name="comments[]" placeholder="' + comment + '"></textarea></div><div class="col-xs-10 col-md-2"><input maxlength="10" type="text" class="form-control" name="rent[]" placeholder="' + rents + '"></div><a class="btn btn-danger" href="javascript:void(0)" class="cancel">' + cancel + '</a></div>').appendTo($('#stoppage_section')).hide().slideDown();

    });

    $('#stoppage_section').on('click', 'a', function () {
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
        var custom_time = $('#custom_time').val();
        if ($(this).val() == 'perticular') {
            $('<div id="departure_dynamic" class="form-group"><label class="col-sm-3 control-label"></label><div class="col-xs-10 col-md-6"><input maxlength="200" type="text" class="form-control"  name="departure_dynamic" placeholder="'+custom_time+'"></div></div>').insertAfter('#departure_perticular').hide().slideDown();
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

    $('#chkUsername').on('blur', function () {
        is_exist('chkUsername', 'username', 'users', 'userInfo');
    });

    $('#chkEmail').on('blur', function () {
        var em = $('#chkEmail').val();
        var email_text = $('#email_text').val();
        var is_visible = $('.wrong_email').is(':visible');
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
//if it's valid email
        if (!filter.test(em)) {
            if (!is_visible) {
                $('<div class="alert alert-warning wrong_email">' + email_text + '</div>').insertAfter('#emailInfo').hide().slideDown();
                return false;
            }
        } else {
            $('.wrong_email').fadeOut('normal', function () {
                $(this).remove();
            });
            is_exist('chkEmail', 'email', 'users', 'emailInfo');
        }

    });


    $('#main_rent').blur(function () {
        var replaced = replaceNumbers($(this).val());
        $(this).val(replaced);
    });

});