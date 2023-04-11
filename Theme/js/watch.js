if (!pautonext) {
    /** @type {boolean} */
    var pautonext = true
}
if (!resizePlayer) {
    /** @type {boolean} */
    var resizePlayer = false
}
if (!light) {
    /** @type {boolean} */
    var light = true
}
if (!miniPlayer) {
    /** @type {boolean} */
    var miniPlayer = false
}
var orgPlayerSize = {
    "width": 0,
    "height": 0
};
/** @type {number} */
var docHeight = 17;
/**
 * @param {number} level
 * @param {?} deepDataAndEvents
 * @return {undefined}
 */

jQuery(document).ready(function(dataAndEvents) {
    jQuery("#btn-autonext").on("click", function() {
        if (pautonext) {
            jQuery("#autonext-status").html("T\u1eaft");
            /** @type {boolean} */
            pautonext = false;
        } else {
            jQuery("#autonext-status").html("B\u1eadt");
            /** @type {boolean} */
            pautonext = true;
        }
        return false;
    });
    /*jQuery("a.btn-episode").on("click", function() {
        var Id = jQuery(this).data('id');
        var Ep = jQuery(this).data('ep');
        ChangePlayer(Id, Ep, this)
        return false;
    });*/
    jQuery("#btn-light").on("click", function() {
        if (light == true) {
            jQuery("body").append('<div id="light-overlay" style="position: fixed; z-index: 999; background-color: rgb(0, 0, 0); opacity: 0.8; top: 0px; left: 0px; width: 100%; height: 100%;"></div>');
            jQuery("#watch-block").css({
                "z-index": "1000",
                "position": "relative"
            });
            jQuery(this).html("B\u1eadt \u0111\u00e8n");
            /*if (resizePlayer == false) {
                jQuery("#btn-expand").click();
            }
			
			*/
            /** @type {boolean} */
            light = false;
        } else {

            jQuery("div#light-overlay").remove();
            jQuery("#watch-block").css({
                "z-index": "1000",
                "position": "relative"
            });
            jQuery(this).html("T\u1eaft \u0111\u00e8n");
            /** @type {boolean} */
            light = true;
        }
        fx.scrollTo("#watch-block", 1E3);
        return false;
    });

    jQuery("#btn-toggle-error").on("click", function() {
        $.post(MAIN_URL + "/ajax/error", {
            filmid: MovieId,
            epid: EpisodeId
        }, function(dataAndEvents) {
            if (dataAndEvents == 'user') {
                fx.alertMessage("Xin chào!", "Bạn cần đăng nhập để sử dụng chức năng này!", 'error');
            } else
                fx.alertMessage("Xin chào!", "Cảm ơn bạn đã báo lỗi. Thank!", "success");
        });
        jQuery(this).remove();
        return false;
    });



    jQuery("#btn-toggle-download").on("click", function() {
        var donwload = jwplayer().getPlaylistItem()["file"];
        if(donwload) window.open(jwplayer().getPlaylistItem()["file"]).blur();
        else 
            fx.alertMessage("Rất tiếc", "Tập phim này chưa hỗ trợ download, bạn hãy dùng Cốc Cốc hoặc IDM để load", 'info');
        return false;
    });
    jQuery("#btn-add-favorite").on("click", function() {
        jQuery.post(MAIN_URL +'/ajax', {
            Movie_Favorite: 1,
            filmid: MovieId
        }, function(dataAndEvents) {
            if (dataAndEvents == 'user') {
                fx.alertMessage("Xin chào!", "Bạn cần đăng nhập để sử dụng chức năng này!", 'error');
            } else {
                if (dataAndEvents == 'err') {
                    $(this).html("X\u00f3a kh\u1ecfi t\u1ee7 phim");
                    fx.alertMessage("Lỗi", "Phim này đã tồn tại trong danh sách!", 'error');
                } else fx.alertMessage("Chúc mừng", "Phim đã được thêm vào danh sách.", 'success');
            }
        });
        return false;
    });

    jQuery("#btn-expand").on("click", function() {
        if (resizePlayer == false) {
            orgPlayerSize.width = jQuery("#media-player-box").width();
            orgPlayerSize.height = jQuery("#media-player-box").height();
            /** @type {number} */
            var newWidth = 1106;
            var size = {
                "width": newWidth,
                "height": Math.ceil(newWidth / 16 * 9 - docHeight)
            };

            jQuery("#media-player-box").animate({
                width: size.width,
                height: size.height
            });
            jQuery(".MovieTabNav.ControlPlayer").css({
                "display": "none"
            });

            jQuery("#watch-block").animate({
                width: newWidth
            }).addClass("expand");

            jQuery("body").append('<div id="light-overlay" style="position: fixed; z-index: 999; background-color: rgb(0, 0, 0); opacity: 0.8; top: 0px; left: 0px; width: 100%; height: 100%;"></div>');
            fx.scrollTo("#watch-block", 1E3);
            jQuery("#expand-status").html("Thu nhỏ");
            /** @type {boolean} */
            resizePlayer = true;
        } else {


        }
        return false;
    });
    jQuery("#btn-re-expand").on("click", function() {
        if (resizePlayer == true) {
            jQuery("#media-player-box").animate({
                "width": "100%",
                "height": "435px"
            });
            jQuery("#watch-block").animate({
                width: "100%"
            }).removeClass("expand");
            jQuery(".MovieTabNav.ControlPlayer").css({
                "display": "block"
            });
            jQuery("#watch-block").removeClass("expand");
            jQuery("div#light-overlay").remove();
            fx.scrollTo("#watch-block", 1E3);
            jQuery("#expand-status").html("Phóng to");
            /** @type {boolean} */
            resizePlayer = false;
        }
        return false;
    });
    jQuery("#reload-list-server").on("click", function() {
        jQuery.ajax({
            'url': PlayerLoad,
            'type': 'POST',
            'dataType': 'JSON',
            'data': 'filmLoadserver=1&filmId=' + filmInfo.filmID
        }).done(function(data) {
            if (typeof data._fxStatus != "undefined" && data._fxStatus) {
                location.reload();
            }
            console.log(data);
        });
    });
    jQuery("#btn-remove-ad").on("click", function() {
        jQuery("div.ad-container").remove();
        jQuery(this).remove();
        fx.scrollTo("#watch-block", 1E3);
        return false;
    });
});