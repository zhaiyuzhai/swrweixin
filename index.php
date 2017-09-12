<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx066c52aa969fca5d", "fea9651ccbd34c7797edb7d2b6d0cd6c");
$signPackage = $jssdk->GetSignPackage();
?>
<?php
$request=file_get_contents('php://input');
file_put_contents('./WXdevice.txt',$request);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>测试</title>
    <link rel="stylesheet" href="css/weui.css">
</head>
<body ontouchstart>
    <div style="width: 100%;">
        <h1 style="text-align: center">SWR 蓝牙硬件设备测试DEMO</h1>
        <button class="weui-btn weui-btn_plain-primary" id="btn11">停止</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn12">清屏</button>
        <div class="weui-media-box weui-media-box_text" id="outer">
            <h4 class="weui-media-box__title">蓝牙内容</h4>
            <p id="checkAPI">#####</p>
            <p id="lbInfo" class="weui-media-box__desc">。。。。。。</p>
            <p class="weui-media-box__desc" id="bluetoothContent"></p>
            <p class="weui-media-box__desc" id="recData">
                <span style="color:red;">接受到的数据为：</span>
            </p>
            <p class="weui-media-box__desc" id="recCount"></p>
        </div>
        <!--    <button class="weui-btn weui-btn_plain-primary" id="btn1">开始初始化设备</button>-->
        <button class="weui-btn weui-btn_plain-primary" id="btn1">检查jsApi</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn2">获取蓝牙设备信息</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn3">发送数据W给设备</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn4">发送十六进制的数据0x58给设备</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn5">10ms</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn6">20ms</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn7">50ms</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn8">100ms</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn9">200ms</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn10">开始</button>
        <button class="weui-btn weui-btn_plain-primary" id="btn13">发送时间</button>
    </div>
</body>
<!--引入微信官方的weui.css的配套js文件-->
<script src="https://res.wx.qq.com/open/libs/weuijs/1.1.1/weui.min.js"></script>
<!--引入了zepto.js来实现对DOM的增删改查-->
<script src="js/zepto.min.js"></script>
<!--/*引入jssdk来实现功能*/-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<!--引入base64来对接收的数据进行解码-->
<script src="js/base64.min.js"></script>
<script>
    alert("new")
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  var we=weui;
  var deviceId=[];
  var recCount=0;
