<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>liveim消息</title>

        <link rel="stylesheet" href="/static/main/layui/css/layui.css">
        <style>
            .layim-msgbox{margin: 15px;}
            .layim-msgbox li{position: relative; margin-bottom: 10px; padding: 0 130px 10px 60px; padding-bottom: 10px; line-height: 22px; border-bottom: 1px dotted #e2e2e2;}
            .layim-msgbox .layim-msgbox-tips{margin: 0; padding: 10px 0; border: none; text-align: center; color: #999;}
            .layim-msgbox .layim-msgbox-system{padding: 0 10px 10px 10px;}
            .layim-msgbox li p span{padding-left: 5px; color: #999;}
            .layim-msgbox li p em{font-style: normal; color: #FF5722;}

            .layim-msgbox-avatar{position: absolute; left: 0; top: 0; width: 50px; height: 50px;}
            .layim-msgbox-user{padding-top: 5px;}
            .layim-msgbox-content{margin-top: 3px;}
            .layim-msgbox .layui-btn-small{padding: 0 15px; margin-left: 5px;}
            .layim-msgbox-btn{position: absolute; right: 0; top: 12px; color: #999;}
        </style>
        <link rel="stylesheet" href="/static/main/layui/css/modules/layim/layim.css?v=3.05Pro" media="all">
        <link rel="stylesheet" href="/static/main/layui/css/modules/layer/default/layer.css?v=3.0.2302" media="all">
    </head>
    <body>
        <ul class="layim-msgbox" id="LAY_view">
                <li class="layim-msgbox-system">
                        <p>
                                <em>
                                        系统：
                                </em>
                                qieangel@qq.com同意你的好友申请
                                <span>
                                        刚刚
                                </span>
                        </p>
                </li>
                <div class="layui-flow-more">
                        <li class="layim-msgbox-tips">
                                暂无更多新消息
                        </li>
                </div>
        </ul>
    </body>
</html>