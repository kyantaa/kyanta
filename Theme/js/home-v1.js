jQuery(document).ready(function(t) {
    $('#keyword').keyup(function() {
        var keyword = $("#keyword").val();
        if (keyword.length > 1) {
            $.ajax({
                url: MAIN_URL + '/search/',
                type: 'GET',
                data: {
                    searchinstant: keyword
                },
                success: function(data) {
                    if (data) {
                        $('.search-suggest').show();
                        $('.search-suggest').html(data);
                    } else {
                        $('.search-suggest').hide();
                    }
                }
            })
        } else {
            $('.search-suggest').hide();
        }
    });

    $('div.Top').on('click', 'a.STPb', function(e) {
        e.preventDefault();
        $this = $(this); 
        var $parent = $this.parents("section").attr("id"); // thuộc tính
        var $tag = $this.data("tag");
        $('#' + $parent + ' .Top a').removeClass("Current");
        $this.addClass("Current");
        var href = $this.attr("href"); //
        $("a.viewall").attr("href", href);
        $("#loading").css({
        "display": "block"
        });
        $.ajax({
            type: 'POST',
            url: MAIN_URL + '/ajax/film',
            data: {
                widget: 'list-film',
                type: $tag
            },
            success: function(html) {
                $('#' + $parent + ' ul.MovieList').html(html);
                $("#loading").css({
                    "display": "none"
                });
            },
            error: function() {
                fx.alertMessage("Lỗi", "Đã có lỗi xảy ra trong quá trình gửi dữ liệu!", "error");
            }
        });
    });
    
    $(".AAIco-arrow_upward").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });
    $("#logout").click(function() {
        var d = {
            Member_Logout: 1
        };
        $.post(MAIN_URL + '/ajax'

            , d, function(data) {
            if (data != 1) {
                fx.alertMessage("Lỗi", "Đã có lỗi xảy ra trong quá trình gửi dữ liệu!", "error");
            } else {
                location.reload();
            }
        });
        return false;
    });




    
    function setCookie(name, value, days) {
        var date, expires;
        if (days) {
            date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
    var fixKeyword = function(str) {
        str = str.toLowerCase();
        str = str.replace(/(<([^>]+)>)/gi, "");
        str = str.replace(/[`~!@#$%^&*()_|\=?;:'",.<>\{\}\[\]\\\/]/gi, "");
        return str;
    }
    jQuery('#form-search').submit(function() {
        var keywordObj = jQuery(this).find('input[name=keyword]')[0];
        if (typeof keywordObj != 'undefined' && keywordObj != null) {
            var keyword = jQuery(keywordObj).val();
            keyword = fixKeyword(keyword);
            if (keyword == '') {
                fx.alertMessage("Lỗi", "Bạn chưa nhập từ khóa. (Không tính các ký tự đặc biệt vào độ dài từ khóa)", "error");
                jQuery(keywordObj).focus();
                return false;
            }
            window.location.replace('/tim-kiem/' + keyword + '.html');
        }
        return false;
    });

    jQuery(".tools-box").on("click", function() {
        jQuery.post(MAIN_URL +'/ajax', {
            Movie_Favorite: 1,
            filmid: MovieId
        }, function(dataAndEvents) {
            if (dataAndEvents == 'user') {
                fx.alertMessage("Xin chào!", "Bạn cần đăng nhập để sử dụng chức năng này!", 'error');
            } else {
                if (dataAndEvents == 'err') {
                    RemoveFilm(MovieId, 'fav');
                    $('.tools-box div:first-child').addClass('normal').removeClass('added');
                    fx.alertMessage("Xin chào!", "Bạn đã bỏ theo dõi thành công phim này!", 'error');
                } else {
                    $('.tools-box div:first-child').removeClass('normal').addClass('added');
                    fx.alertMessage("Chúc mừng", "Bạn đã theo dõi thành công phim này!", 'success');
                }
            }
        });
        return false;
    });
});
function RemoveFilm(id, type) {
    jQuery.post(MAIN_URL, {
        Remove_Film: 1,
        id: id,
        type: type
    }, function(dataAndEvents) {});
    return false;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) != -1) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
var _0x49cd = ["%c Dừng Ngay Việc Tò Mò Về Website Người Khác Nhé Bạn..Điều Này Không Tốt Đâu HTAVN.NET ", "color:red; font-size:22px", "log"];
console[_0x49cd[2]](_0x49cd[0], _0x49cd[1]);
$(document).ready(function() {
    $("a#phim18cong").click(function() {
        var a = $("a#phim18cong").attr("href")
          , b = $("input[name='age-view']").val();
        if (!b || b > 100) {
            alert("Nhập chính xác độ tuổi hiện tại của bạn vào ô");
            $("input[name='age-view']").select()
        } else {
            if (isNaN(b) == true) {
                alert("Phim có thể có nội dung nhạy cảm . Nếu muốn xem hãy nhập chính xác độ tuổi hiện tại của bạn vào ô.");
                $("input[name='age-view']").select()
            } else {
                if (b < 18) {
                    alert("Phim có thể có nội dung nhạy cảm . Không khuyến khích bạn trẻ dưới 18 tuổi. Bạn vui lòng trở lại sau. Trang sẽ tự chuyển về trang chủ trong vài giây", "Cảnh báo", "/")
                } else {
                    window.location.href = a
                }
            }
        }
        return false
    });
});




jQuery('body').append('<div id="fb-root"></div>');
_loadFbSDk = function() {
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=262760374306229&autoLogAppEvents=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
}
jQuery(window).load(function() {
    setTimeout("_loadFbSDk()", 100);
});