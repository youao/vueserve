<?php
$DB['servername'] = "localhost";
$DB['username'] = "admin";
$DB['password'] = "123456";
$DB['dbname'] = "youch";

function dbConn()
{
    global $DB;
    $conn = new mysqli($DB['servername'], $DB['username'], $DB['password'], $DB['dbname']);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    return $conn;
}

function dbSelect($sql)
{
    $conn = dbConn();
    
    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
    }
    if (!isset($row)) {
        $row = array();
    }

    return $row;

    $conn->close();
}

function ddUpdate($sql)
{
    global $DB;

    $conn = mysqli_connect($DB['servername'], $DB['username'], $DB['password']);

    mysqli_query($conn , "set names utf8");

    mysqli_select_db($conn, $DB['dbname']);

    $retval = mysqli_query($conn, $sql);

    if (!$retval) {
        $error = '更新数据出错: ' . mysqli_error($conn);
        exit(requestResult($error));
    }

    return true;

    mysqli_close($conn);
}