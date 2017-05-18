/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

var newNotif;

$(function () {
    var thetitle = $('title').text();
    newNotif = function (reload_no) {
        var countNotif = parseInt($('.counter').text());
        var newcountNotif = ++countNotif;
        if (reload_no) {
            newcountNotif = reload_no;
        }
        $('#msg-icon').removeClass('notif-empty').addClass('notif-new');
        $('.counter').text(newcountNotif).show();
        $('title').text('(' + newcountNotif + ') ' + thetitle);



    };
    $('#notif_test').click(function () {
        newNotif();
    });

    $('#msg-icon').click(function () {
        $('#msg-icon').removeClass('notif-new').addClass('notif-empty');
        $('.counter').text('0').hide();
        $('.notif-bot').hide();
        $('title').text(thetitle);
    });
});