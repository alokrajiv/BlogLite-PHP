/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

//auto add active class to corresponding link in nav header
$(document).ready(function () {
    $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
});
