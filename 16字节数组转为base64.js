function getAraay(){
    //FE 01 00 0F 75 31 00 00 0A 00 12 01 57 18 00
    var Bytes=new Array();

    Bytes[0]=0xFE;

    Bytes[1]=0x01;
    Bytes[2]=0x00;

    Bytes[3]=0x0F;
    Bytes[4]=0x75;

    Bytes[5]=0x31;
    Bytes[6]=0x00;
    Bytes[7]=0x00;
    Bytes[8]=0x0A;
    Bytes[9]=0x00;
    Bytes[10]=0x12;
    Bytes[11]=0x01;
    Bytes[12]=0x57;
    Bytes[13]=0x18;
    Bytes[14]=0x00;
    return Bytes;
}
// 根据微信官方文档说明，发送的指令数据必须是base64编码，所以还必须有个转换方法。

/**
 *  Byte数组转Base64字符,原理同上
 * @Param [0x00,0x00]
 * @return Base64字符串
 **/
function bytes_array_to_base64(array) {
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
var arr=getAraay();
console.log(bytes_array_to_base64(arr));