function closeFireSDK() {
    var url = window.location.href.split('#')[0] + '#event=close';
    window.location.href = url;
}

/**
 * 判断值是否不为'',null，undefined,直接返回改值
 */
function getNull(v) {
    if (v == null || v == "" || typeof(v) == 'undefined') {
        return null;
    } else {
        return v;
    }
}

function isNull(v) {
    if (v == null || v == "" || typeof(v) == 'undefined' || (v + '') == 'undefined') {
        return null;
    } else {
        return v;
    }
}

/**
 *获取参数值
 */
function getParameter(param) {
    var v = getValueByName(window.location.search, param);
    return v;
}

function getParameterDecode(param) {
    return getValueByName(decodeURIComponent(window.location.search), param);
}

function getParameterForNull(param) {
    var search = window.location.search;
    if ((search + "") != 'undefined' || search != null || search != "") {
        var v = getValueByName(search, param);
        return v;
    } else {
        return "";
    }
}

/**
 *获取表单值
 */
function getForm(data, param) {
    var v = getValueByName(data, param);
    return v;
}

/**
 *获取链接值
 */
function getValueByName(query, param) {
    var query = query.split('?')[1];
    var iLen = param.length;
    if (isNull(query) == null) {
        return null;
    }
    var iStart = query.indexOf(param);
    if (iStart == -1) return "";
    iStart += iLen + 1;
    var iEnd = query.indexOf("&", iStart);
    if (iEnd == -1) return query.substring(iStart);
    return query.substring(iStart, iEnd);
}

function generateMixed(n) {
    var jschars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    var res = "";
    for (var i = 0; i < n; i++) {
        var id = Math.ceil(Math.random() * 10);
        res += jschars[id - 1];
    }
    return res;
}

/**
 * 发送jsop请求
 */
function sendRequestPost(url, data, successfn, errorfn) {
    return $.ajax({
        type: "post",
        dataType: "jsonp",
        jsonp: 'callback',
//		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: data,
        url: url,
        context: $(this),
        success: function (d) {
            successfn(d);
        },
        error: function (e) {
            errorfn(e);
        }
    });
}


/**
 * 发送同步jsop请求
 */
function sendRequestPostSync(url, data, successfn, errorfn) {
    return $.ajax({
        type: "post",
        dataType: "jsonp",
        jsonp: 'callback',
        data: data,
        async: false,
        url: url,
        context: $(this),
        success: function (d) {
            console.info(d);
            successfn(d);
        },
        error: function (e) {
            errorfn(e);
        }
    });
}


/**
 * 设置cookie
 */
function setCookie(key, value) {
    var option = {};
    option.path = "/";
    $.cookie(key, encodeURIComponent(value), option);
}

/**
 * 和SetCookie一样； 目的是解决ourpalmtools和requesttoptemp两个js文件中有重名的该方法；后续建议直接使用该方法
 */
function setOurpalmCookie(key, value) {
    var option = {};
    option.path = "/";
    $.cookie(key, encodeURIComponent(value), option);
}

/**
 * 和getCookie一样； 目的是解决ourpalmtools和requesttoptemp两个js文件中有重名的该方法；后续建议直接使用该方法
 * @param key
 * @returns
 */
function getOurpalmCookie(key) {
    var value = $.cookie(key);
    return decodeURIComponent(value);
}

/**
 * 获取cookie
 */
function getCookie(key) {
    var value = $.cookie(key);
    return decodeURIComponent(value);
}

/**
 * 验证手机号
 */
function checkMobile(data) {
    var reg = /(13|14|15|17|18)[0-9]{9}/;
    if (!reg.test(data)) {
        return false;
    }
    return true;
}

/**
 * 获取图形验证码 ，GSCFRONT
 */
function getImgCode(imgId) {

    var url = 'http://gscservice.gamebean.net/gscfront/cms/index.do';
    var tokenId = getNotUserTokenId();
    var data = '{"interfaceId":"2009","tokenId":"' + tokenId + '","type":"grh","phone":""}';
    url = url + '?jsonStr=' + data + '&r=' + Math.random();
    $('#' + imgId).attr('src', url);

}

/**
 * 获取手机验证码 ，GSCFRONT
 */
function getPhoneCode(phoneId, alertId) {

    var phone = $('#' + phoneId).val();
    if (phone == '') {
        if (alertId && $('#' + alertId).size() > 0) {
            $('#' + alertId).show().html('请输入手机号');
        } else {
            alert('请输入手机号');
        }
        return false;
    }

    if (!checkMobile(phone)) {
        if (alertId && $('#' + alertId).size() > 0) {
            $('#' + alertId).show().html('请输入正确手机号');
        } else {
            alert('请输入正确手机号');
        }
        return;
    }

    var url = 'http://gscservice.gamebean.net/gscfront/cms/index.do';
    var data = 'jsonStr={"interfaceId":"2009","tokenId":"' + getNotUserTokenId() + '","type":"usms","phone":"' + phone + '"}';
    sendRequestPost(url, data, function (data) {
        if (data.status == 0) {
            if (alertId && $('#' + alertId).size() > 0) {
                $('#' + alertId).show().html('获取短信成功');
            } else {
                alert('获取短信成功');
            }
        } else {
            if (alertId && $('#' + alertId).size() > 0) {
                $('#' + alertId).show().html(data.desc);
            } else {
                alert(data.desc);
            }
        }
    }, new Function());

}

/**
 *直接初始化
 * 在页面加载完成后运行
 */
function fetchNotUserTokenId() {
    if (getNotUserTokenId() && ( getNotUserTokenId() != null || getNotUserTokenId() != '' )) {
        return false;
    }
    var url = 'http://gscservice.gamebean.net/gscfront/cms/index.do';
    var data = 'jsonStr={"interfaceId":"2008","tokenId":""}';
    sendRequestPost(url, data, function (data) {
        if (data.status == 0 && data.content && data.content.tokenId)
            setNotUserTokenId(data.content.tokenId);
    }, new Function());
}

function setNotUserTokenId(token) {
    setCookie('ourpalm_notlogin_token', token);
}

function getNotUserTokenId() {
    return getCookie('ourpalm_notlogin_token');
}

/**
 * 解析41位pcode
 * @param pcode41
 * @return
 */
function getParasFromPcode41(pcode41) {
    var para = {};
    if (pcode41.length >= 8) {
        para.productId = pcode41.substr(0, 8);
    }

    if (pcode41.length >= 19) {
        para.oprationLineId = pcode41.substr(8, 11);
    }

    if (pcode41.length >= 35) {
        para.channelId = pcode41.substr(19, 16);
    }

    if (pcode41.length >= 39) {
        para.deviceGroupId = pcode41.substr(35, 4);
    }

    if (pcode41.length >= 41) {
        para.localId = pcode41.substr(39, 2);
    }

    return para;
}


function op_pageStyle(pageNum, currentPage, colorCode) {
    if (isNull(currentPage) == null) {
        currentPage = 1;
    }
    if (pageNum == currentPage) {
        document.write('<b><font color=colorCode>' + pageNum + '</font></b>');
        return;
    }
    document.write(pageNum);
}

function isPageTest() {
    if (getNull(window._pageTest) != null && window._pageTest) {
        return true;
    }
    return false;
}

function getDomain() {
    return (window.location.protocol + '//' + window.location.host);
}

;
(function ($) {
    var pageTest = getParameter('pageTest');
    if (getNull(pageTest) != null && pageTest == 'true') {
        window._pageTest = true;
    } else {
        window._pageTest = false;
    }
})($);
