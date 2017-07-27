<?php

use frontend\widgets\ListViewWidget;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <title>添加好友</title>
        <link rel="stylesheet" href="/static/main/layui/css/layui.css" media="all">
        <link rel="stylesheet" href="/static/main/css/user.css">
    </head>
    <body>
        <div class="container">

            <div class="table-list">

                <table class="layui-table" lay-skin="line">
                    <thead>
                        <tr>
                            <th>用户名</th>
                            <th>个性签名</th>
                            <th>用户图像</th>
                            <th>年龄</th>
                            <th>用户注册时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $h = '';
                            foreach($lists as $v) {
                                $h .= '<tr data-assign="'. $i. '">';
                                $h .= '<td>'. $v['username'] . '</td>';
                                $h .= '<td>'. $v['sign'] . '</td>';
                                $h .= '<td><img width="100px;" height="100px;" src="'. $v['avatar'] . '"/></td>';
                                $h .= '<td>'. $v['age'] . '</td>';
                                $h .= '<td>'. $v['create_at'] . '</td>';
                                $h .= '<td><button  class="layui-btn layui-btn-disabled" data-id="'. $v['id'].'"><i class="layui-icon">&#xe608;</i> 好友</button></td>';
                                $h .= '</tr>';
                                $i++;
                            }
                            echo $h;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </body>
</html>
</html>