jQuery(function($) {
    $(document).on('click', '.btn_add_wishlist', function(event) {
        var $this = $(this);
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_add_wishlist",
                data_id: $(this).data('id'),
                data_type: $(this).data('type')
            },
            dataType: "json",
            beforeSend: function() {
            }
        }).done(function(html) {
            $this.html(html.icon).attr("data-original-title", html.title);
        });
    });
    var st_loadding_wishlist = $('.infor-st-setting.st-wishlist-wrap .st-loadding-wishlist');
    $(document).on('click', '.btn_remove_wishlist', function(event) {
        var $this = $(this);
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_remove_wishlist",
                data_id: $(this).data('id'),
                data_type: $(this).data('type')
            },
            dataType: "json",
            beforeSend: function() {
                st_loadding_wishlist.show();
                //$('.post-' + $this.attr('data-id') + ' .user_img_loading').show();
            }
        }).done(function(html) {
            if (html.status == 'true') {
                st_loadding_wishlist.hide();
                $('.post-' + html.msg).html(console_msg(html.type, html.content)).attr("data-original-title", html.title);;
            } else {
                $('.post-' + html.msg).append(console_msg(html.type, html.content)).attr("data-original-title", html.title);;
            }
        });
    });
    $('.btn_load_more_wishlist').on('click', function() {
        var $this = $(this);
        var txt_me = $this.html();
        $.ajax({
            url: st_params.ajax_url,
            type: "GET",
            data: {
                action: "st_load_more_wishlist",
                data_per: $('.btn_load_more_wishlist').attr('data-per'),
                data_next: $('.btn_load_more_wishlist').attr('data-next')
            },
            dataType: "json",
            beforeSend: function() {
                $this.html('Loading...');
            }
        }).done(function(html) {
            $this.html(txt_me);
            $('#data_whislist').append(html.msg);
            if (html.status == 'true') {
                $('.btn_load_more_wishlist').attr('data-per', html.data_per);
            } else {
                $('.btn_load_more_wishlist').attr('disabled', 'disabled');
                $('.btn_load_more_wishlist').html('No More');
            }
        });
    });
    $('#btn_add_media').on('click', function() {
        $('#my_image_upload').trigger('click');
    });
    $('#my_image_upload').on('change', function() {
        $('#submit_my_image_upload').trigger('click');
    });
    $('.btn_remove_post_type').on('click', function() {
        var $this = $(this);
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_remove_post_type",
                data_id: $(this).attr('data-id'),
                data_id_user: $(this).attr('data-id-user')
            },
            dataType: "json",
            beforeSend: function() {
                $('.post-' + $this.attr('data-id') + ' .user_img_loading').show();
            }
        }).done(function(html) {
            if (html.status == 'true') {
                $('.post-' + html.msg).html(console_msg(html.type, html.content));
            } else {
                $('.post-' + html.msg).append(console_msg(html.type, html.content));
            }
        });
    });
    function console_msg(type, content) {
        var txt = '<div class="alert alert-' + type + '"> <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">x</span> </button> <p class="text-small">' + content + '</p> </div>';
        return txt;
    }
    $('#btn_check_insert_post_type_hotel').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_hotel').trigger('click');
        }
    });
    /* Room */
    $('#btn_check_insert_post_type_room').on('click', function() {
        var dk = true;
        if (kt_rong('title', 'Warning : Room Name could not left empty') != true) {
            dk = false;
        }
        if (kt_chieudai('title', 'Warning : Room Name no shorter than 4 characters', 4) != true) {
            dk = false;
        }
        if (dk == true) {
            $('#btn_insert_post_type_room').trigger('click');
        }
    });
    $(document).on('click', '.btn_del_price_custom', function() {
        $(this).parent().parent().remove();
    });
    $('#btn_add_custom_price').on('click', function() {
        var $item = $('.data_price_html').html();
        $('.content_data_price').append($item);
        $('input.date-pick, .input-daterange, .date-pick-inline').datepicker({
            todayHighlight: true,
            weekStart: 1
        });
    });
    $('#btn_add_custom_price_by_number').on('click', function() {
        var $item = $('.data_price_by_number_html').html();
        $('.content_data_price_by_number').append($item);
    });
    $('#btn_add_extra_price').on('click', function(event) {
        var $item = $('.data-extra-price-html').html();
        $('.content_extra_price').append($item);
    });
    $(document).on('click', '.btn_del_extra_price', function() {
        $(this).parents('.item').remove();
    });
    /* Tours */
    $('#btn_check_insert_post_type_tours').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_tours').trigger('click');
        }
    });
    /* flight */
    $('#btn_check_insert_post_type_flight').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_flight').trigger('click');
        }
    });
    /* activity */
    $('#btn_check_insert_activity').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_activity').trigger('click');
        }
    });
    /* Cars */
    $('#btn_check_insert_cars').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_cars').trigger('click');
        }
    });
    /* Rental */
    $('#btn_check_insert_post_type_rental').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_rental').trigger('click');
        }
    });
    /* Cruise */
    $('#btn_check_insert_post_type_cruise').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_cruise').trigger('click');
        }
    });
    /* Cruise Cabin */
    $('#btn_check_insert_cruise_cabin').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_cruise_cabin').trigger('click');
        }
    });
    /* Location */
    $('#btn_check_insert_post_type_location').on('click', function() {
        var dk = true;
        if (dk == true) {
            $('#btn_insert_post_type_location').trigger('click');
        }
    });
    function validate_fileupload(fileName, msg) {
        var allowed_extensions = new Array("jpg", "png", "gif");
        var file_extension = fileName.split('.').pop(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.
        for (var i = 0; i <= allowed_extensions.length; i++) {
            if (allowed_extensions[i] == file_extension) {
                $('.msg').html('');
                return true; // valid file extension
            }
        }
        $('.msg').html('<div class="alert alert-danger msg_image"> <button aria-label="" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">�</span></button> <p>' + msg + '</p> </div>');
        return false;
    }
    function checkLinkUrl(div, thongbao) {
        var str = $('#' + div).val();
        var pattern = new RegExp('^(https?:\/\/)?' + // protocol
            '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|' + // domain name
            '((\d{1,3}\.){3}\d{1,3}))' + // OR ip (v4) address
            '(\:\d+)?(\/[-a-z\d%_.~+]*)*' + // port and path
            '(\?[;&a-z\d%_.~+=-]*)?' + // query string
            '(\#[-a-z\d_]*)?$', 'i'); // fragment locater
        if (!pattern.test(str)) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return false;
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return true;
        }
    }
    function kt_rong(div, thongbao) {
        var value = $('#' + div).val();
        if (value == "" || value == null) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return false;
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return true;
        }
    }
    function kt_chieudai(div, thongbao, chieudai) {
        var value = $('#' + div).val();
        if (value.length == chieudai || value.length < chieudai) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return false;
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return true;
        }
    }
    function kt_so(div, thongbao) {
        var value = $('#' + div).val();
        if (isNaN(value) == true) {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return false;
        } else {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return true;
        }
    }
    function checkEmail(div, thongbao) {
        var value = $('#' + div).val();
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
            $('.console_msg_' + div).html('');
            $('#' + div).css('borderColor', "#C6DBE0");
            return true;
        } else {
            $('.console_msg_' + div).html(console_msg('danger', thongbao));
            $('#' + div).css('borderColor', "red");
            return false;
        }
    }
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.parent().parent().parent().find(".data_lable").val(label);
    });
    $(document).on('change', '.btn-file.multiple :file', function() {
        var $this = $(this);
        var files = $this[0].files;
        var txt = '';
        for (var i = 0; i < files.length; i++) {
            txt += files[i].name + " , ";
        }
        $this.parent().parent().parent().find(".data_lable").val(txt);
    });
    $('.btn_del_avatar').on('click', function() {
        $('#id_avatar_user_setting').val('');
        $('.data_lable').val('');
        //$(this).parent().remove();
    });
    function str2num(val) {
        val = '0' + val;
        val = parseFloat(val);
        return val;
    }
    /* load more histtory withdrawal */
    $('.btn_load_his_withdrawal').on('click', function() {
        var $this = $(this);
        var txt_me = $this.html();
        $.ajax({
            url: st_params.ajax_url,
            type: "GET",
            data: {
                action: "st_load_more_list_withdrawal",
                paged: $this.attr('data-per'),
                show: "json",
            },
            dataType: "json",
            beforeSend: function() {
                $this.html(st_params.text_loading);
            }
        }).done(function(html) {
            $this.html(txt_me);
            if (html.status == 'true') {
                $this.attr('data-per', html.data_per);
                $this.parent().find('#data_history_withdrawal').append(html.html);
                //$('#data_history_book').append(html.html);
            } else {
                $this.attr('disabled', 'disabled');
                $this.html(st_params.text_no_more);
            }
        });
    });
    /* load more histtory book */
    $('.btn_load_his_book').on('click', function() {
        var $this = $(this);
        var txt_me = $this.html();
        $.ajax({
            url: st_params.ajax_url,
            type: "GET",
            data: {
                action: "st_load_more_history_book",
                paged: $this.attr('data-per'),
                show: "json",
                data_type: $this.attr('data-type')
            },
            dataType: "json",
            beforeSend: function() {
                $this.html(st_params.text_loading);
            }
        }).done(function(html) {
            $this.html(txt_me);
            if (html.status == 'true') {
                $this.attr('data-per', html.data_per);
                $this.parent().find('#data_history_book').append(html.html);
                //$('#data_history_book').append(html.html);
            } else {
                $this.attr('disabled', 'disabled');
                $this.html(st_params.text_no_more);
            }
        });
    });
    $('#btn_add_program').on('click', function() {
        var html = $('#html_program').html();
        $('#data_program').append(html);
    });
    $('#btn_add_equipment_item').on('click', function() {
        var html = $('#html_equipment_item').html();
        $('#data_equipment_item').append(html);
    });
    $('#btn_add_features').on('click', function() {
        var html = $('#html_features').html();
        $('#data_features').append(html);
    });
    $('#btn_add_features_rental').on('click', function() {
        var html = $('#html_features_rental').html();
        $('#data_features_rental').append(html);
    });
    $(document).on('click', '.btn_del_program', function() {
        $(this).parent().parent().parent().remove();
    });
    $('li.menu_partner a').on('click', function() {
        var type = $(this).next('.sub_partner').css('display');
        if (type == "none") {
            $(this).next('.sub_partner').slideDown(500);
            $('.icon_partner', this).removeClass("fa-angle-left").addClass("fa-angle-down");
        } else {
            $(this).next('.sub_partner').slideUp(500);
            $('.icon_partner', this).removeClass("fa-angle-down").addClass("fa-angle-left");
        }
    });
    $('.btn_on_off_post_type_partner').on('click', function() {
        var $this = $(this);
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_change_status_post_type",
                data_id: $(this).attr('data-id'),
                data_id_user: $(this).attr('data-id-user'),
                status: $(this).attr('data-status')
            },
            dataType: "json",
            beforeSend: function() {
                $('.post-' + $this.attr('data-id') + ' .user_img_loading').show();
            }
        }).done(function(html) {
            $('.post-' + $this.attr('data-id') + ' .user_img_loading').hide();
            if (html.status == 'true') {
                if ($this.attr('data-status') == 'on') {
                    $this.attr('data-status', 'off');
                    $this.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    $this.attr('data-status', 'on');
                    $this.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            } else {
            }
        });
    });
    // Create room rental
    $('#add-new-facility').on('click', function(event) {
        var html = $('#template').html();
        $('#facility-wrapper').append(html).find('.facility-item').show();
        event.preventDefault();
    });
    $('#facility-wrapper').on('click', '.btn_del_facility', function(event) {
        $(this).closest('.facility-item').remove();
    });
    // edit
    $('.btn_featured_image').on('click', function() {
        var $this = $(this);
        $this.parent().parent().find('#id_featured_image').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove();
    });
    $('.btn_del_logo').on('click', function() {
        var $this = $(this);
        $this.parent().parent().find('#id_logo').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove();
    });
    $('.btn_del_gallery').on('click', function() {
        var $this = $(this);
        $this.parent().parent().find('#id_gallery').val('');
        $this.parent().parent().find('.data_lable').val('');
        $this.parent().remove();
    });
    $('#btn_add_custom_paid_options').on('click', function() {
        var html = $('.paid_options_html').html();
        $('.content_data_paid_options').append(html);
    });
    $('#btn_add_custom_add_new_facility').on('click', function() {
        var html = $('.add_new_facility_html').html();
        $('.content_data_add_new_facility').append(html);
        $('.st_icon').each(function() {
            $(this).iconpicker({
                icons: st_icon_picker.icon_list,
                iconClassPrefix: ' '
            });
        });
    });
    $(document).on('click', '.btn_del_custom_partner', function() {
        $(this).parent().parent().parent().remove();
    });
    $('#btn_discount_by_adult').on('click', function() {
        var html = $('#html_discount_by_adult').html();
        $('#data_discount_by_adult').append(html);
    });
    $('#btn_discount_by_child').on('click', function() {
        var html = $('#html_discount_by_child').html();
        $('#data_discount_by_child').append(html);
    });
    $("#btn_hotel_policy").on('click', function() {
        var html = $("#html_hotel_policy").html();
        $("#data_hotel_policy").append(html);
    });
    $('#btn_add_social').on('click', function() {
        var html = $('#html_add_social').html();
        $('#data_add_social').append(html);
    });
    function fix_user_menu() {
        setTimeout(function() {
            var height_conent = $('.row_content_partner').height();
            var content_width = $('body').width();
            if (height_conent > 0 && content_width > 960) {
                $('.user-left-menu>.st-page-sidebar-new').css("min-height", height_conent);
            }
        }, 1500);
    }
    jQuery(window).on("load", function($) {
        fix_user_menu();
    });
    jQuery(window).on('resize', function($) {
        fix_user_menu();
    });
    $('#st_form_add_partner .number').each(function() {
        var $this = $(this);
        $this.on('change', function() {
            var number = $(this).val();
            number = parseFloat(number);
            if (isNaN(number)) {
                number = 0;
            }
            $(this).val(number);
        });
    });
    $('#st_form_add_partner input.date-pick').each(function() {
        var form = $(this).closest('form');
        $(this, form).datepicker('setStartDate', 'today');
    });
    /*$('.check_all').each(function(){
     var $this = $(this);
     $this.on('click', function(){
     console.log($(this).val())
     });
     });*/
    /*$('.check_all').iCheck({
     checkboxClass: 'i-check',
     radioClass: 'i-radio',
     increaseArea: '20%' // optional
     });*/
    $('.check_all').on('ifClicked', function(event) {
        var $this = $(this);
        if ($this.prop('checked')) {
            $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').iCheck('uncheck');
        } else {
            $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').iCheck('check');
        }
    });
    $('.item_tanoxomy').on('ifClicked', function(event) {
        var $this = $(this);
        var is_check = true;
        $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').each(function() {
            var $this2 = $(this);
            setTimeout(function() {
                if ($this2.prop('checked') == "") {
                    is_check = false;
                }
            }, 100)
        });
        setTimeout(function() {
            if (is_check == true) {
                $this.parent().parent().parent().parent().parent().find('.check_all').iCheck('check');
            } else {
                $this.parent().parent().parent().parent().parent().find('.check_all').iCheck('uncheck');
            }
        }, 200)
    });
    check_show_hiden('is_sale_schedule', 'data_is_sale_schedule');
    check_show_hiden('st_tour_external_booking', 'data_st_tour_external_booking');
    check_show_hiden('st_rental_external_booking', 'data_st_rental_external_booking');
    check_show_hiden('st_activity_external_booking', 'data_st_activity_external_booking');
    check_show_hiden('st_room_external_booking', 'data_st_room_external_booking');
    check_show_hiden('st_car_external_booking', 'data_st_car_external_booking');
    check_show_hiden('best-price-guarantee', 'data_best-price-guarantee');
    function check_show_hiden(div, div_data) {
        //console.log(div);
        //console.log($("."+div).val());
        //console.log($("."+div_data));
        if ($("." + div).val() == 'on') {
            $('.' + div_data).fadeIn(500);
        } else {
            $('.' + div_data).fadeOut(500);
        }
        $('.' + div).on('change', function() {
            if ($(this).val() == 'on') {
                $('.' + div_data).fadeIn(500);
            } else {
                $('.' + div_data).fadeOut(500);
            }
        });
    }
    if ($(".deposit_payment_status").val() != '') {
        $('.data_deposit_payment_status').fadeIn(500);
    } else {
        $('.data_deposit_payment_status').fadeOut(500);
    }
    $('.deposit_payment_status').on('change', function() {
        if ($(this).val() != '') {
            $('.data_deposit_payment_status').fadeIn(500);
        } else {
            $('.data_deposit_payment_status').fadeOut(500);
        }
    });
    if ($(".is_auto_caculate").val() == 'off') {
        $('.data_is_auto_caculate').fadeIn(500);
    } else {
        $('.data_is_auto_caculate').fadeOut(500);
    }
    $('.is_auto_caculate').on('change', function() {
        if ($(this).val() == 'off') {
            $('.data_is_auto_caculate').fadeIn(500);
        } else {
            $('.data_is_auto_caculate').fadeOut(500);
        }
    });
    if ($(".is_custom_price").val() == 'price_by_date') {
        $('.data_price_by_date').fadeIn(500);
        $('.data_price_by_number').fadeOut(0);
    } else {
        $('.data_price_by_date').fadeOut(0);
        $('.data_price_by_number').fadeIn(500);
    }
    $('.is_custom_price').on('change', function() {
        if ($(this).val() == 'price_by_date') {
            $('.data_price_by_date').fadeIn(500);
            $('.data_price_by_number').fadeOut(0);
        } else {
            $('.data_price_by_date').fadeOut(0);
            $('.data_price_by_number').fadeIn(500);
        }
    });
    setTimeout(function() {
        $('.div_btn_submit input[type=submit]').prop('disabled', false);
    }, 5000);
});
jQuery(function($) {
    if ($("#st_form_add_partner").hasClass('success') == true) {
        $("#st_form_add_partner input[type=text]").val('');
        $("#st_form_add_partner input[type=email]").val('');
        $("#st_form_add_partner input[type=number]").val('0');
        $("#st_form_add_partner .st_content").val('');
        $("#st_form_add_partner textarea").html('');
        $("#st_form_add_partner .user-profile-avatar").html('');
        $("#st_form_add_partner .id_featured_image").val('');
        $("#st_form_add_partner .id_logo").val('');
        $("#st_form_add_partner .data_lable").val('');
        $("#st_form_add_partner .content_data_add_new_facility").html('');
        $("#st_form_add_partner .content_data_paid_options").html('');
        $("#st_form_add_partner .content_data_price").html('');
        $("#st_form_add_partner .selectize-input").html('');
        $('#st_form_add_partner select').prop('selectedIndex', 0);
        $("#st_form_add_partner").find('.item_tanoxomy').iCheck('uncheck');
    }
    $('.input-daterange input.st_date_start').each(function() {
        var form = $(this).closest('form');
        var me = $(this);
        $(this).datepicker({
            language: st_params.locale,
            autoclose: true,
            todayHighlight: true,
            startDate: 'today',
            format: $('[data-date-format]').data('date-format'),
            weekStart: 1
        }).on('changeDate', function(e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('.input-daterange input.st_date_end', form).datepicker('setDates', new_date);
            $('.input-daterange input.st_date_end', form).datepicker('setStartDate', new_date);
        });
        $('.input-daterange input.st_date_end', form).datepicker({
            language: st_params.locale,
            startDate: '+1d',
            format: $('[data-date-format]').data('date-format'),
            autoclose: true,
            todayHighlight: true
        });
    })
});
///////////////////////////////////////
/////// Menu new partner///////////////
///////////////////////////////////////
jQuery(function($) {
    $(document).on('click', '.st_menu_new li.item', function() {
        var content = $(this).parent();
        var $this = $(this);
        if ($this.hasClass('active') == false) {
            content.find('li.item').removeClass("active").find('.sub-menu').css('display', 'none');
            $this.find('.sub-menu').fadeIn(500);
            $this.addClass("active");
        }
    });
    $('.input-date-start').each(function() {
        var form = $(this).closest('form');
        var me = $(this);
        $(this).datepicker({
            language: st_params.locale,
            autoclose: true,
            todayHighlight: true,
            //startDate: 'today',
            todayBtn: true,
            format: $(this).data('date-format'),
            weekStart: 1
        }).on('changeDate', function(e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('.input-date-end', form).datepicker('setDates', new_date);
            //$('.input-date-end', form).datepicker('setStartDate', new_date);
        });
        $('.input-date-end', form).datepicker({
            language: st_params.locale,
            //startDate: '+1d',
            format: $(this).data('date-format'),
            autoclose: true,
            todayBtn: true,
            todayHighlight: true,
            weekStart: 1
        });
    });
    $(document).on('click', '.btn_show_custom_date', function() {
        var $this = $(this);
        if ($this.hasClass('open') == true) {
            $(".div-custom-date").fadeOut();
            $this.removeClass('open');
        } else {
            $(".div-custom-date").fadeIn();
            $this.addClass('open');
        }
    });
    $(document).on('click', '.btn_cancel', function() {
        $(".div-custom-date").fadeOut();
        $('.btn_show_custom_date').removeClass('open');
    });
    if ($('.custom_select_date').val() == 'custom_date||') {
        $('.data_custom_date').fadeIn();
    } else {
        $('.data_custom_date').fadeOut();
    }
    $(document).on('change', '.custom_select_date', function() {
        var type = $(this).val();
        if (type == 'custom_date||') {
            $('.data_custom_date').fadeIn();
        } else {
            $('.data_custom_date').fadeOut();
        }
    });
    ////////////////////////////////////////////////////
    ////////////  //////////////////////////////
    ////////////////////////////////////////////////////
    $(document).on('click', '.btn_show_month_by_year', function() {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this = $(this);
        var $post_type = $this.data('post-type');
        var $year = $this.data('year');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_load_month_by_year_partner",
                data_year: $year,
                data_post_type: $post_type
            },
            dataType: "json",
            beforeSend: function() {
                $content.find('.active a.btn_show_month_by_year').html($this.data('loading'));
            }
        }).done(function(html) {
            $('.div_single_month .data_month').html(html.html);
            $('.div_single_month .bc_single').html(html.bc_title);
            $content.find('.active a.btn_show_month_by_year').html($this.data('title'));
            /// RESET
            $('.div_single_year').hide();
            $('.div_single_day').hide();
            $('.div_single_month').fadeIn();
            $('.div_single_custom').hide();
            //INIT CANVAS
            init_canvas_detail_post_type('st_div_item_canvas_month', html.id_rand, $post_type, html.js.lable, html.js.data)
        }).error(function(html) {
            console.log(html);
        });
    });
    $(document).on('click', '.btn_show_day_by_month_year_partner', function() {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this = $(this);
        var $post_type = $this.data('post-type');
        var $year = $this.data('year');
        var $month = $this.data('month');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_load_day_by_month_and_year_partner",
                data_year: $year,
                data_month: $month,
                data_post_type: $post_type
            },
            dataType: "json",
            beforeSend: function() {
                $content.find('.active a.btn_show_day_by_month_year_partner').html($this.data('loading'));
            }
        }).done(function(html) {
            $('.div_single_day .data_day').html(html.html);
            $('.div_single_day .bc_single').html(html.bc_title);
            $content.find('.active a.btn_show_day_by_month_year_partner').html($this.data('title'));
            /// RESET
            $('.div_single_year').hide();
            $('.div_single_month').hide();
            $('.div_single_day').fadeIn();
            //INIT CANVAS
            init_canvas_detail_post_type('st_div_item_canvas_day', html.id_rand, $post_type, html.js.lable, html.js.data);
        }).error(function(html) {
            console.log(html);
        });
    });
    $(document).on('click', '.btn_single_all_time', function() {
        $('.div_single_year').fadeIn();
        $('.div_single_month').hide();
        $('.div_single_day').hide();
    });
    $(document).on('click', '.btn_single_year', function() {
        $('.div_single_year').hide();
        $('.div_single_month').fadeIn();
        $('.div_single_day').hide();
    });
    ////////////////////////////////////////////////////
    //////////// ALL TIME //////////////////////////////
    ////////////////////////////////////////////////////
    $(document).on('click', '.btn_all_time_show_month_by_year', function() {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this = $(this);
        var $year = $this.data('year');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_load_month_all_time_by_year_partner",
                data_year: $year
            },
            dataType: "json",
            beforeSend: function() {
                $content.find('.active a.btn_all_time_show_month_by_year').html($this.data('loading'));
            }
        }).done(function(html) {
            $('.div_all_time_month .data_all_time_month').html(html.html);
            $('.div_all_time_month .bc_all_time').html(html.bc_title);
            $content.find('.active a.btn_all_time_show_month_by_year').html($this.data('title'));
            /// reset
            $('.div_all_time_year').hide();
            $('.div_all_time_day').hide();
            $('.div_all_time_month').fadeIn();
            $('.div_custom_month').hide();
            //INIT CANVAS
            init_canvas_detail_post_type('st_div_item_all_time_canvas_month', html.id_rand, 'st_hotel', html.js.lable, html.js.data)
        }).error(function(html) {
            console.log(html);
        });
    });
    $(document).on('click', '.btn_all_time_show_day_by_month_year_partner', function() {
        var $content = $(this).parent().parent().parent();
        $content.find('tr').removeClass('active');
        $(this).parent().parent().addClass('active');
        var $this = $(this);
        var $year = $this.data('year');
        var $month = $this.data('month');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_load_day_all_time_by_month_and_year_partner",
                data_year: $year,
                data_month: $month
            },
            dataType: "json",
            beforeSend: function() {
                $content.find('.active a.btn_all_time_show_day_by_month_year_partner').html($this.data('loading'));
            }
        }).done(function(html) {
            $('.div_all_time_day .data_all_time_day').html(html.html);
            $('.div_all_time_day .bc_all_time').html(html.bc_title);
            $content.find('.active a.btn_all_time_show_day_by_month_year_partner').html($this.data('title'));
            /// reset
            $('.div_all_time_year').hide();
            $('.div_all_time_month').hide();
            $('.div_all_time_day').fadeIn();
            //INIT CANVAS
            init_canvas_detail_post_type('st_div_item_all_time_canvas_day', html.id_rand, 'st_hotel', html.js.lable, html.js.data);
        }).error(function(html) {
            console.log(html);
        });
    });
    $(document).on('click', '.btn_all_time', function() {
        $('.div_all_time_year').fadeIn();
        $('.div_all_time_month').hide();
        $('.div_all_time_day').hide();
    });
    $(document).on('click', '.btn_all_time_year', function() {
        $('.div_all_time_year').hide();
        $('.div_all_time_month').fadeIn();
        $('.div_all_time_day').hide();
    });
    /////////////////////////////////////////////////
    ///////////// INIT CANVAS ///////////////////////
    /////////////////////////////////////////////////
    function init_canvas_detail_post_type(div_content, id_rand, post_type, lable, data_item) {
        var id_div = 'canvas_detail_post_type_' + id_rand;
        var $content = $("." + div_content);
        $content.html('<canvas id="' + id_div + '" height="150"></canvas>');
        lable = eval(lable);
        data_item = eval(data_item);
        var color = '237,​ 131,​ 35';
        switch (post_type) {
            case "st_hotel":
                color = '87, 142, 190';
                break;
            case "st_rental":
                color = '227, 91, 90';
                break;
            case "st_cars":
                color = '68, 182, 174';
                break;
            case "st_tours":
                color = '135, 117, 167';
                break;
            case "st_activity":
                color = '39, 174, 96';
                break;
        }
        var lineChartData = {
            labels: lable,
            datasets: [{
                label: "My First",
                fillColor: "rgba(" + color + ", 0.8)",
                strokeColor: "rgba(" + color + ", 1)",
                pointColor: "rgba(" + color + ", 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(" + color + ", 1)",
                data: data_item,
            }]
        };
        var ctx = document.getElementById(id_div).getContext("2d");
        new Chart(ctx).Line(lineChartData, {
            responsive: false,
            animationEasing: "easeOutBounce",
        });
    }
    if ($('.st_timepicker').length) {
        var time_picker_arg = {
            timeFormat: "hh:mm tt",
            showMeridian: false
        };
        if (st_params.time_format == '12h') {
            time_picker_arg.showMeridian = true;
        } else {
            time_picker_arg.showMeridian = false;
        }
        $('.st_timepicker').timepicker(time_picker_arg);
    }
    $('.st_icon').each(function() {
        $(this).iconpicker({
            icons: st_icon_picker.icon_list,
            iconClassPrefix: ' '
        });
    });
});
jQuery(function($) {
    if ($(".register_form").data("reset") == true) {
        $(".register_form .data_field :input[type=text]").each(function() {
            $(this).val('');
        });
        $(".data_image_certificates").each(function() {
            $(this).html('');
        });
    }
    $('.register_form .register_as').on('ifChecked', function(event) {
        var value = $(this).val();
        if (value == "partner") {
            $(".content_partner").slideDown(1000);
        }
        if (value == "normal") {
            $(".content_partner").slideUp(1000);
        }
    });
    if ($(".register_form .register_as:checked").val() == "partner") {
        $(".content_partner").show();
    }
    $(".register_form .st_certificates").on('change', function() {
        var post_type = $(this).data('type');
        //upload_certificates(post_type);
    });
    function upload_certificates(post_type) {
        var formData = new FormData($('.register_form')[0]);
        formData.append('action', 'update_certificates');
        formData.append('post_type', post_type);
        $(".div_" + post_type).find(".data_image_certificates").html("<img src=" + st_params.loading_url + " />");
        $(".div_" + post_type).find(".i-check").iCheck('check');
        $.ajax({
            type: "POST",
            url: st_params.ajax_url,
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            xhr: function() { // custom xhr
                var xhr = new window.XMLHttpRequest();
                //Download progress
                xhr.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        // progressElem.html(Math.round(percentComplete * 100) + "%");
                        console.log(Math.round(percentComplete * 100));
                    }
                }, false);
                return xhr;
            },
            success: function(data) {
                if (data.erro_msg == "") {
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").css("border-color", "#ccc");
                    $(".div_" + post_type).find(".data_image_certificates").html(data.html_image);
                    $(".div_" + post_type).find(".st_certificates_" + post_type + "_url").val(data.image_url);
                } else {
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").css("border-color", "red");
                    $(".div_" + post_type).find(".data_lable.st_certificates_" + post_type + "_url").val(data.erro_msg);
                    $(".div_" + post_type).find(".data_image_certificates").html('');
                }
            }
        });
    }
    var register_form = $('.register_form');
    $('.register_form').on('submit', function() {
        if($(this).hasClass("update_info_partner") == false){
            if (!validate_register()) {
                console.log("Error");
                return false;
            }
        }
    });
    function validate_register() {
        var validate = true;
        try {
            if ($("#field-user_name").val() == "") {
                $("#field-user_name").css('border-color', 'red');
                validate = false;
            } else {
                $("#field-user_name").css('border-color', '#ccc');
            };
            if ($("#field-password").val() == "") {
                $("#field-password").css('border-color', 'red');
                validate = false;
            } else {
                $("#field-password").css('border-color', '#ccc');
            };
            if ($("#field-email").val() == "") {
                $("#field-email").css('border-color', 'red');
                validate = false;
            } else {
                $("#field-email").css('border-color', '#ccc');
            };
            if ($(".term_condition:checked").val() != "on") {
                $(".term_condition").parent().css('border-color', 'red');
                validate = false;
            } else {
                $(".term_condition").parent().css('border-color', '#ccc');
            };
        } catch (e) {
            console.log(e);
        }
        return validate;
    }
    if ($('input#address').length) {
        var bt_ot_gmap_input_lat = $('input.bt_ot_gmap_input_lat');
        var bt_ot_gmap_input_lng = $('input.bt_ot_gmap_input_lng');
        var bt_ot_gmap_st_street_number = $('#bt_ot_gmap_st_street_number');
        var bt_ot_gmap_st_locality = $('#bt_ot_gmap_st_locality');
        var bt_ot_gmap_st_route = $('#bt_ot_gmap_st_route');
        var bt_ot_gmap_st_sublocality_level_1 = $('#bt_ot_gmap_st_sublocality_level_1');
        var bt_ot_gmap_st_administrative_area_level_2 = $('#bt_ot_gmap_st_administrative_area_level_2');
        var bt_ot_gmap_st_administrative_area_level_1 = $('#bt_ot_gmap_st_administrative_area_level_1');
        var bt_ot_gmap_st_country = $('#bt_ot_gmap_st_country');
        var input = $('input#address').get(0);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var places = autocomplete.getPlace();
            if (places.length == 0) {
                return;
            }
            bt_ot_gmap_input_lat.val(places.geometry.location.lat());
            bt_ot_gmap_input_lng.val(places.geometry.location.lng());
            bt_ot_gmap_st_street_number.val('');
            bt_ot_gmap_st_locality.val('');
            bt_ot_gmap_st_route.val('');
            bt_ot_gmap_st_sublocality_level_1.val('');
            bt_ot_gmap_st_administrative_area_level_2.val('');
            bt_ot_gmap_st_administrative_area_level_1.val('');
            bt_ot_gmap_st_country.val('');
            $.each(places.address_components, function(index, names) {
                if ($.inArray('street_number', names.types) != -1) {
                    bt_ot_gmap_st_street_number.val(names.long_name);
                }
                if ($.inArray('locality', names.types) != -1) {
                    bt_ot_gmap_st_locality.val(names.long_name);
                }
                if ($.inArray('route', names.types) != -1) {
                    bt_ot_gmap_st_route.val(names.long_name);
                }
                if ($.inArray('sublocality_level_1', names.types) != -1) {
                    bt_ot_gmap_st_sublocality_level_1.val(names.long_name);
                }
                if ($.inArray('administrative_area_level_2', names.types) != -1) {
                    bt_ot_gmap_st_administrative_area_level_2.val(names.long_name);
                }
                if ($.inArray('administrative_area_level_1', names.types) != -1) {
                    bt_ot_gmap_st_administrative_area_level_1.val(names.long_name);
                }
                if ($.inArray('country', names.types) != -1) {
                    bt_ot_gmap_st_country.val(names.long_name);
                }
            });
        });
    }
    $(document).on('click', '.paged_item_service', function() {
        var container = $(this).parent().parent().parent().parent();
        var paged = $(this).data('page');
        var user_id = $(this).data('user-id');
        var post_type = $(this).data('post-type');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "get_list_item_service_available",
                data_page: paged,
                data_user_id: user_id,
                data_post_type: post_type,
                st_ajax: 1
            },
            dataType: "json",
            beforeSend: function() {
                container.find(".ajax_loader").show();
            }
        }).done(function(html) {
            container.find(".data_single_partner").html(html.data);
            container.find(".paging_single_partner").html(html.paging);
            container.find(".ajax_loader").hide();
            $('.st-popup-gallery').each(function() {
                $(this).magnificPopup({
                    delegate: '.st-gp-item',
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        });
    });
    // Location field car
    $('.car_location_pick_up').each(function(index, el) {
        var t = $(this);
        t.select2({
            placeholder: t.data('placeholder'),
            minimumInputLength:2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: ajaxurl,
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term,
                        action:'st_post_select_ajax',
                        post_type: 'location'
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter the remote JSON data
                    return { results: data.items };
                },
                cache: true
            },
            formatResult: function(state){
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            formatSelection: function(state){
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            escapeMarkup: function(m) { return m; }
        });
        t.on("change", function (e) {
            if( typeof e.added != 'undefined' && typeof e.added.name != 'undefined'){
                t.attr('data-name', e.added.name);
            }
            var location = e.val;
            var t2;
            if( location != '' ){
                $('.car_location_drop_off').each(function(index, el) {
                    t2 = $(this);
                    t2.select2({
                        placeholder: t.data('placeholder'),
                        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                            url: ajaxurl,
                            dataType: 'json',
                            quietMillis: 250,
                            data: function (term, page) {
                                return {
                                    action:'st_get_location_childs',
                                    location_id: location
                                };
                            },
                            results: function (data, page) { // parse the results into the format expected by Select2.
                                // since we are using custom formatting functions we do not need to alter the remote JSON data
                                return { results: data.items };
                            },
                            cache: true
                        },
                        formatResult: function(state){
                            if (!state.id) return state.name; // optgroup
                            return state.name+'<p><em>'+state.description+'</em></p>';
                        },
                        formatSelection: function(state){
                            if (!state.id) return state.name; // optgroup
                            return state.name+'<p><em>'+state.description+'</em></p>';
                        },
                        escapeMarkup: function(m) { return m; }
                    });
                    t2.on("change", function (e) {
                        if( typeof e.added != 'undefined' && typeof e.added.name != 'undefined'){
                            t2.attr('data-name', e.added.name);
                        }
                    })
                });
            }
        });
    });
    function add_list_location_selected( lists ){
        var string = "";
        var data = "";
        if( locations.length ){
            $.each(locations, function(index, val) {
                string += "<p class='item-location-from-to' data-index="+index+" style='padding: 5px; margin-top: 5px; border-bottom: 1px solid #CCC; background: #EEE; font-weight: bold;'>"+val.pickup_text+" -> "+val.dropoff_text+" <span class='delete-item-location-from-to'>x</span></p>";
                data += '<input type="hidden" name="locations_from_to[pickup][]" value="'+ val.pickup+'"><input type="hidden" name="locations_from_to[dropoff][]" value="'+ val.dropoff+'">';
            });
        }
        $('#location-car-selected').html( string );
        $('.location-save-data').html(data);
    }
    var locations = st_location_from_to.lists;
    add_list_location_selected( locations );
    $('#add-location-from-to').on('click', function(event) {
        /* Act on the event */
        $('p.location-message').html('');
        var pickup = $('input.car_location_pick_up').val();
        var dropoff = $('input.car_location_drop_off').val();
        if( pickup != '' && dropoff != ''){
            var pickup_text = $('input.car_location_pick_up').attr('data-name');
            var dropoff_text = $('input.car_location_drop_off').attr('data-name');
            locations.push({
                pickup: pickup,
                pickup_text: pickup_text,
                dropoff: dropoff,
                dropoff_text: dropoff_text
            });
            $('.car_location_drop_off').select2('data', null);
        }else{
            $('p.location-message').html('Please select pick up and drop off location!');
        }
        add_list_location_selected( locations );
        return false;
    });
    $('body').on('click','.delete-item-location-from-to',function(event) {
        var parent = $(this).parent('.item-location-from-to')
        var index = parent.data('index');
        locations.splice(index, 1);
        add_list_location_selected( locations );
    });
    if( $('select#location_type').length ){
        var val = $('select#location_type').val();
        fadeLocation( val );
    }
    $('select#location_type').on('change', function(event) {
        var val = $(this).val();
        fadeLocation( val );
    });
    function fadeLocation( val ){
        if( val == 'multi_location' ){
            $('.multi_location_wrapper').fadeIn();
            $('.location_from_to_wrapper').fadeOut();
        }
        if( val == 'check_in_out' ){
            $('.multi_location_wrapper').fadeOut();
            $('.location_from_to_wrapper').fadeIn();
        }
    }
    if( $('.st-select-loction').length ){
        $('.st-select-loction').each(function(index, el) {
            var parent = $(this);
            var input = $('input[name="search"]', parent);
            var list = $('.list-location-wrapper', parent);
            var timeout;
            input.on('keyup', function(event) {
                clearTimeout( timeout );
                var t = $(this);
                timeout = setTimeout(function(){
                    var text = t.val().toLowerCase();
                    if( text == ''){
                        $('.item', list).show();
                    }else{
                        $('.item', list).hide();
                        $(".item",list).each(function(){
                            var name = $(this).data("name").toLowerCase();
                            var reg = new RegExp(text, "g");
                            if (reg.test(name)){
                                $(this).show();
                            }
                        });
                        //$(".item[data-name*='"+text+"']", list).show();
                    }
                }, 00);
            });
        });
    }
    $('#st_partner_payout').on('change', function(){
        var is_pay = $(this).val();
        if(is_pay == "paypal"){
            $('.content_partner_paypal').show();
            $('.content_partner_stripe').hide();
        }
        if(is_pay == "stripe"){
            $('.content_partner_paypal').hide();
            $('.content_partner_stripe').show();
        }
    });
    var is_pay = $('#st_partner_payout').val();
    if(is_pay == "paypal"){
        $('.content_partner_paypal').show();
        $('.content_partner_stripe').hide();
    }
    if(is_pay == "stripe"){
        $('.content_partner_paypal').hide();
        $('.content_partner_stripe').show();
    }
    $(".st_partner_payout_item .item-pay").on('click', function(){
        $('.st_partner_payout_item').find('.item-pay').removeClass('active');
        $(this).parent().find('.st_partner_payout').iCheck('check');
        $(this).addClass('active');
        var is_pay = $(this).parent().find('.st_partner_payout').val();
        $('.item.st_partner_payout_item').hide();
        $(".st_partner_payout_item_"+is_pay).fadeIn(500);
        $(".item.st_partner_payout_item.control").fadeIn(500);
    });
    $(".st_partner_payout_item .item-pay").each(function(){
        var check = $(this).hasClass('active');
        if(check){
            var is_pay = $(this).parent().find('.st_partner_payout').val();
            $(".st_partner_payout_item_"+is_pay).fadeIn(500);
            $(".item.st_partner_payout_item.control").fadeIn(500);
        }
    });
    $(document).on('click', '.btn_del_withdrawal', function(event) {
        var $this = $(this);
        var btn_html = $this.parent().html();
        var content = $this.parent().parent();
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_remove_withdrawal",
                data_user_id: $(this).data('user-id'),
                data_date_create: $(this).data('date-create')
            },
            dataType: "json",
            beforeSend: function() {
                $this.parent().html('<img src="'+st_params.loading_url+'" />');
            }
        }).done(function(html) {
            if (html.status == 'true') {
                content.fadeOut();
            } else {
            }
        });
    });
