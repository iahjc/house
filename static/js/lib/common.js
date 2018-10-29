(function () {

    (function(){var lst=function(){var v=window.localStorage;if(!v){return 0;}var i=1;try{v.setItem("k","v");v.removeItem("k");}catch(e){i=2;}return i;};$.getScript("static/js/lib/fp.js",function(){var l=lst();var i=null;var v=window.localStorage;if(l==1){i=v.getItem("u5imj");};var o={};o.ls=l;o.uid=i;o.fp=new Fingerprint({canvas: true}).get();o.title=$("title").text();o.url=location.href;o.ua=navigator.userAgent;o.referer=document.referrer;var d=JSON.stringify(o);$.ajax({type: 'POST',url: "/admin/browseinfo/iteminfo",data:d,dataType:"json",contentType:"application/json",success:function(r){if(r.code==200){if(l==1){v.setItem("u5imj",r.data);}}}});});})();

    $.getJSON('/admin/quicksubmit/priceCount',function(r){
       if(r.code==200){
           $('.seved-num>b').text(r.data);
       }
    });

    //底部关闭事件
    $(".float-bar .close-bar").click(function () {
        $(".float-bar").toggleClass("hide");
        $(".close").toggleClass("closeback");
    });

    $('[action=yuyue]').click(function(){
        var mob=$('[name=phone]').val();
        if(!mobok(mob)){
            show_err('无效的手机号！');
            return;
        }
        $.getJSON('/admin/quicksubmit/newData?mobile='+mob+'&type=2&from=1&cid=CH0000&subcid=000001',function(r){
            if(r.code=200){
                showSuccessMsg();
            }else{
                show_err('提交失败，请稍后再试！');
            }
        });
    });

    function scroll(fn) {
        var de = (function () {
            return (document.compatMode && document.compatMode.toLowerCase() == "css1compat") ? document.documentElement : document.body;
        })();
        var beforeScrollTop = de.scrollTop,
            fn = fn || function () {
                };

        $(window).scroll(function () {
            var afterScrollTop = de.scrollTop,
                delta = afterScrollTop - beforeScrollTop;
            if (delta === 0) return false;
            fn(delta > 0 ? "down" : "up");
            beforeScrollTop = afterScrollTop;
        });
    }

    scroll(function (direction) {
        if (direction == "down")
            $(".nav_box").addClass("up");
        else $(".nav_box").removeClass("up");
    });

    function showSuccessMsg() {
        var msg = '<div class="tjcg" id="tanchu">\
            <div class="tjcg_box"> \
            <div class="success"> <img src="/static/images/erweima.jpg" ></div> \
            <div class="succ">预约成功</div>  \
            <a href="#" onclick="$(\'#tanchu\').fadeOut(300,function(){$(this).remove();});;return false;"><img src="/static/images/cuoe.png"></a> \
            <span>客服将在30分钟内联系您</span>\
        </div> \
        </div>';
        $(msg).appendTo($("body"));
    }
})();


////整体异常处理
(function () {
    window.onerror = function (errorMessage, scriptURI, lineNumber, columnNumber, errorObj) {
        var html = [];
        html.push("错误信息：" + errorMessage);
        html.push("当前页面：" + location.href);
        html.push("出错文件：" + scriptURI);
        html.push("出错行号：" + lineNumber);
        html.push("出错列号：" + columnNumber);
        html.push("错误详情：" + errorObj);
        html.join("<br />\n");
        //$.post("/clientError", {msg: html.join("<br />\n")});
    };
})();

/**
 * 商桥处理
 */
/*
(function () {
    $("body").delegate("#nb_icon_wrap", "click", function () {
        $("#newBridge .nb-nodeboard-base .nb-nodeboard-contain-base .nb-nodeboard-top").css("display", "block");
    });
    $("body").delegate("#nb_nodeboard_close", "click", function () {
        $("#newBridge .nb-nodeboard-base .nb-nodeboard-contain-base .nb-nodeboard-top").css("display", "none");
    });
    $("body").delegate("#newBridge .nb-nodeboard-base .nb-nodeboard-contain-base .sucess-close", "click", function () {
        $("#newBridge .nb-nodeboard-base .nb-nodeboard-contain-base .nb-nodeboard-top").css("display", "none");
    });


})();
*/
/**
 * cookie
 */
