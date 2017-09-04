# wx-jssdk-php
微信 jssdk Demo for PHP
# 重要说明

## 来源： 微信JS-SDK说明文档
https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141115

### 附录6-DEMO页面和示例代码
DEMO页面：
http://demo.open.weixin.qq.com/jssdk

示例代码：
http://demo.open.weixin.qq.com/jssdk/sample.zip

### 并额外添加了智能语音点餐和微信闪电开票

1.设置错误提示级别
```php
ini_set("display_errors", "On");
error_reporting(E_ERROR);
```

2.设置了时区
```php
date_default_timezone_set('Asia/Shanghai');
```

3.提取了 inc.php 进行相关参数配置

```php
define('APPID','你的APPID');
define('APPSECRET','你的APPSECRET');
```

## `opt`配置参数说明

参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
------------------------|------------------------|------------------------|------------------------|------------------------
APPID|应用ID|String(35)|签约商户的应用ID号|Y
APPSECRET|安全码|String(32)|签约商户唯一的安全码|Y

4.智能语音点餐和微信闪电开票

**智能语言点餐**使用了分词处理，请注意。

**微信闪电开票**使用的H5形式的，官方也提供其它形式的。

参见：
https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1496554912_vfWU0
