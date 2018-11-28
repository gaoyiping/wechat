mbox = function (content) {
    var box = new BlackBox();
    box.alert(content, { title: '系统消息', value: "确定" });
};

tbox = function (content, toURL) {   //提示消息后，跳转到某页面
    var box = new BlackBox();
    box.alert(content, function () {
        window.location.replace(toURL);
    }, { title: '系统消息', value: "确定" });
};

pbox = function (path) {
    var box = new BlackBox();
//    box.alert('<div style="width: 300px;padding: 20px 10px;background: #f5f5f5;"> <img src="' + path + '" />' +
    box.alert('<div> <img src="' + path + '" />' +
        '</div>', { title: '图片', value: "确定" });
};
//cbox = function (content) {
//    var box = new BlackBox();
//    box.confirm(content, function (data) {
//        if (data) {
//            return true;
//        } else {
//            return false;
//        }
//    });
//};
