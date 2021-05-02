<?php
    function get_http_code($url) { 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, $url); //设置URL 
        curl_setopt($curl, CURLOPT_HEADER, 1); //获取Header 
        curl_setopt($curl, CURLOPT_NOBODY, true); //只保留Head 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //数据到成字符串
        $data = curl_exec($curl); //开始请求 
        $return = curl_getinfo($curl, CURLINFO_HTTP_CODE); //获取状态码
           
        curl_close($curl); //关闭请求 
           
        return $return; 
    }

    // 引入类
    require_once('../inc/require.php');
    global $config;
    if($config['api']) {
        $url_c = new url();

        $opt = [];
        $opt['success'] = 'false';

        if(isset($_GET['url'])) {
            // 添加 HTTP 协议前缀
            if(!strstr($_GET['url'], 'http://') && !strstr($_GET['url'], 'https:')) $_GET['url'] = 'http://' . $_GET['url'];
            // 检测网址格式是否正确
            $is_link = preg_match('(http(|s)://([\w-]+\.)+[\w-]+(/)?)', $_GET['url']);
            //判断该网页是否能正常访问 -- 白云
        $webcode = number_format(get_http_code($_GET['url']) or die('{"success":"false","content":"\u8be5\u94fe\u63a5\u65e0\u6cd5\u6b63\u5e38\u8bbf\u95ee\uff0c\u8bf7\u68c0\u67e5\u662f\u5426\u6b63\u786e\uff01"}');
            if($webcode <200 or $webcode>=500){
                $opt['content'] = '该链接无法正常访问，请确认输入内容是否正确。';
                die('{"success":"false","content":"\u8be5\u94fe\u63a5\u65e0\u6cd5\u6b63\u5e38\u8bbf\u95ee\uff0c\u8bf7\u68c0\u67e5\u662f\u5426\u6b63\u786e\uff01"}');
            }
            // 判断条件
            if($_GET['url'] != '' && !strstr($_GET['url'], $_SERVER['HTTP_HOST']) && $is_link) {
                $opt['success'] = 'true';
                $opt['content']['url'] = $url_c->set_url($_GET['url'], $config['length']);
            } else if(strstr($_GET['url'], $_SERVER['HTTP_HOST'])) {
                $opt['content'] = '链接已经是短地址了。';
            } else if(!$is_link) {
                $opt['content'] = '请输入正确格式的网址。';
            }
        } else {
            $opt['content'] = '调用参数不能为空。';
        }
        // 输出
        echo json_encode($opt);
    }
?>
