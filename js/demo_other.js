/*
 * 注意：
 * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
 * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
 * 3. 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
 *
 * 如有问题请通过以下渠道反馈：
 * 邮箱地址：weixin-open@qq.com
 * 邮件主题：【微信JS-SDK反馈】具体问题
 * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
 */
wx.ready(function () {

    function showMessage(v) {
        $('#startRecord3').text(v);
    }

    // 4.2 开始录音
    $('#startRecord3').on('touchstart', function(event){
        event.preventDefault();
        console.info('touchstart');

        wx.startRecord({
            success: function(){
                showMessage('正在录音中...');
            },
            cancel: function () {
                alert('用户拒绝授权录音');
            }
        });
    });

    $('#startRecord3').on('touchend', function(event){
        event.preventDefault();
        console.info('touchend');
        wx.stopRecord({
            success: function (res) {
                voice.localId = res.localId;

                showMessage('智能语音点餐');

                //识别音频
                if (voice.localId == '') {
                    alert('请先使用 startRecord 接口录制一段声音');
                    return;
                }
                wx.translateVoice({
                    localId: voice.localId,
                    complete: function (res) {
                        if (res.hasOwnProperty('translateResult')) {
                            alert('识别结果：' + res.translateResult);
                        } else {
                            alert('无法识别');
                        }
                    }
                });
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    });


    // 8.4 批量显示菜单项
    document.querySelector('#chooseInvoiceTitle').onclick = function () {
        wx.invoke('chooseInvoiceTitle', {
            "scene":"1"
        }, function(res) {
            //这里是回调函数
            console.info(res);
            alert(JSON.stringify(res));
        });
    };

});
