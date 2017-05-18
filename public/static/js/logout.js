/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */


$(function () {
    var timeToRedirect = $("#time_to_redirect");
    var secsToRedirectVal = 5;
    setInterval(function () {
        timeToRedirect.html(secsToRedirectVal);
        secsToRedirectVal--;
        if (secsToRedirectVal === 0) {
            window.location.href = "/login/";
        }
    }, 1000);
});