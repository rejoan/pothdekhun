$(document).ready(function () {
    $('.selectpicker').selectpicker();
    $('.fancybox').fancybox();
    $('#stoppage_section').sortable({
        placeholder: 'ui-state-highlight'
    });
    //$('#stoppage_section').disableSelection();
    $('.dataTable').DataTable({
        'paging': false,
        'info': false,
        'searching': false,
        'order': [[0, 'desc']]
    });
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
        var typing = $.trim($(this).val());
        if (!typing.length) {
            return false;
        }

        var pd_stu = $('#pd_stu').val();
        xhr = $.ajax({
            context: this,
            url: pd_stu + '/weapons/get_places',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing,
                d: district,
                t: thana
            }
        }).done(function (response) {
            var cm = '';
            var from = $('input[name="f"]').val();
            for (var i = 0; i < response.length; i++) {
                if (response[i]['Location'] == from) {
                    response.splice(i, 1);
                }
                cm += '<a href="javascript:void(0);" class="list-group-item">' + response[i]['Location'] + '</a>';
            }
            $(this).next().show().html(cm);
        });
    });


    $('#fare_verfication a').click(function (e) {
        e.preventDefault();
        var pd_identity = $('#pd_identity').val();
        var pd_stu = $('#pd_stu').val();
        var pd_sts = $(this).data('pd_fp');
        $.ajax({
            context: this,
            url: pd_stu + 'weapons/update_meta',
            type: 'post',
            dataType: 'json',
            cache: true,
            data: {
                pd_identity: pd_identity,
                pd_sts: pd_sts
            }
        }).done(function (response) {
            if (response.msg == 'exist') {
                swal('Already given', 'You vote once earlier in this route', 'warning');
            }
            if (response.msg == 'updated') {
                swal('Thank you', 'You vote taken', 'success');
                if (pd_sts == 'pd_fpk') {
                    $('#pd_crc').text(response.v);
                } else {
                    $('#pd_wrn').text(response.v);
                }
            }
        });
    });

    var stp = null;
    $('#stoppage_section').on('keyup', '.place_name', function (e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        if (stp !== null) {
            stp.abort();
            stp = null;
        }
        var typing = $.trim($(this).val());
        if (!typing.length) {
            return false;
        }

        var pd_stu = $('#pd_stu').val();
        xhr = $.ajax({
            context: this,
            url: pd_stu + 'weapons/stoppage_search',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing
            }
        }).done(function (response) {
            //var cm = '<div class="list-group suggestion">';
            var cm = '';
            for (var i = 0; i < response.length; i++) {
                cm += '<a href="javascript:void(0);" class="list-group-item">' + response[i]['place_name'] + '</a>';
            }
            $(this).next().show().html(cm);
            //cm += '</div>';
            //$(this).parent().append(cm);
        });
    });

    var sxhr = null;
    $('#search_place').keyup(function (e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        if (sxhr !== null) {
            sxhr.abort();
            sxhr = null;
        }
        var district = $('#district').val();
        var typing = $.trim($(this).val());
        if (!typing.length) {
            return false;
        }

        var pd_stu = $('#pd_stu').val();
        xhr = $.ajax({
            context: this,
            url: pd_stu + '/weapons/search_places',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing,
                d: district
            }
        }).done(function (response) {
            var cm = '';
            for (var i = 0; i < response.length; i++) {
                var thana = ', ' + response[i]['Thana'];
                if (district == 1) {
                    thana = '';
                }
                cm += '<a href="javascript:void(0);" class="list-group-item">' + response[i]['Location'] + thana + '</a>';
            }
            $(this).next().show().html(cm);
        });
    });

    $('#stoppage_section').on('keydown', '.place_name', function (e) {
        var listItems = $(this).next().find('a');
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
    $('.search_place,#vehicle_name,#search_place').on('keydown', function (e) {
        var listItems = $(this).next().find('a');
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

        var pd_stu = $('#pd_stu').val();
        txhr = $.ajax({
            context: this,
            url: pd_stu + '/weapons/get_transports',
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

    $('#vehicle_name').on('blur change', function () {
        var vh = $(this).val();
        var fp = $('input[name="f"]').val();
        var tp = $('input[name="t"]').val();
        check_duplicacy(vh, fp, tp);
    });

    $('#vehicle .list-group').on('click', '.list-group-item', function () {
        var vh = $(this).text();
        var fp = $('input[name="f"]').val();
        var tp = $('input[name="t"]').val();
        check_duplicacy(vh, fp, tp);
    });

    $('.transport_name').on('blur change', function () {
        var pd_stu = $('#pd_stu').val();
        var name = $(this).val();
        $.ajax({
            context: this,
            url: pd_stu + 'weapons/transport_duplicacy',
            type: 'post',
            dataType: 'json',
            cache: true,
            data: {
                name: name
            }
        }).done(function (response) {
            if (response.exist == 'yes') {
                swal('Transpport Exist', 'This transport already exist', 'error');
            }
        });
    });



    $('.evidence').change(function () {
        var file = this.files[0];
        var real_file = file.name;
        var file_type = real_file.split('.').pop().toLowerCase();
        var arr = ['jpg', 'png', 'gif', 'jpeg'];
        if (file === '' || $.inArray(file_type, arr) === -1) {
            swal('Allowed Types', 'jpg, png, gif, jpeg', 'warning');
            $('.file-input-name').remove();
            return false;
        }
    });


    $('select[name="fd"]').change(function () {
        var district = $.trim($(this).val());
        var thana = $(this).data('thana');
        get_thanas(district, thana);
    });
    $('select[name="td"]').change(function () {
        var district = $.trim($(this).val());
        var thana = $(this).data('thana');
        get_thanas(district, thana);
    });
    $('#suggestion_page .list-group').on('click', '.list-group-item', function () {
        var place = $(this).text();
        $(this).parent().prev().val(place);
        $(this).parent().empty();
    });

    $('#stoppage_section .list-group-item').live('click', function () {
        var place = $(this).text();
        $(this).parent().prev().val(place);
        $(this).parent().empty();
    });


    $(document).click(function () {
        $('#suggestion_page .list-group').empty();
    });
//add dynamic stoppgae as many user can

    $('#add_stoppage').click(function () {
        var place_name = $('#place_name').val();
        var comment = $('#comment').val();
        var rents = $('#rents').val();
        $('#stoppage_section').show();

        $('<div class="form-group stoppage"><div class="col-xs-10 col-md-4"><input maxlength="150" type="text" class="form-control place_name" name="place_name[]" placeholder="' + place_name + '" autocomplete="off"><div class="list-group suggestion"></div></div><div class="col-xs-10 col-md-5"><textarea maxlength="1000" class="form-control" name="comments[]" placeholder="' + comment + '"></textarea></div><div class="col-xs-10 col-md-2"><input maxlength="10" type="text" class="form-control rent" name="rent[]" placeholder="' + rents + '"></div><button class="btn btn-xs btn-danger" href="javascript:void(0)" class="cancel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div>').appendTo($('#stoppage_section')).hide().slideDown();
    });


    $('#stoppage_section').on('click', 'button', function (e) {
        e.preventDefault();

        var pd_stu = $('#pd_stu').val();
        var pri = $('#pd_identity').val();
        var jaig = $(this).parent().find('.place_name').val();
        if (confirm('Are you Sure?')) {
            $.ajax({
                context: this,
                url: pd_stu + 'weapons/delete_stopage',
                type: 'get',
                dataType: 'json',
                cache: true,
                data: {
                    pri: pri,
                    jaig: jaig
                }
            }).done(function (response) {
                if (response.deleted == 'done') {
                    if ($('#point').length > 0) {//admin works
                        var point = parseInt($('#point').val());
                        var new_pint = point - 1;
                        $('#point').val(new_pint);
                    }
                }
            });
            $(this).parent().fadeOut('normal', function () {
                $(this).remove();
                $('.order_pos').each(function (i) {
                    var ord = i + 1;
                    $(this).val(ord);
                });
            });
        }
    });

    ftpos = 1;
    $('#add_address').click(function () {
        ftpos++;
        var mycontent = $('div#address:first');

        var content = mycontent.clone(true);
        content.find('.add_district').attr('data-thana', 'ft' + ftpos);
        content.find('.thana').prop('id', 'ft' + ftpos);
        $(content).insertAfter('div#address:last').hide().slideDown();
        $('<button class="btn btn-xs btn-danger remove_address"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>').insertAfter('div#address:last .add_details');
        //content.find('select').selectpicker();
    });

    $('#transport').on('click', '.remove_address', function (e) {
        e.preventDefault();
        if (confirm('Are you Sure?')) {
            $(this).parent().parent().remove();
            return false;
        }

    });

    $('.add_district').on('change', function () {
        var district = $.trim($(this).val());
        var thana = $(this).data('thana');
        get_thana_normal(district, thana);
    });


    //departure_time
    $('#departure_time').change(function () {
        var custom_time = $('#custom_time').val();
        if ($(this).val() == 2) {
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
            $(this).parent().find('.alert').remove();
            $(this).parent().append('<div class="alert alert-danger">Numbers only</div>');
            $(this).val('');
        } else {
            $(this).parent().find('.alert').remove();
        }
    });
});

function get_thanas(district, thana) {
    var pd_stu = $('#pd_stu').val();
    $.ajax({
        context: this,
        url: pd_stu + 'weapons/get_thanas/',
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
        if (district == 1) {//if dhaka show tooltip
            $('#t' + thana).tooltip('enable');
        } else {
            $('#t' + thana).tooltip('disable');
        }
    });
}

function get_thana_normal(district, thana) {
    var pd_stu = $('#pd_stu').val();
    $.ajax({
        context: this,
        url: pd_stu + 'weapons/get_thanas/',
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
    });
}
function check_duplicacy(vh, fp, tp) {
    var pd_stu = $('#pd_stu').val();
    var pd_identity = $('input[name="pd_identity"]').val();
    $.ajax({
        context: this,
        url: pd_stu + '/weapons/check_duplicate',
        type: 'get',
        dataType: 'json',
        cache: true,
        data: {
            vh: vh,
            fp: fp,
            tp: tp,
            pd: pd_identity
        }
    }).done(function (response) {
        if (response.exist > 0) {
            swal('Route Exist Already', 'Please try another', 'warning');
        }

    });
}