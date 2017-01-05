$(document).ready(function () {
    $('.selectpicker').selectpicker();
    $('input[type=file]').bootstrapFileInput();
    $('[data-toggle="tooltip"]').tooltip();
    var xhr = null;
    $('.search_place').keyup(function (e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        if (xhr !== null) {
            xhr.abort();
            xhr = null;
        }
        var district = $(this).parent().prev().prev().find('select').val();
        var thana = $(this).parent().prev().find('select').val();
        var direction = e.target.name;

        var typing = $.trim($(this).val());

        if (!typing.length) {
            return false;
        }

        var site_url = $('#site_url').val();
        xhr = $.ajax({
            context: this,
            url: site_url + '/weapons/get_places',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing,
                d: district,
                t: thana,
                dir: direction
            }
        }).done(function (response) {
            var cm = '';
            for (var i = 0; i < response.length; i++) {
                cm += '<a href="javascript:void(0);" class="list-group-item">' + response[i]['Location'] + '</a>';
            }
            $(this).next().show().html(cm);
        });
    });

    $('.search_place,#vehicle_name').keydown(function (e) {
        var sugesstion_id = $(this).next().prop('id');
        //alert(sugesstion_id);
        var listItems = $('#' + sugesstion_id + ' a');
        var key = e.keyCode,
                selected = listItems.filter('.selected'),
                current;
        if (key != 40 && key != 38 && key != 13)
            return;

        //listItems.removeClass('selected');

        if (key == 40) // Down key
        {
            listItems.removeClass('selected');
            if (!selected.length || selected.is(':last-child')) {
                current = listItems.eq(0);
            } else {
                current = selected.next();
            }
        } else if (key == 38) // Up key
        {
            listItems.removeClass('selected');
            if (!selected.length || selected.is(':first-child')) {
                current = listItems.last();
            } else {
                current = selected.prev();
            }
        } else if (key == 13) // Enter key
        {
            current = listItems.filter('.selected');
            current.trigger('click');
            return false;
        }
        current.addClass('selected');
    });

    var txhr = null;
    $('#vehicle_name').keyup(function (e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        if (txhr !== null) {
            txhr.abort();
            txhr = null;
        }

        var typing = $.trim($(this).val());

        if (!typing.length) {
            return false;
        }

        var site_url = $('#site_url').val();
        txhr = $.ajax({
            context: this,
            url: site_url + '/weapons/get_transports',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing
            }
        }).done(function (response) {
            var cm = '';
            for (var i = 0; i < response.length; i++) {
                cm += '<a href="javascript:void(0);" class="list-group-item">' + response[i]['poribohon'] + '</a>';
            }
            $(this).next().show().html(cm);
        });
    });


    $('input[name="evidence"]').change(function () {
        var file = this.files[0];
        var real_file = file.name;
        var file_type = real_file.split('.').pop().toLowerCase();
        var arr = ['jpg', 'png', 'gif', 'jpeg', 'pdf', 'doc', 'docx'];
        if (file === '' || $.inArray(file_type, arr) === -1) {
            swal('Allowed Types', 'jpg, png, gif, jpeg, pdf, doc, docx', 'warning');
            $('.file-input-name').remove();
            return false;
        }
    });

    $('.districts').change(function () {
        var district = $.trim($(this).val());
        var site_url = $('#site_url').val();
        var thana = $(this).data('thana');
        $.ajax({
            url: site_url + '/weapons/get_thanas',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                district: district
            }
        }).done(function (response) {
            var th = '';
            for (var i = 0; i < response.length; i++) {
                th += '<option value="' + response[i]['id'] + '">' + response[i]['thana'] + '</option>';
            }
            $('#' + thana).html(th);
            $('#' + thana).selectpicker('refresh');
        });
    });



    $('.list-group').on('click', '.list-group-item', function () {
        var place = $(this).text();
        $(this).parent().prev().val(place);
        $(this).parent().empty();
    });

    $(document).click(function () {
        $('.list-group').empty();
    });

//add dynamic stoppgae as many user can

    $('#add_stoppage').click(function () {
        var pos_ord = parseInt($('.order_pos').last().val());
        var place_name = $('#place_name').val();
        var comment = $('#comment').val();
        var rents = $('#rents').val();
        $('#stoppage_section').show();
        if (!pos_ord) {
            pos_ord = 0;
        }
        pos_ord++;
        $('<div class="form-group"><div class="col-xs-10 col-md-2"><input maxlength="2" type="text" class="form-control order_pos" name="position[]" value="' + pos_ord + '"></div><div class="col-xs-10 col-md-3"><input maxlength="150" type="text" class="form-control" name="place_name[]" placeholder="' + place_name + '"></div><div class="col-xs-10 col-md-4"><textarea maxlength="1000" class="form-control" name="comments[]" placeholder="' + comment + '"></textarea></div><div class="col-xs-10 col-md-2"><input maxlength="10" type="text" class="form-control rent" name="rent[]" placeholder="' + rents + '"></div><button class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>').appendTo($('#stoppage_section')).hide().slideDown();
    });
    $('#stoppage_section').on('click', 'button', function (e) {
        e.preventDefault();
        $(this).parent().fadeOut('normal', function () {
            $(this).remove();
            $('.order_pos').each(function (i) {
                var ord = i + 1;
                $(this).val(ord);
            });
        });
    });
    //departure_time
    $('#departure_time').change(function () {
        var custom_time = $('#custom_time').val();
        if ($(this).val() === 'perticular') {
            $('<div id="departure_dynamic" class="form-group"><label class="col-sm-3 control-label"></label><div class="col-xs-10 col-md-6"><input maxlength="200" type="text" class="form-control"  name="departure_dynamic" placeholder="' + custom_time + '"></div></div>').insertAfter('#departure_perticular').hide().slideDown();
        } else {
            $("#departure_dynamic").slideUp(500, function () {
                $('#departure_dynamic').remove();
            });
        }
        if ($(this).data('merge') == 'yes') {
            $('#departure_dynamic label').removeClass('col-sm-3');
            $('#departure_dynamic label + div').removeClass('col-xs-10 col-md-6');

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

    $('form').on('blur', '.rent', function () {
        var replaced = replaceNumbers($(this).val());
        $(this).val(replaced);
        var num = parseInt(replaced);
        if (isNaN(num) || num < 1) {
            swal('', 'Number only & should be greater than ZERO', 'warning');
            $(this).val('');
        }
    });
});