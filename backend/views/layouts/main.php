<?php

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <style>
        html{background-color: #D9D9D9;}
        .icon_img{
            -webkit-filter: grayscale(1);/* Webkit */
            filter:gray;/* IE6-9 */
            filter: grayscale(1);/* W3C */
        }
    </style>
    
    
    <script src="/static/layui/layui.js"></script>
    <script src="/static/js/chat.js"></script>
    <script src="/static/js/jquery.min.js"></script>
    <script>

        // 创建一个Socket实例
        $_CONFIG = {
            host            : '127.0.0.1',
            port            : '8991',
            myInfoUrl       : '{"a":"main/chat","m":"check","uid":"127","token":"5963180232045"}',
            initUserUrl     : 'http://im.classba.com.cn/main.php?a=chat&m=userInit&user_id=127',
            getSwarmUserUrl : 'http://im.classba.com.cn/main.php?a=chat&m=getSwramUserList',
            uploadImgUrl    : 'http://im.classba.com.cn/main.php?a=chat&m=uploadImg',
            uploadFileUrl   : 'http://im.classba.com.cn/main.php?a=chat&m=uploadFile',
            getUserHistoryMsgUrl : 'http://im.classba.com.cn/main.php/history',
            loginOutUrl : '{"a":"main/chat","m":"loginOut","uid":"127"}',
            loginUrl    : 'http://im.classba.com.cn/main.php?a=login&m=login',
            saveSignUrl : 'http://im.classba.com.cn/main.php?a=chat&m=saveSign&user_id=127',
            addFriendUrl : 'http://im.classba.com.cn/main.php?a=main&m=addFriend&user_id=127',
            checkMsgFriendUrl : 'http://im.classba.com.cn/main.php?a=main&m=checkMsgFriend&user_id=127',
            checkMsgFriendForSwarmUrl : 'http://im.classba.com.cn/main.php?a=main&m=checkMsgFriendForSwarm&user_id=127'
        };


        layui.use('layim', function(layim){
            chat.init(layim,$_CONFIG.host,$_CONFIG.port,'127');
            //基础配置
            layim.config({

                //初始化接口
                init: {
                    url: $_CONFIG.initUserUrl,
                    data: {}
                }

                //简约模式（不显示主面板）
                //,brief: true

                //查看群员接口
                ,members: {
                    url: $_CONFIG.getSwarmUserUrl,
                    data: {}
                }

                ,uploadImage: {
                    url: '' //（返回的数据格式见下文）
                    ,type: '' //默认post
                }

                ,uploadFile: {
                    url: '' //（返回的数据格式见下文）
                    ,type: '' //默认post
                }
                ,uploadImage: {
                    url: $_CONFIG.uploadImgUrl
                }
                ,uploadFile: {
                    url: $_CONFIG.uploadFileUrl
                }

                ,skin: ['aaa.jpg'] //新增皮肤
    //            ,isfriend: false //是否开启好友
    //            ,isgroup: false //是否开启群组
                ,chatLog: $_CONFIG.getUserHistoryMsgUrl //聊天记录地址
                ,find: 'http://im.classba.com.cn/main.php?a=main&m=find&user_id=127'
                ,copyright: true //是否授权
            });

            //监听发送消息
            layim.on('sendMessage', function(data){
                var To = data.to;
               // console.info(To);
                var toMsg = null;
                if(To.type=='friend') {
                    toMsg = '{"a":"main/chat","m":"sendMsg","user_id":"' + To.id + '","my_id":"' + data.mine.id + '","msg":"' + data.mine.content + '"}';
                }else{
                    toMsg = '{"a":"main/chat","m":"sendMsgSwarm","swarm_id":"' + To.id + '","my_id":"' + data.mine.id + '","msg":"' + data.mine.content + '"}';
                }
                chat.clientSendMsg(toMsg);
            });




            //监听在线状态的切换事件
            layim.on('online', function(status){
                toMsg = '{"a":"main/chat","m":"changeOnline","user_id":"127","status":"'+status+'"}';
                chat.clientSendMsg(toMsg);
            });


            //layim建立就绪
            layim.on('ready', function(res){


            });

            //监听查看群员
            layim.on('members', function(data){
                //console.log(data);
            });

            //监听聊天窗口的切换
            layim.on('chatChange', function(data){
                //console.log(data);
            });



        });

        function loginOut() {
            chat.loginOut();
        }


        $(function(){
            setTimeout(function(){
                $(".layui-layim-remark").hover(function(){
                    $(this).css("cursor","pointer");
                }).click(function(){
                    chat.saveSign($(this).text());
                });
            },1000)

        });
    </script>
</head>
<body>





</body>
</html>