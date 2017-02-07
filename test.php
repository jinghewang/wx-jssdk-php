<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/2/7
 * Time: 上午8:52
 */


$so = scws_new();
$so->set_charset('utf8');
// 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
$so->set_dict('/usr/local/scws/etc/dict.utf8_2.xdb');
$so->set_rule('/usr/local/scws/etc/rules.utf8.ini');
//$so->set_ignore(true);//设定分词返回结果时是否去除一些特殊的标点符号之类。
//$so->set_duality(true);//设定是否将闲散文字自动以二字分词法聚合
$so->set_multi(15);//设定分词返回结果时是否复合分割，如“中国人”返回“中国＋人＋中国人”三个词。
//$so->set_debug(true);

//$text = "我是一个中国人,我会C++语言,我也有很多T恤衣服";
$text = "宫保鸡丁一份，红烧带鱼一斤";
$so->send_text($text);
print_r($text);
while ($tmp = $so->get_result())
{
    print_r($tmp);
}
$so->close();


die;


header("Content-type: application/json");

$url = "http://www.xunsearch.com/scws/api.php";
$post_data = array("data"        => "红烧带鱼来一份",
                   "respond"     => "json",
                   'charset'     => 'utf8',
                   'ignore'      => 'no',
                   'duality'     => 'no',
                   'traditional' => 'no',
                   'multi'       => 3);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

$output = curl_exec($ch);
curl_close($ch);

//打印获得的数据
print_r($output);