(function () {
    $.cookie = function (name, value, options) {
        if (typeof value != 'undefined') { // name and value given, set cookie
            options = options || {};
            if (value === null) {
                value = '';
                options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires == 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
            }
            // NOTE Needed to parenthesize options.path and options.domain
            // in the following expressions, otherwise they evaluate to undefined
            // in the packed version for some reason...
            var path = options.path ? '; path=' + (options.path) : '';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else { // only name given, get cookie
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = $.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    };
})();
/**
 * url处理类
 */
(function () {
    var query, hash, hashChangeCallback;
    $.url = {
        getQuery: function (key) {
            if (!query)query = this._getCurQuery();
            if (!key)return query;
            return query[key];
        },
        getHash: function (key) {
            if (!hash)hash = this._getCurHash();
            if (!key)return hash;
            return hash[key];
        },
        getCurHash: function () {
            return this._getCurHash(true);
        },
        getCurQuery: function () {
            return this._getCurQuery(true);
        },
        setHash: function (k, v) {
            if (v) {
                var _hash = this._getCurHash();
                _hash[k] = v;
                k = this.objToQuery(_hash);
            }
            location.hash = k;
            hashChangeCallback && hashChangeCallback();
        },
        setHref: function (href) {
            location.href = href;
        },
        reload: function () {
            var path = location.href.match(/([^\?#]+)\??([^#]+)?#?(.*)?/);
            var timestamp = "_ts_=" + new Date().getTime();
            path[2] = !!path[2] ? (path[2] + "&" + timestamp) : timestamp;
            path[3] = !!path[3] ? ("#" + path[3]) : "";
            this.setHref(path[1] + "?" + path[2] + path[3]);
        },
        hashChange: function (fun, interval) {
            var self = this;
            if (typeof(fun) == "function") {
                hashChangeCallback = function () {
                    var curHash = self._getCurHash();
                    if (self.objToQuery(curHash) !== self.objToQuery(hash)) {
                        fun(curHash, hash);
                        hash = curHash;
                    }
                };
                hashChangeCallback();
                setInterval(hashChangeCallback, interval || 50);
            }
        },
        _getCurHash: function (isPure) {
            return this.queryToObj(/#(.+)/, isPure);
        },
        _getCurQuery: function (isPure) {
            return this.queryToObj(/\?([^#]+)/, isPure);
        },
        queryToObj: function (reg, isPure) {
            var _query;
            if (_query = location.href.match(reg)) {
                _query = _query[1];
            }
            if (isPure)return _query;
            if (_query && _query.indexOf("=") > 0) {
                var params = _query.split("&"), pp, _query = {};
                for (var p = 0, len = params.length; p < len; p++) {
                    pp = params[p].split("=");
                    if (pp.length > 1)
                        try {
                            _query[pp[0]] = decodeURIComponent(pp[1]);
                        } catch (e) {
                            _query[pp[0]] = "";
                        }
                }
            }
            return _query || {};
        },
        objToQuery: function (obj) {
            if (typeof(obj) == "string")return obj;
            var query = [];
            for (var k in obj) {
                query.push(k + "=" + obj[k]);
            }
            return query.join("&");
        }
    };
})();
/**
 * 把source写入cookie
 */
(function () {
    var source = $.url.getQuery("source");
    if (source)$.cookie("jufanr_source", source, {path: "/"});
})();

//关闭按钮
$('.close-result').click(function(){
    $(this).parent().parent().fadeOut(500);
});

var show_err=function(msg){
    var o=$('#errtxt');
    o.html(msg);
    o.parent().parent().fadeIn(500);
    setTimeout(function(){
        o.parent().parent().fadeOut(500);
    },2000);
}

var mobok=function(m){
    return (m.length==11 && /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(14[0-9]{1}))+\d{8})$/.test(m));
}

$("#costcalc").click(function(){

    var size=$('#roomsize').val();
    var mob=$('#phone').val();

    if(size==''||size=='0'){
        show_err('无效的房屋面积，请重新输入！');
        return;
    }

    if(!mobok(mob)){
        show_err('请输入有效的手机号！');
        return;
    }

    $.getJSON('/admin/quicksubmit/newData?mobile='+mob+'&type=1&from=1&size='+size,function(r){
       if(r.code=200){
           var mc=size*25;
           var hc=size*33.6;

           $("#roomsize").val('');
           $("#phone").val('');

           $('#total-cost').html((mc+hc).toFixed(2));
           $('#m-cost').html(mc.toFixed(2));
           $('#p-cost').html(hc.toFixed(2));
           $('#calc-nor').fadeIn(500);

           var o=$('.seved-num>b');

           var c=parseInt(o.text());

           o.text(c+1);

       }else{
           show_err('报价时产生错误，请稍后再试！');
       }
    });
});

$('.closeBtn').click(function(){
   $(this).parent().parent().parent().hide();
});
