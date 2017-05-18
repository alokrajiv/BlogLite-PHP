/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
/* global bkLib, nicEditors, globalPower */
var debug = {};
$(function () {
    var postHeadingEditor = $('#new_post_heading'),
            postContentEditor,
            postBoardPlaceholder = {
                heading: 'CLICK TO TYPE POST HEADING',
                content: 'CLICK TO TYPE POST CONTENT'
            };

    rtf_editor_load(function () {
        //editor is loaded   ** callback not working
        console.log("editor loaded");
    });

    //power up new_post button
    post_button();

    //power up the feed reader
    globalPower.remoteFeedReinit();

    function prep_load_init() {
        post_feed_prepare(function (feed_index, resp) {
            if (resp === 'success') {
                post_data_loader(feed_index);
            }
        });
    }

    function post_button() {
        $('#new_post_submit').click(function () {
            var data = {
                heading: postHeadingEditor.val(),
                content: postContentEditor.getContent()
            };
            if (data.heading.length === 0 || data.heading === postBoardPlaceholder.heading) {
                alert("Post is empty");
                return;
            }
            console.log("sending :");
            console.log(data);
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            console.log(percentComplete);
                        }
                    }, false);

                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            console.log(percentComplete);
                        }
                    }, false);

                    return xhr;
                },
                type: 'POST',
                url: "/api/post/",
                data: data,
                success: function (data) {
                    console.log(data);
                    //reload the feed reader
                    globalPower.remoteFeedReinit();
                    postHeadingEditor.val(postBoardPlaceholder.heading);
                    postContentEditor.setContent(postBoardPlaceholder.content);
                }
            });
        });
    }

    function post_data_loader(toLoad) {
        $.ajax({
            type: 'GET',
            url: "/api/post/aggregate/",
            data: {data: toLoad},
            success: function (dataset) {
                console.log(dataset);
                function t_template(post) {
                    var str = '<div class="row">';
                    str += '<span><h4>' + post.heading + '</h4></span>';
                    str += '<span>' + post.content + '</span>';
                    str += '</div>';
                    return str;
                }
                $.each(dataset, function (index, data) {
                    $('#posts_container').append(t_template(data));
                });

            }
        });
    }

    function post_feed_prepare(callback) {
        $('#posts_container').html('');
        $.getJSON("/api/post/feed/prepare/", {}, function (data, text) {
            callback(data, text);
        });
    }

    function rtf_editor_load(callback) {
        bkLib.onDomLoaded(function () {
            var t = new nicEditor({fullPanel: true}).panelInstance('new_post_content');
            postContentEditor = t.instanceById('new_post_content');

            //**event not firing
            function test() {
                console.log("sds");
                postHeadingEditor.val(postBoardPlaceholder.heading);
                postContentEditor.setContent(postBoardPlaceholder.content);
                callback();
            }
            t.addEvent('add', test);
            t.addEvent('panel', test);
            //


            postHeadingEditor.val(postBoardPlaceholder.heading);
            postContentEditor.setContent(postBoardPlaceholder.content);

            debug.x = postContentEditor;
            debug.y = t;
        });
    }
});

