<?php
include 'utils/db.php';
include 'utils/aes.php';

/**
 * 获取axios提交的post数据
 */
function getAxiosPostData()
{
    $content = file_get_contents('php://input');
    $data = array();
    if (empty($content)) {
        return $data;
    }

    $content = explode('&', $content);

    for ($i = 0; $i < count($content); $i++) {
        $arr = explode('=', $content[$i]);
        $data[$arr[0]] = $arr[1];
    }

    return $data;
}

/**
 * 获取axios提交的post数据
 */
function requestResult($ops)
{
    if (is_string($ops)) {
        $msg = $ops;
    } elseif (is_array($ops)) {
        $msg = $ops['msg'] || '';
        $status = $ops['status'] || 0;
        $data = $ops['data'] || array();
    }
    $res['status'] = isset($status) ? $status : 0;
    if (isset($msg)) {
        $res['msg'] = $msg;
    }
    if (isset($data)) {
        $res['data'] = $data;
    }
    return json_encode($res);
}
