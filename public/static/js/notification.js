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
        var countNotif = 0;
        if ($('#noti_Counter').text()) {
            countNotif = parseInt($('#noti_Counter').text());
        }
        var newcountNotif = ++countNotif;
        if (reload_no) {
            newcountNotif = reload_no;
        }
        $('#noti_Button').removeClass('notif-empty').addClass('notif-new');
        $('#noti_Counter').show();
        $('#noti_Counter')
                .css({opacity: 0})
                .text(newcountNotif)              // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
                .css({top: '-10px'})
                .animate({top: '-2px', opacity: 1}, 500);
        localStorage.setItem("lastCountNotif", newcountNotif);
        $('title').text('(' + newcountNotif + ') ' + thetitle);
    };

    //FIRST TIME INIT
    if (localStorage.getItem("lastCountNotif")) {
        if (parseInt(localStorage.getItem("lastCountNotif")) > 0) {
            newNotif(localStorage.getItem("lastCountNotif"));
        }
    }
    //remote request and call:::now just dummy



    //CLICK EVENTS
    $('#notif_test').click(function () {
        newNotif();
    });
    $('#noti_Button').click(function () {
        console.log("#noti_Button was clicked");
        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear', function () {
            if ($('#notifications').is(':hidden')) {
                $('#noti_Button').css('background-color', '#2E467C');
            }
            else
                $('#noti_Button').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
        });

        $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.
        $('#noti_Counter').text("0");
        localStorage.setItem("lastCountNotif", 0);
        $('title').text(thetitle);
        $('#noti_Button').removeClass('notif-new').addClass('notif-empty');
        return false;
    });

    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function () {
        $('#notifications').hide();

        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter').is(':hidden')) {
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            console.log("here");
        }
    });

    $('#notifications').click(function () {
        return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
    });

// ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.

});