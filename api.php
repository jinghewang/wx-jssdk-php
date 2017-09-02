<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/2/7
 * Time: 上午8:52
 */

header("Content-type: application/json");


$result = array(
    'status' => 200,
    'params' => [],
    'data' => [],
    'message' => '',
);

$text = $_REQUEST['data'];
$result['params'] = ['text' => $text];
if (empty($text)){
    $result['status'] = 300;//传入数据为空
    $result['message'] = '传入数据为空';
}
else{
    $so = scws_new();
    $so->set_charset('utf8');
    // 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
    $so->set_dict('/usr/local/scws/etc/dict.utf8.xdb');
    $so->set_rule('/usr/local/scws/etc/rules.utf8.ini');
    //$so->set_ignore(true);//设定分词返回结果时是否去除一些特殊的标点符号之类。
    //$so->set_duality(true);//设定是否将闲散文字自动以二字分词法聚合
    //$so->set_multi(15);//设定分词返回结果时是否复合分割，如“中国人”返回“中国＋人＋中国人”三个词。
    //$so->set_debug(true);

    //$text = "我是一个中国人,我会C++语言,我也有很多T恤衣服";
    //$text = "我要宫保鸡丁一份和燕京纯生一瓶，然后去下单";

    $so->send_text($text);
    $dict = [];
    while ($tmp = $so->get_result())
    {
        //print_r($tmp);
        $dict[] = $tmp;
    }

    //$dict = $so->get_tops(10);
    $result['data'] = $dict;
    $so->close();
}

echo json_encode($result);