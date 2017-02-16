$(document).ready(function () {
    var xhr = null;
    $('#search_user').keyup(function (e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        if (xhr !== null) {
            xhr.abort();
            xhr = null;
        }
        var typing = $.trim($(this).val());
        if (!typing.length) {
            return false;
        }

        var pd_stu = $('#pd_stu').val();
        var pd_btu = $('#pd_btu').val();
        xhr = $.ajax({
            context: this,
            url: pd_stu + 'common/get_users',
            type: 'get',
            dataType: 'json',
            cache: true,
            data: {
                typing: typing
            },
            beforeSend: function () {
                $(this).parent().append('<img id="loader" src="' + pd_btu + 'assets/images/loading.gif" alt="Loading"/>');
            },
            complete: function () {
                $('#loader').remove();
            }
        }).done(function (response) {
            $('#loader').remove();
            var cm = '';
            for (var i = 0; i < response.length; i++) {
                cm += '<a href="javascript:void(0);" class="list-group-item" data-user_id="'+response[i]['id']+'">' + response[i]['username'] + '</a>';
            }

            $(this).next().show().html(cm);
        });
    });

    $('#suggestion_page').on('keydown', '.search_box', function (e) {
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

    $('#suggestion_page .list-group-item').live('click', function () {
        var username = $(this).text();
        var user_id = $(this).data('user_id');
        $('#user_id').val(user_id);
        $(this).parent().prev().val(username);
        $(this).parent().empty();
    });


    $(document).click(function () {
        $('#suggestion_page .list-group').empty();
    });

});