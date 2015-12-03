var numbers = {
    '০': 0,
    '১': 1,
    '২': 2,
    '৩': 3,
    '৪': 4,
    '৫': 5,
    '৬': 6,
    '৭': 7,
    '৮': 8,
    '৯': 9
};

function replaceNumbers(input) {
    var output = [];
    for (var i = 0; i < input.length; ++i) {
        if (numbers.hasOwnProperty(input[i])) {
            output.push(numbers[input[i]]);
        } else {
            output.push(input[i]);
        }
    }
    return output.join('');
}

/**
 * check DB for a value is exist
 * @param {string} inputId name of input field
 * @param {string} col name of table column
 * @param {string} table name of the DB table
 * @param {string} infoId where to show error
 * @returns {boolean}
 */
function is_exist(inputId, col, table, infoId) {
    var field = $('#' + inputId).val();
    var site_url = $('#site_url').val();
    var base_url = $('#base_url').val();
    var is_vis = $('#' + infoId + ' + .exist').is(':visible');
    var email_exist = $('#email_exist').val();

    if (field !== '') {
        $.ajax({
            url: site_url + 'weapons/check_existence',
            type: 'post',
            dataType: 'text',
            data: {
                field: field,
                col: col,
                table: table

            },
            beforeSend: function () {
                $('#' + infoId).append('<img class="loader" src="' + base_url + 'assets/images/loading.gif"  alt="loading"/>');
            },
            success: function (response) {
                //console.log(response);return;
                if (response === 'exist') {
                    if (!is_vis) {
                        $('<div class="alert alert-danger exist"><strong>' + field + '</strong> ' + email_exist + '</div>').insertAfter('#' + infoId).hide().slideDown();
                    }
                    $('#' + infoId + ' > div >  span').remove();
                    $('#' + infoId).removeClass('has-success has-feedback');
                } else {
                    $('#' + infoId).addClass('has-success has-feedback');
                    if ($('#' + infoId + ' > div >  span').length < 1) {
                        $('#' + infoId + ' > div').append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
                    }

                    $('.exist').fadeOut('normal', function () {
                        $(this).remove();
                    });
                }
            },
            complete: function () {
                $('.loader').remove();
            }
        });
    }
    return false;
}


function selectOption(fieldId, Id, formatedName) {
    var field = $('#' + fieldId).val();

    if (field == '0' || field == '') {
        $('#' + Id)
                .text('Please select a option in ' + formatedName).fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    } else {
        $('input[name=' + fieldId + ']')
                .removeClass('error');
        $('#' + Id)
                .fadeOut();
        $('#' + Id)
                .removeClass('error');
        return true;
    }
}

function onlyEmpty(fieldName, Id, formatedName) {
    var field = $('input[name="' + fieldName + '"]').val();

    if (field == '') {
        $('<div class="alert alert-danger">অনুগ্রহ করে ' + formatedName + ' পূরন করুন</div>')
                .insertAfter('#' + Id).hide().slideDown();

        return false;

    } else {
        $('#' + Id).next('.alert').fadeOut();

        return true;
    }

}


// form validation library by rejoan

/**
 * function to validate selected file in form for jpg,gif and png
 * @param {mixed} inputFileId
 * @param {mixed} Id
 * @returns {Boolean}
 */
function fileUpload(inputFileId, Id, hidden_fieldId) {
    var check = $('#' + hidden_fieldId).val();
    if (check != '') {
        return true;
    }
    var file = $('#' + inputFileId).val();
    var file_type = file.split('.').pop().toLowerCase();
    var arr = ['jpg', 'png', 'gif', 'jpeg'];
    if (file == '' || $.inArray(file_type, arr) == -1) {
        $('#' + Id).text('Please select a file and only jpg, gif or png').fadeIn();
        $('#' + Id).addClass('error');
        return false;
    } else {
        $('#' + Id).fadeOut();
        return true;
    }
}//end of  fileUpload

/**
 * function for match password
 * @param {mixed} p1
 * @param {mixed} p2
 * @param {mixed} Id
 * @returns {Boolean}
 */
function matchPassword(p1, p2, Id) {
    var pass1 = $('#' + p1).val();
    var pass2 = $('#' + p2).val();
    if (pass1 != pass2 || pass1 == '') {
        $('#' + Id).text('Please fill password field and match').fadeIn();
        $('#' + Id).addClass('error');
        return false;
    } else if (pass1 == pass2) {
        $('#' + Id).fadeOut();
        return true;
    }
}//end of  matchPassword

/**
 * function to validate any type of text field
 * @param {mixed} fieldName
 * @param {mixed} Id
 * @returns {Boolean}
 */
function validateTextField(fieldName, Id, formatedName) {
//if it's NOT valid
    formatedName = formatedName || '';
    if ($('input[name=' + fieldName + ']')
            .val()
            .length < 1) {
        $('#' + Id)
                .text('Please fill this ' + formatedName + ' field').fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    } else if (isNaN($('input[name=' + fieldName + ']')
            .val()) == false) {
        $('#' + Id)
                .text('Please enter any  text').fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    }
//if it's valid
    else {
        $('input[name=' + fieldName + ']')
                .removeClass('error');
        $('#' + Id)
                .fadeOut();
        return true;
    }
}//end of validateTextField


/**
 * function to validate email
 * @param {mixed} fieldName
 * @param {mixed} Id
 * @returns {Boolean}
 */
function validateEmail(fieldName, Id, formatedName) {
//testing regular expression
    var a = $('input[name=' + fieldName + ']')
            .val();
    var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
//if it's valid email
    if (filter.test(a)) {
        $('#' + Id)
                .next('.alert').fadeOut();
        return true;
    }
//if it's NOT valid
    else {
        $('<div class="alert alert-danger">অনুগ্রহপূর্বক একটি সঠিক  ' + formatedName + ' দিন</div>')
                .insertAfter('#' + Id).hide().slideDown();
        return false;
    }
}// end of validateEmail


function checkCaptcha(hiddenFieldId, captchaFieldId, Id) {
    var hfId = $('#' + hiddenFieldId).val();
    var cfId = $('#' + captchaFieldId).val();
    if (hfId != cfId) {
        $('#' + Id)
                .text('Captcha doesn\'t match').fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    } else {

        $('#' + Id)
                .fadeOut();
        $('#' + Id)
                .removeClass('error');
        return true;
    }
}

/**
 * function to validate input field for number
 * @param {mixed} fieldName
 * @param {mixed} Id
 * @returns {Boolean}
 */
function validateNumber(fieldName, Id) {
//if it's NOT valid
    if (isNaN($('input[name=' + fieldName + ']')
            .val())) {
        $('#' + Id)
                .text('Only number please,no text allowed');
        $('#' + Id)
                .addClass('error');
        return false;
    } else if ($('input[name=' + fieldName + ']')
            .val() < 1) {
        $('#' + Id)
                .text('Please fill the field').fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    }
//if it's valid
    else {
        $('input[name=' + fieldName + ']')
                .removeClass('error');
        $('#' + Id)
                .fadeOut();
        $('#' + Id)
                .removeClass('error');
        return true;
    }
}// end of validateNumber

/**
 * 
 * @param {string} rname
 * @param {string} Id
 * @returns {Bool}
 */
function selectRadio(rname, Id, formatedName) {
    if ($('input:radio[name=' + rname + ']').is(':checked')) {
        $('#' + Id)
                .fadeOut();
        $('#' + Id)
                .removeClass('error');
        return true;
    } else {
        $('#' + Id)
                .text('Please select the ' + formatedName + ' field').fadeIn();
        $('#' + Id)
                .addClass('error');
        return false;
    }
}
