jQuery(document).ready(function(t) {
    LoadPlayer(MovieId,EpisodeId);
    $('.csv').on('click', function() {
        var server = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: MAIN_URL + '/ajax/episode',
            data: {
                id: MovieID,
                episodeid: EpisodeID,
                name: Name,
                server: server
            },
            success: function(response) {
                $.ajax({
                    type: 'POST',
                    url: MAIN_URL + '/ajax/server',
                    data: {
                        id: MovieID,
                        ep: EpisodeID,
                        server: server
                    },
                    success: function(response) {
						$(".choose-server").html(response);
					}
                });
                $("#list_episodes").html(response);
            }
        });
        return false
    });
});

function setCookieFilm(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};

function RemoveFilm(filmid, type) {
    if (IsLogin != true) fx.alertMessage("Lỗi", "Bạn cần đăng nhập để sử dụng chức năng này", "error");
    else {
        $.post(MAIN_URL, {
            Remove_Film: 1,
            filmid: filmid,
            type: type
        }, function(data) {
            if (data) {}
        });
    }
    return false;
};

function LoadPlayer(filmid, epid, bk) {
    $.ajax({
        type: 'POST',
        url: MAIN_URL + '/ajax/player',
        data: {
            id: filmid,
            ep: epid,
			bk: bk
        },
        success: function(response) {
			fx.scrollTo("#watch-block", 1E3);
            $("#media-player").html(response);
        }
    });
};

function LoadEpisode(epid, page, server) {
    $.ajax({
        type: 'GET',
        url: MAIN_URL + '/ajax/episode/',
        data: {
            id: MovieID,
            episodeid: epid,
            pageId: page,
            name: Name,
            serverId: server
        },
        success: function(response) {
            response = $.parseJSON(response);
            $("#list-episode").html(response['list']);
            $("#page-list").html(response['page']);
        }
    });
};

function ChangePlayer(filmid, epid, obj) {
	setCookieFilm("nowepisode",epid);
    jwplayer("media-player").stop();
    $("#media-player").remove();
    $("#media-player-box").append('<div id="media-player" style="width: 100%;height: 100%;"><img src="http://i.imgur.com/TfCj0e7.gif" width="100%" height="100%"></div>');
    var Url = $(obj).attr("href");
    $(".list-episode li a").removeClass("active");
    var $this = $(".list-episode li a#ep-" + epid + "");
    $this.addClass("active");
    fx.scrollTo("#watch-block", 1E3);
    // Đổi Url
    window.history.pushState(null, null, Url);
    $.ajax({
        type: 'POST',
        url: MAIN_URL + '/ajax/checkNameEp',
        data: {
            ep: epid
        },
        success: function(response) {
            document.title = response;
        }
    });
    $.ajax({
        type: 'POST',
        url: MAIN_URL + '/ajax/player',
        data: {
            id: filmid,
            ep: epid
        },
        success: function(response) {
            $("#media-player").html(response);
        }
    });
};

setTimeout(function() {
    updateMovieView(MovieId)
}, 1000);

function updateMovieView(e) {
    $.ajax({
        url: MAIN_URL + "/ajax/movie_update_view",
        type: "POST",
        dataType: "json",
        data: {
            id: e
        },
        success: function() {}
    })
};