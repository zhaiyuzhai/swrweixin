<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx066c52aa969fca5d", "fea9651ccbd34c7797edb7d2b6d0cd6c");
$signPackage = $jssdk->GetSignPackage();
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
    <h1 style="text-align: center">SWR 蓝牙硬件设备测试DEMO</h1>
    <div class="weui-media-box weui-media-box_text">
        <h4 class="weui-media-box__title">蓝牙内容</h4>
        <p id="lbInfo" class="weui-media-box__title">。。。。。。</p>
        <p class="weui-media-box__desc" id="bluetoothContent">。。。。。。</p>
        <p class="weui-media-box__desc" id="recData">......</p>
    </div>
<!--    <button class="weui-btn weui-btn_plain-primary" id="btn1">开始初始化设备</button>-->
    <button class="weui-btn weui-btn_plain-primary" id="btn2">获取蓝牙设备信息</button>
    <button class="weui-btn weui-btn_plain-primary" id="btn3">发送数据W给设备</button>
    <button class="weui-btn weui-btn_plain-primary" id="btn4">发送数据□给设备</button>
    <button class="weui-btn weui-btn_plain-primary" id="btn5">发送数据15字节给设备</button>
    <button class="weui-btn weui-btn_plain-primary" id="btn6">发送数据copy数据给设备</button>

</body>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.1.1/weui.min.js"></script>
<script src="js/zepto.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
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
  var deviceId;
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
//    weui.alert("wx already ok!!!");

    wx.invoke('openWXDeviceLib',{'brandUserName':'gh_e09af6572b88'}, function(res){
//这里是回调函数
    we.alert(res);
    if(res.isSupportBLE=="no"){
        we.alert("您的设备不支持此蓝牙设备")
    }
    if(res.bluetoothState=='unauthorized'){
        we.alert("请您授权设备的蓝牙功能，并打开")
    }
    });
    $("#btn2").on("click",function(){
//    alert("btn2 is clicked");
//    we.alert("weui is worked");
        wx.invoke('getWXDeviceInfos', {}, function(res){
            we.alert("获取硬件设备的信息生效");
            var len=res.deviceInfos.length;  //绑定设备总数量
            we.alert(len);
            for(i=0; i<=len-1;i++)
            {
                //alert(i + ' ' + res.deviceInfos[i].deviceId + ' ' +res.deviceInfos[i].state);
                if(res.deviceInfos[i].state==="connected")
                {
                    $("#bluetoothContent").html(res.deviceInfos[i].deviceId);
                    deviceId=res.deviceInfos[i].deviceId;
                    $("#lbInfo").html("设备已成功连接");
                    $("#lbInfo").css({color:"green"});
                }
            }
        });
        wx.invoke("connectWXDevice",{"deviceId":deviceId},function(res){
            alert("连接的信息为："+res.err_msg);
        })
    });
    //当点击第三个按钮的时候,开始发送数据
    //FE 01 00 0F 75 31 00 00 0A 00 12 01 57 18 00
    $("#btn3").on("click",function(){
//        we.alert("开始发送");
        we.alert("设备ID"+deviceId);
        wx.invoke('sendDataToWXDevice', {'deviceId':deviceId, 'base64Data':'Vw=='}, function(res) {
//            console.log('sendDataToWXDevice',res);
            alert(res.err_msg);
        });
    });
    $("#btn4").on("click",function(){
//        we.alert("开始发送");
        we.alert("设备ID"+deviceId);
        wx.invoke('sendDataToWXDevice', {'deviceId':deviceId, 'base64Data':'/g=='}, function(res) {
//            console.log('sendDataToWXDevice',res);
            alert(res.err_msg);
        });
    });
    $("#btn5").on("click",function(){
//        we.alert("开始发送");
        we.alert("设备ID"+deviceId);
        wx.invoke('sendDataToWXDevice', {'deviceId':deviceId, 'base64Data':'/gEAD3UxAAAKABIBVxgA'}, function(res) {
//            console.log('sendDataToWXDevice',res);
            alert(res.err_msg);
        });
    });
    $("#btn6").on("click",function(e){
        alert("开始"+deviceId);
        var Bytes=CheckBalance();
        var x=senddataBytes(Bytes,deviceId);
        alert(x);
    });
    wx.on('onReceiveDataFromWXDevice',function(res){
        alert("接收到数据了");
        $("#recData").html(res.toString());
    })
});
//****************************************将接收数据的函数放到外面来**********
  wx.on('onReceiveDataFromWXDevice',function(res){
      alert("out接收到数据了");
      $("#recData").html(res.toString());
  });
  WeixinJSBridge.on("onReceiveDataFromWXDevice",function(res){
      alert("JSbridge接收到数据了");
      $("#recData").html(res.toString());
  });
    wx.checkJsApi({jsApiList: [ 'openWXDeviceLib', 'sendDataToWXDevice', 'getWXDeviceInfos'],success: function(res) {alert("检查Api"+res)}});
    wx.error(function(res){
      alert("wx.error错误："+JSON.stringify(res));
      //如果初始化出错了会调用此方法，没什么特别要注意的
    });
//**************************************************
//额外附加的测试代码
  //发送数据到硬件设备
  function senddataBytes(cmdBytes,selDeviceID){
      //1. 如果输入的参数长度为零，则直接退出
      if(cmdBytes.length<=0){return -1};
      // alert("向微信发送指令数据");
      //1.1 如果设备ID为空，则直接返回
      if(selDeviceID.length<=0){return -1};
      //2. 发送数据
      var x=0;
      WeixinJSBridge.invoke('sendDataToWXDevice', {
          "deviceId":selDeviceID,
          "base64Data":bytes_array_to_base64(cmdBytes)
      }, function(res){
          //alert("向微信发送指令数据返回的状态"+res.err_msg);
          if(res.err_msg=='sendDataToWXDevice:ok')
          {

              x=0;
              alert("数据发送成功");
          }
          else
          {

              x=1;
              alert("数据发送失败");
          }
      });
      return x;
  }
//  一般硬件设备接收的是16进制的指令数据
  function CheckBalance(){
      var Bytes=new Array();
      Bytes[0]=0x02;
      Bytes[1]=0x00;
      Bytes[2]=0x05;
      Bytes[3]=0x76;
      Bytes[4]=0x89;
      Bytes[5]=0x03;
      Bytes[6]=0x74;
      return Bytes;
  }
  //转换成base64格式
  function bytes_array_to_base64(array) {
      if (array.length == 0){
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
</script>
</html>