wx.config({
    beta:true,
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
//        'checkJsApi',
//        'onMenuShareTimeline',
//        'onMenuShareAppMessage',
//        'onMenuShareQQ',
//        'onMenuShareWeibo',
//        'hideMenuItems',
//        'showMenuItems',
//        'hideAllNonBaseMenuItem',
//        'showAllNonBaseMenuItem',
//        'translateVoice',
//        'startRecord',
//        'stopRecord',
//        'onRecordEnd',
//        'playVoice',
//        'pauseVoice',
//        'stopVoice',
//        'uploadVoice',
//        'downloadVoice',
//        'chooseImage',
//        'previewImage',
//        'uploadImage',
//        'downloadImage',
//        'getNetworkType',
//        'openLocation',
//        'getLocation',
//        'hideOptionMenu',
//        'showOptionMenu',
//        'closeWindow',
//        'scanQRCode',
//        'chooseWXPay',
//        'openProductSpecificView',
//        'addCard',
//        'chooseCard',
//        'openCard',
//        jsAPI硬件部分
        'openWXDeviceLib',
        'closeWXDeviceLib',
        'getWXDeviceInfos',
        'sendDataToWXDevice',
        'startScanWXDevice',
        'stopScanWXDevice',
        'connectWXDevice',
        'disconnectWXDevice',
        'getWXDeviceTicket',
        'onWXDeviceBindStateChange',
        'onWXDeviceStateChange',
        'onReceiveDataFromWXDevice'
    ]
});
wx.ready(function () {
    // 在这里调用 API
    wx.error(function(res){
        alert("wx.error错误:"+JSON.stringify(res));
        //如果初始化出错了会调用此方法，没什么特别要注意的
    });
//        打开设备的硬件功能
    wx.invoke('openWXDeviceLib',{'brandUserName':'gh_e09af6572b88'}, function(res){
        //这里是回调函数
        if(res.isSupportBLE=="no"){
            alert("您的设备不支持此蓝牙设备")
        }
        if(res.bluetoothState=='unauthorized'){
            alert("请您授权设备的蓝牙功能，并打开")
        }
    });
//    检查各项jsapi的功能
    $("#btn1").on("click",function () {
        wx.checkJsApi({jsApiList: [ 'openWXDeviceLib', 'sendDataToWXDevice', 'getWXDeviceInfos',"onReceiveDataFromWXDevice"],success: function(res){$("#checkAPI").html(JSON.stringify(res))}});
        });
//   btn2获取设备信息
    $("#btn2").on("click",function(){
        wx.invoke('getWXDeviceInfos', {}, function(res){
            var len=res.deviceInfos.length;  //绑定设备总数量
//            $("#bluetoothContent").html(JSON.stringify(res.deviceInfos));

            for(i=0; i<len;i++)
            {
                $("#bluetoothContent").append("<span>"+JSON.stringify(res.deviceInfos[i])+"</span>")
                if(res.deviceInfos[i].state==="connected")
                {
                    deviceId.push(res.deviceInfos[i].deviceId);
                    $("#lbInfo").html("设备已成功连接");
                    $("#lbInfo").css({color:"green"});
                }
            }
        });
//        wx.invoke("connectWXDevice",{"deviceId":deviceId},function(res){
//            alert("连接的信息为："+res.err_msg);
//        })
    });
    //btn3，开始发送数据W
    $("#btn3").on("click",function(){
        sendData([0x57]);
    });
//    发送十六进制的0x58
    $("#btn4").on("click",function(){
        sendData([0x58]);
    });
//    发送十六进制的选择命令A803--10ms
    $("#btn5").on("click",function(){
        sendData([0xA8,0X03]);
    });
//    发送十六进制的选择命令A804--20ms
    $("#btn6").on("click",function(){
        sendData([0xA8,0x04]);

    });
//    发送十六进制的选择命令A805--50ms
    $("#btn7").on("click",function(e){
        sendData([0xA8,0x05]);
    });
//    发送十六进制的选择命令A806--100ms
    $("#btn8").on("click",function(e){
        sendData([0xA8,0x06]);
    });
//    发送十六进制的选择命令A807--200ms
    $("#btn9").on("click",function(e){
        sendData([0xA8,0x07]);
    });
//    发送十六进制的开始命令A2
    $("#btn10").on("click",function(e){
        sendData([0xA2]);
    });
//    发送十六进制的停止命令A4
    $("#btn11").on("click",function(e){
        sendData([0xA4]);
    });
    $("#btn12").on("click",function(e){
        $("#recData").html("");
        $("#reccount").html("");
    });
    $("#btn13").on("click",function(e){
        var newdate=new Date();
        var fullyear=newdate.getFullYear()-2000;
        var month=newdate.getMonth()+1;
        var date=newdate.getDate();
        var hour=newdate.getHours();
        var minute=newdate.getMinutes();
        var second=newdate.getSeconds();
        sendData([0x66,fullyear,month,date,hour,minute,second]);
    });
//    当设备接收到数据的时候，返回给jsapi，HTML页面
    wx.on('onReceiveDataFromWXDevice',function(res){
        recCount++;
        $("#recData").append('<p>'+getNumFromRaw(res.base64Data)+'</p>');
        $("#recCount").html(recCount);
    });
});
/*发送数据到硬件设备,直接输入,写成数组形式*/
function sendData(arr) {
    var base64Data=arrayToBase64(orderAraay(arr));
//    function fun(i) {
//        wx.invoke('sendDataToWXDevice', {'deviceId':deviceId[i], 'base64Data':base64Data}, function(res) {
////            alert(res.err_msg);
//        })
//    }
//    for(var i=0,len=deviceId.length;i<len;i++){
//        setTimeout(fun(i),10000)
//    }
    var cout=0;
    function sFunc() {
        wx.invoke('sendDataToWXDevice', {'deviceId':deviceId[cout], 'base64Data':base64Data}, function(res) {
//            alert(res.err_msg);
        });
        cout++;
        if(cout==deviceId.length){
            clearInterval(timer1);
            timer1=null;
        }
    }
    var timer1=setInterval(sFunc,150)
}
/*封装了处理十六字节数组转换为base64的方法*/
function orderAraay(arr){
    //FE 01 00 0F 75 31 00 00 0A 00 12 01 57 18 00
    var Bytes=new Array();
    for(var i=0;i<arr.length;i++){
      Bytes[i]=arr[i];
    }
    return Bytes;
}
/*根据微信官方文档说明，发送的指令数据必须是base64编码，所以还必须有个转换方法。
*  Byte数组转Base64字符,原理同上
* @Param [0x00,0x00]
* @return Base64字符串
**/
function arrayToBase64(array) {
    if (array.length == 0) {
        return "";
    }
    var b64Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
    var result = "";
    // 给末尾添加的字符,先计算出后面的字符
    var d3 = array.length % 3;
    var endChar = "";
    if (d3 == 1) {
        var value = array[array.length - 1];
        endChar = b64Chars.charAt(value >> 2);
        endChar += b64Chars.charAt((value << 4) & 0x3F);
        endChar += "==";
    } else if (d3 == 2) {
        var value1 = array[array.length - 2];
        var value2 = array[array.length - 1];
        endChar = b64Chars.charAt(value1 >> 2);
        endChar += b64Chars.charAt(((value1 << 4) & 0x3F) + (value2 >> 4));
        endChar += b64Chars.charAt((value2 << 2) & 0x3F);
        endChar += "=";
    }
    var times = array.length / 3;
    var startIndex = 0;
    // 开始计算
    for (var i = 0; i < times - (d3 == 0 ? 0 : 1); i++) {
        startIndex = i * 3;
        var S1 = array[startIndex + 0];
        var S2 = array[startIndex + 1];
        var S3 = array[startIndex + 2];

        var s1 = b64Chars.charAt(S1 >> 2);
        var s2 = b64Chars.charAt(((S1 << 4) & 0x3F) + (S2 >> 4));
        var s3 = b64Chars.charAt(((S2 & 0xF) << 2) + (S3 >> 6));
        var s4 = b64Chars.charAt(S3 & 0x3F);
        // 添加到结果字符串中
        result += (s1 + s2 + s3 + s4);
    }
    return result + endChar;
}
/*******解码成10进制的数据*/
function baseToString_10(msg) {
    var str='';
    var wx=Base64.decode(msg);
    for(var i=0;i<wx.length;i++){
        str+=wx.charCodeAt(i)+";";
    }
    return str;
}
/*将收到的数据进行解析，得到可用实际值*/
function getNumFromRaw(msg) {
//    需要获取到接受的数据的第2,3字节的数据来进行转码
    var str='';
    var wx=Base64.decode(msg);
    if(wx.length<=2){
        return "数据丢帧";
    } else{
        for(var i=0;i<wx.length;i++){
            str+=wx.charCodeAt(i)+";";
        }
        var newArray=str.split(";");
        var num=newArray[2]*256+parseInt(newArray[1]);
        return (num/100).toFixed(1);
    }
}
</script>
</html>
