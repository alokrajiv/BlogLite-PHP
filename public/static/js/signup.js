/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

var signup_init;

jQuery(document).ready(function () {
    "use strict";
    signup_init = function () {
        //passwd-strength -START-
        var options = {};
        options.ui = {
            showPopover: true,
            showErrors: true,
            container: "#pwd-container",
            viewports: {
                progress: ".pwstrength_viewport_progress"
            },
            showVerdictsInsideProgressBar: true
        };
        options.rules = {
            activated: {
                wordTwoCharacterClasses: true,
                wordRepetitions: true
            }
        };
        options.common = {
            onLoad: function () {
                $('#messages').text('Start typing password');
            },
            zxcvbn: true
        };
        $('#passwd-main').pwstrength(options);

        //passwd-strength -END-

        //make other text-area appear when checkbox selected.
        var passwdMain = $('#passwd-main'),
                passwdRpt = $('#passwd-rpt');

        /*
         passwdRpt.bind('input propertychange', function (e) {
         if (passwdMain.val() === passwdRpt.val())
         $("#passwd-rpt-help-block").html("");
         else
         $("#passwd-rpt-help-block").html("Password Repeat doesn't match");
         });
         */
        //make other text-area appear when checkbox selected.
        var divOther = $('#div-other');
        divOther.hide();
        $("#checkbox-other").change(function () {
            if (this.checked) {
                divOther.show();
            } else {
                divOther.hide();
            }
        });


        //FORM VALIDATION

        $.validator.addMethod("cnfrmpswd", function (value, element) {
            console.log(passwdMain.val() === passwdRpt.val());
            return (passwdMain.val() === passwdRpt.val());
        });

        $.validator.addMethod("minlength", function (value, element) {
            return ($(element).val().length > 2);
        }, "Password Repeat doesn't match");

        jQuery.validator.addMethod("checkurl", function (value, element) {
            return /^(www\.)[A-Za-z0-9_-]+\.+[A-Za-z0-9.\/%&=\?_:;-]+$/.test(value);
        }, "Please enter a valid URL.");

        $('form.signup_form').validate({
            highlight: function (element) {
                console.log("highlight");
                var id_attr = $(element).siblings(".glyphicon.form-control-feedback");
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
            },
            unhighlight: function (element) {
                console.log("unhighlight");
                var id_attr = $(element).siblings(".glyphicon.form-control-feedback");
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.length) {
                    error.insertAfter(element);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    };
});