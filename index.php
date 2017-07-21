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
    </div>
    <button class="weui-btn weui-btn_plain-primary" id="btn1">开始初始化设备</button>
    <button class="weui-btn weui-btn_plain-primary" id="btn2">获取蓝牙设备信息</button>
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
  wx.config({
    bate:true,
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard',
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
        weui.alert("wx already ok!!!");
    });
  $("#btn1").on("click",function(){
        wx.invoke('openWXDeviceLib', {}, function(res){
//这里是回调函数
          if(res.isSupportBLE=="no"){
              weui.alert("您的设备不支持此蓝牙设备",{title:"错误提示"})
          }
          if(res.bluetoothState=='unauthorized'){
              weui.alert("请您授权设备的蓝牙功能，并打开")
          }
      });
  });
  $("#btn2").on("click",function(){
      wx.invoke('getWXDeviceInfos', {}, function(res){
          var len=res.deviceInfos.length;  //绑定设备总数量
          for(i=0; i<=len-1;i++)
          {
              //alert(i + ' ' + res.deviceInfos[i].deviceId + ' ' +res.deviceInfos[i].state);
              if(res.deviceInfos[i].state==="connected")
              {
                  $("#bluetoothContent").html(res.deviceInfos[i].deviceId);
                  $("#lbInfo").html("2.设备已成功连接");
                  $("#lbInfo").css({color:"green"});

              }
          }

      });
  })
</script>
</html>
