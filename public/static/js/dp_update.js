/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

/* global Dropzone */

//auto add active class to corresponding link in nav header
$(document).ready(function () {
    Dropzone.autoDiscover = false;
    var dpDropZoneModal = $('#dp_drop_zone_modal');
    $("div#dropzone_profile_photo").dropzone({
        url: "/api/file-upload/dp/",
        init: function () {
            this.on("addedfile", function (file) {
                console.log("Added file.");
            });
            this.on("sending", function (file, xhr, formData) {
                formData.append("operation", "profile_picture_update");
            });
            this.on("success", function (file, response) {
                console.log(response);
                if (response.status.update === true) {
                    dpDropZoneModal.modal('hide');
                    window.location.reload(true);
                } else {
                    alert('error');
                }
            });
        },
        acceptedFiles: "image/*",
        maxFiles: 1000,
        dictDefaultMessage: 'DRAG DROP YOUR PHOTO OR CLICK FOR DIALOG BOX',
        dictInvalidFileType: 'NOT VALID IMAGE TYPE'
    });
});
