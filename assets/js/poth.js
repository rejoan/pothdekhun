$(document).ready(function () {
    $('.selectpicker').selectpicker();
    $('input[type=file]').bootstrapFileInput();
    $('[data-toggle="tooltip"]').tooltip();
    var xhr = null;
    $('.search_place').on('keyup', function (e) {
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
        xhr = $.ajax({
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
    $('#country_edited button').click(function (e) {
        e.preventDefault();
        var country_edited = $('#country_edited span').text();
        $('#country').val(country_edited).trigger('change');
    });
    $('#place_edited button').click(function (e) {
        e.preventDefault();
        var from_place = $('#place_edited span').text();
        $('#from_place').val(from_place);
    });
    $('#to_edited button').click(function (e) {
        e.preventDefault();
        var from_place = $('#to_edited span').text();
        $('#to_place').val(from_place);
    });
    $('#departure_place_edited button').click(function (e) {
        e.preventDefault();
        var departure_place_edited = $('#departure_place_edited span').text();
        $('#departure_place').val(departure_place_edited);
    });
    $('#rent_edited button').click(function (e) {
        e.preventDefault();
        var main_rent = $('#rent_edited span').text();
        $('#main_rent').val(main_rent);
    });
    $('#type_edited button').click(function (e) {
        e.preventDefault();
        var vehicle_type = $('#type_edited span').text();
        $('#vehicle_type').val(vehicle_type).trigger('change');
    });
    $('#name_edited button').click(function (e) {
        e.preventDefault();
        var name_edited = $('#name_edited span').text();
        $('#vehicle_name').val(name_edited);
    });
    $('.stopage_edited').click(function (e) {
        e.preventDefault();
        var indentity = $(this).data('iden');
        var edited_position = $.trim($(this).parent().parent().find('#edited_position').text());
        var edited_comment = $.trim($(this).parent().parent().find('#edited_comment').text());
        var edited_place = $.trim($(this).parent().parent().find('#edited_place').text());
        var edited_rent = $.trim($(this).parent().parent().find('#edited_rent').text());
        if (edited_position.length) {
            $('#position_' + indentity).val(edited_position);
        }
        if (edited_comment.length) {
            $('#comment_' + indentity).val(edited_comment);
        }
        if (edited_place.length) {
            $('#place_' + indentity).val(edited_place);
        }
        if (edited_rent.length) {
            $('#rent_' + indentity).val(edited_comment);
        }

    });
    $('#evidence_edited button').click(function (e) {
        e.preventDefault();
        var evidence_file = $.trim($('#evidence_edited span').text());
        $('#prev_file').val(evidence_file);
        $('#prev_evidence').text(evidence_file);
    });
    $('#time_edited button').click(function (e) {
        e.preventDefault();
        var time_edited = $('#time_edited span').text();
        if (time_edited == 'কিছুক্ষর পরপর') {
            $('#departure_time').val(time_edited).trigger('change');
            $('#departure_dynamic input').remove();
        } else {
            var is_vis = $('#departure_dynamic input').is(':visible');
            if (!is_vis) {
                $('#departure_time').val('perticular').trigger('change');
            }

            $('#departure_dynamic input').val(time_edited);
        }
    });
    $('#add_route').on('blur', '.rent', function () {
        var replaced = replaceNumbers($(this).val());
        $(this).val(replaced);
//        if(!Math.floor(replaced) == replaced && !$.isNumeric(replaced)){
//            alert('problem');
//        }
    });
});