/*---- Confirm cancel booking ----*/
    $('body').on('click', '.confirm-cancel-booking', function(event) {
        event.preventDefault();
        var el = $(this);
        $('#cancel-booking-modal').on('show.bs.modal', function (event) {
            var t = $(this);
            $('.modal-content-inner', t).empty();
            $('.overlay-form', t).fadeIn();
        });
        $('#cancel-booking-modal').on('shown.bs.modal', function (event) {
            var t = $(this);
            /*--- Load infomation ajax ----*/
            var data = {
                'action': 'st_get_cancel_booking_step_1',
                'order_id': el.data('order_id'),
                'order_encrypt': el.data('order_encrypt')
            };
            $.post(st_params.ajax_url, data , function(respon, textStatus, xhr) {
                /*optional stuff to do after success */
                if( typeof respon == 'object' ){
                    $('.modal-content-inner', t).html( respon.message );
                    t.data('order_id', respon.order_id);
                    t.data('order_encrypt', respon.order_encrypt);
                    $('.modal-footer button.next', t).attr('id', respon.step);
                }
                $('.overlay-form', t).fadeOut();
            }, 'json');
        });
    });
    var flag_next_step = false;
    $('body').on('click', '#next-to-step-2', function(event) {
        event.preventDefault();
        var el = $(this);
        var parent = el.closest('#cancel-booking-modal');
        if( flag_next_step ){
            return false;
        }
        flag_next_step = true;
        $('.overlay-form', parent).fadeIn();
        el.addClass('hidden');
        var data = {
            'action': 'st_get_cancel_booking_step_2',
            'order_id': parent.data('order_id'),
            'order_encrypt': parent.data('order_encrypt'),
            'why_cancel' : $('input[name="why_cancel"]', parent ).val(),
            'detail' : $('textarea', parent).val()
        };
        $.post(st_params.ajax_url, data, function(respon, textStatus, xhr) {
            /*optional stuff to do after success */
            if( typeof respon == 'object' ){
                $('.modal-content-inner', parent).html( respon.message );
                parent.data('order_id', respon.order_id);
                parent.data('order_encrypt', respon.order_encrypt);
                $('.modal-footer button.next', parent).attr('id', respon.step);
            }
            $('.overlay-form', parent).fadeOut();
            flag_next_step = false;
        }, 'json');
    });
    var flag_refresh_page = false;
    $('body').on('click', '#next-to-step-3', function(event) {
        event.preventDefault();
        /* Act on the event */
        var el = $(this);
        var parent = el.closest('#cancel-booking-modal');
        var form = $('form', parent);
        if( flag_next_step ){
            return false;
        }
        flag_next_step = true;
        flag_refresh_page = false;
        $('.overlay-form', parent).fadeIn();
        $validate = check_validate( form );
        if( $validate == false ){
            $('.overlay-form', parent).fadeOut();
            flag_next_step = false;
            return false;
        }
        var data = form.serializeArray();
            data.push({
                name: 'action',
                value: 'st_get_cancel_booking_step_3'
            },{
                name: 'order_id',
                value: parent.data('order_id')
            },{
                name: 'order_encrypt',
                value: parent.data('order_encrypt')
            });
        $.post( st_params.ajax_url, data, function(respon, textStatus, xhr) {
            if( typeof respon == 'object' ){
                $('.modal-content-inner', parent).html( respon.message );
                $('.overlay-form', parent).fadeOut();
                flag_next_step = false;
                flag_refresh_page = true;
                $('button.next', parent).attr('id', respon.step).addClass('hidden');
            }
        }, 'json');
    });
    function check_validate( form ){
        var validate = true;
        $('.required', form).each(function(index, el) {
            var val = $(this).val();
            if( val == '' ){
                validate = false;
                $(this).addClass('error');
            }else{
                $(this).removeClass('error');
            }
        });
        return validate;
    }
    $('#cancel-booking-modal').on('hidden.bs.modal', function (event) {
        var t = $(this);
        t.off('show.bs.modal shown.bs.modal');
        $('.overlay-form', t).fadeOut();
        $('.modal-content-inner', t).empty();
        t.data('order_id', '');
        t.data('order_encrypt', '');
        if( flag_refresh_page ){
            window.location.reload();
        }
    });
    $('body').on('change', '#cancel-booking-modal input[name="why_cancel"]', function(event) {
        event.preventDefault();
        /* Act on the event */
        var t = $(this);
        var parent = t.parents('form');
        var modal = t.closest('#cancel-booking-modal');
        var value = t.val();
        var text = t.data('text');
        if( typeof value != 'undefined' && value != ''){
            $('.modal-footer button.next').removeClass('hidden');
        }else{
            $('.modal-footer button.next').addClass('hidden');
        }
        if( value == 'other' ){
            $('textarea', parent).val('').removeClass('hide');
        }else{
            $('textarea', parent).val( text ).addClass('hide');
        }
    });
    $('body').on('change', '#cancel-booking-modal input[name="select_account"]', function(event) {
        event.preventDefault();
        /* Act on the event */
        var t = $(this);
        var parent = t.parents('form');
        var modal = t.closest('#cancel-booking-modal');
        var value = t.val();
        if( typeof value != 'undefined' && value != ''){
            $('.modal-footer button.next').removeClass('hidden');
        }else{
            $('.modal-footer button.next').addClass('hidden');
        }
        if( typeof value != 'undefined' && value != '' ){
            var html = $('.form-get-account [data-value="'+ value +'"]').html();
            $('.form-get-account-inner', parent).html( html );
        }else{
            $('.form-get-account-inner', parent).html( '' );
        }
    });
    $('body').on('click', '.with_a_refund', function(event) {
        event.preventDefault();
        /* Act on the event */
    });
    $('#with-refund-modal').on('hidden.bs.modal', function (event) {
        var t = $(this);
        t.off('show.bs.modal shown.bs.modal');
        $('.overlay-form', t).fadeOut();
        $('.modal-content-inner', t).empty();
        t.data('order_id', '');
        t.data('order_encrypt', '');
        if( flag_refresh_page_refund ){
            window.location.reload();
        }
    });
    $('body').on('click', '.with_a_refund', function(event) {
        event.preventDefault();
        var el = $(this);
        $('#with-refund-modal').on('show.bs.modal', function (event) {
            var t = $(this);
            $('.modal-content-inner', t).empty();
            $('.overlay-form', t).fadeIn();
        });
        $('#with-refund-modal').on('shown.bs.modal', function (event) {
            var t = $(this);
            /*--- Load infomation ajax ----*/
            var data = {
                'action': 'st_get_refund_infomation',
                'order_id': el.data('order_id'),
                'order_encrypt': el.data('order_encrypt')
            };
            $.post(st_params.ajax_url, data , function(respon, textStatus, xhr) {
                /*optional stuff to do after success */
                if( typeof respon == 'object' ){
                    $('.modal-content-inner', t).html( respon.message );
                    t.data('order_id', respon.order_id);
                    t.data('order_encrypt', respon.order_encrypt);
                    $('.modal-footer button.next', t).attr('id', respon.step).removeClass('hidden');
                }
                $('.overlay-form', t).fadeOut();
            }, 'json');
        });
    });
    var flag_next_step_refund = false;
    var flag_refresh_page_refund = false;
    $('body').on('click', '#st_check_complete_refund', function(event) {
        event.preventDefault();
        /* Act on the event */
        var el = $(this);
        var parent = el.closest('#with-refund-modal');
        if( flag_next_step_refund ){
            return false;
        }
        flag_next_step_refund = true;
        $('.overlay-form', parent).fadeIn();
        el.addClass('hidden');
        var data = {
            'action': 'st_check_complete_refund',
            'order_id': parent.data('order_id'),
            'order_encrypt': parent.data('order_encrypt'),
        };
        $.post(st_params.ajax_url, data, function(respon, textStatus, xhr) {
            /*optional stuff to do after success */
            if( typeof respon == 'object' ){
                $('.modal-content-inner', parent).html( respon.message );
                if( respon.status == 1 ){
                    flag_refresh_page_refund = true;
                }
            }
            $('.overlay-form', parent).fadeOut();
            flag_next_step_refund = false;
        }, 'json');
    });
    $(document).on('click', '.btn_save_and_preview', function(event) {
        $(".save_and_preview").val("true");
        $(".btn_partner_submit_form").trigger('click');
    });
    /*--- 1.3.1 ----*/
    $('.user-alert').each(function(){
        var t = $(this);
        $('.alert-close', t).on('click', function(){
            t.removeClass('open');
            $('.alert-overlay').removeClass('open');
            return false;
        });
    });
    /* Refund*/
    $(document).on('click', '.refund_via_paypal_adaptive', function(event) {
        var $this = $(this);
        var $container = $(this).parent();
        var data = {
            'action': 'st_refund_via_paypal_adaptive',
            'order_id': $(this).data('order-id'),
        };
        $this.addClass("loading");
        $container.find(".message").html('');
        $.post(st_params.ajax_url, data, function(respon, textStatus, xhr) {
            $this.removeClass("loading");
            var $status = 'danger';
            if(respon.status == 'true'){
                $status = 'success'
                $this.attr('disabled','disabled');
            }
            var $message = '<div class="alert alert-'+$status+' mt20">'+respon.message+'</div>';
            $container.find(".message").html($message);
        }, 'json');
    });
});
