var pako = window.pako;

function gzip(string) {
    var charData = string.split('').map(function (x) {
        return x.charCodeAt(0);
    });
    var binData = new Uint8Array(charData);
    var data = pako.gzip(binData);
    var strData = String.fromCharCode.apply(null, new Uint16Array(data));
    return btoa(strData);
}
function ungzip(string)
{
    var strData = atob(string);
    var charData = strData.split('').map(function (x) {
        return x.charCodeAt(0);
    });
    var binData = new Uint8Array(charData);
    var data = pako.ungzip(binData);
    var strData = String.fromCharCode.apply(null, new Uint16Array(data));
    return strData;
}
layui.use(['layer', 'form', 'upload', 'layim'], function () {
    var layer = layui.layer
            , form = layui.form()
            , upload = layui.upload
            , layim = layui.layim;
    var userinfo = JSON.parse(loginInfo);

    layim.config({
        brief: false, //是否简约模式（如果true则不显示主面板）
        init: {
            url: '/main/getgroup'
            , data: {}
        }
        , members: {
            url: '/main/getgroupex' //接口地址（返回的数据格式见下文）
            , data: {} //额外参数
        }
        , isAudio: true //开启聊天工具栏音频
        , isVideo: true //开启聊天工具栏视频
        , tool: [{
                alias: 'code'
                , title: '代码55555'
                , icon: '&#xe64e;'
            }]
        , uploadImage: {
            url: 'uploadimg', //（返回的数据格式见下文）
            type: 'post' //默认post
        }
        , uploadFile: {
            url: 'uploadfile', //（返回的数据格式见下文）
            type: 'post' //默认post
        }
        , isfriend: true //是否开启好友（默认true，即开启）
        , copyright: true
        , chatLog: 'viewchat'
        , msgbox: '/main/getmsg'//消息盒子页面地址，若不开启，剔除该项即可
        , find: '/main/addfriend' //发现页面地址，若不开启，剔除该项即可
    });

// //创建一个会话
//   layim.chat({
//     id: 101
//     ,name: '神盾局长'
//     ,type: 'friend' //friend、group等字符，如果是group，则创建的是群聊
//     ,avatar: '/static/main/images/94.jpg'
//   }); 

    layim.on('members', function (data) {
//        console.log(data);
    });

    //监听在线状态的切换事件
    layim.on('online', function (status) {
        layer.msg(status);
    });

    //监听签名修改
    layim.on('sign', function (value) {
        layer.msg(value);
    });

    //监听自定义工具栏点击，以添加代码为例
    layim.on('tool(code)', function (insert) {
        layer.prompt({
            title: '插入代码'
            , formType: 2
            , shade: 0
        }, function (text, index) {
            layer.close(index);
            insert('[pre class=layui-code]' + text + '[/pre]'); //将内容插入到编辑器
        });
    });

    //监听layim建立就绪
    layim.on('ready', function (res) {
//        console.log(res.mine);
        $.get('/main/get-msg-count', {
        }, function (res) {
            res = JSON.parse(res);
            
            if (res.code != 0) {
                return layer.msg(res.msg);
            }
            
            layim.msgbox(res.data); //模拟消息盒子有新消息，实际使用时，一般是动态获得
        });
    });

    var ws = new WebSocket("ws://0.0.0.0:9501");

    ws.onopen = function (event) {
        
        console.log("与服务器建立连接成功.");

        ws.send(JSON.stringify({cmd : 'initUserList', Username: userinfo['username'], Data: "亲！我连上啦！", Mtype: "mess", Img: userinfo['avatar'], type: 'login', uid: userinfo['id'], Timestamp: Date.parse(new Date())}));
    };
    ws.onclose = function (event) {
        
        alert('服务器连接已断开')
        $.get('/login/logout')
        window.location.href = '/login/login';
        console.log('服务器连接已断开');
    };
    ws.onmessage = function (data)
    {
        zqfdata = JSON.parse(data.data);
        
        console.log(zqfdata);
        zqfdata.type = 'friend';
        zqfdata.Username = '雷布斯';
        zqfdata.Img = '/static/main/images/90.png';
        zqfdata.uid = 36;
        zqfdata.Data = 'are you ok？';
        zqfdata.Timestamp = '2017-07-26 00:00:00';
        
        if (zqfdata.type == 'group') {
            if (zqfdata.Mtype == 'video') {
                image.src = ungzip(zqfdata.Data);
            } else if (zqfdata.Mtype == 'mess') {
                if (zqfdata.Data == '亲！我连上啦！') {
                    layim.getMessage({
                        system: true
                        , id: zqfdata.Id
                        , type: "group"
                        , content: zqfdata.Username + '加入群聊'
                    });
                } else {
                    layim.getMessage({
                        username: zqfdata.Username //消息来源用户名
                        , avatar: zqfdata.Img //消息来源用户头像
                        , id: zqfdata.Id //聊天窗口来源ID（如果是私聊，则是用户id，如果是群聊，则是群组id）
                        , type: "group" //聊天窗口来源类型，从发送消息传递的to里面获取
                        , content: zqfdata.Data //消息内容
                                //,cid: 0 //消息id，可不传。除非你要对消息进行一些操作（如撤回）
                        , mine: false //是否我发送的消息，如果为true，则会显示在右方
                                //,fromid: zqfdata.Fromid //消息来源者的id，可用于自动解决浏览器多窗口时的一些问题
                        , timestamp: zqfdata.Timestamp  //服务端动态时间戳
                    });
                }
                //$('#chatLog').append('<br/>'+zqfdata.data);
                //$('#zystmp').text(zqfdata.Data);
                //$('#livegotmp').attr('src',zqfdata.Img);
                //$('#zystmp').trigger('click');
            } else if (zqfdata.Mtype == 'mic') {
                // var blob=dataURLtoBlob(zqfdata.data);
                //console.log(zqfdata.data);
                //console.log(window.URL.createObjectURL(blob));
                //$('#audio').attr('src',zqfdata.data);
                //$('#audio').append('<source src="'+zqfdata.Data+'"/>')
                audio.playlist.push(zqfdata.Data);
                //audio.src =zqfdata.Data;
                if (audio.paused) {
                    audio.start();
                }
                /*g_audio.elems["id"] = '';
                 g_audio.push({
                 song_id: '',
                 song_fileUrl: window.URL.createObjectURL(zqfdata.data)
                 //audio.src = window.URL.createObjectURL(zqfdata.data);
                 });  */
            }
        } else if (zqfdata.type == 'friend') {
            layim.getMessage({
                username: zqfdata.Username //消息来源用户名
                , avatar: zqfdata.Img //消息来源用户头像
                , id: zqfdata.uid //消息的来源ID（如果是私聊，则是用户id，如果是群聊，则是群组id）
                , type: "friend" //聊天窗口来源类型，从发送消息传递的to里面获取
                , content: zqfdata.Data //消息内容
                , mine: false //是否我发送的消息，如果为true，则会显示在右方
                        //,fromid: zqfdata.Id //消息的发送者id（比如群组中的某个消息发送者），可用于自动解决浏览器多窗口时的一些问题
                , timestamp: zqfdata.Timestamp //服务端动态时间戳
            });
        }
    }

//监听聊天窗口的切换
    layim.on('chatChange', function (res) {
        var type = res.data.type;

        console.log(res.data)
        if (type === 'friend') {
            //模拟标注好友状态
            layim.setChatStatus('<span style="color:#5FB851;">在线</span>');

//            layim.getMessage({
//                system: false
//                , id: res.data.id
//                , type: "group"
//                , content: '模拟群员' + (Math.random() * 100 | 0) + '加入群聊'
//            });
        } else if (type === 'group') {
            //模拟系统消息
            layim.getMessage({
                system: true
                , id: res.data.id
                , type: "group"
                , content: '模拟群员' + (Math.random() * 100 | 0) + '加入群聊'
            });
        }
    });


    //监听发送消息
    layim.on('sendMessage', function (data) {
        var To = data.to;
        console.log(To)
        if (To.type === 'friend') {
            layim.setChatStatus('<span style="color:#FF5722;">对方正在输入。。。</span>');
             if(To.fromid!=undefined && To.fromid!=To.id){
             	To.id=To.fromid;
             	To.fromid=livego_result.data.mine.id;
             }
            obj = {
                cmd : 'initUserList',
                Username: To.name
                , Data: data.mine.content
                , Img: data.mine.avatar
                , Id: To.id
                , type: To.type
                , uid: userinfo['uid']
                , Timestamp: Date.parse(new Date())

            }
            ws.send(JSON.stringify(obj));
        }
        if (To.type === 'group') {
            console.log(data);
            obj = {
                Username: data.mine.username
                , Data: data.mine.content
                , Mtype: 'mess'
                , Img: To.avatar
                , Id: To.id
                , type: To.type
                , uid: userinfo['uid']
                , Timestamp: Date.parse(new Date())

            }
            ws.send(JSON.stringify(obj));
        }

        //演示自动回复
//        setTimeout(function () {
//            var obj = {};
//            if (To.type === 'friend') {
//                obj = {
//                    username: '模拟群员' + (Math.random() * 100 | 0)
//                    , avatar: layui.cache.dir + 'images/face/' + (Math.random() * 72 | 0) + '.gif'
//                    , id: To.id
//                    , type: To.type
//                    , content: autoReplay[Math.random() * 9 | 0]
//                }
//            } else {
//                obj = {
//                    username: To.name
//                    , avatar: To.avatar
//                    , id: To.id
//                    , type: To.type
//                    , content: autoReplay[Math.random() * 9 | 0]
//                }
//                layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
//            }
//            layim.getMessage(obj);
//        }, 1000);
    });
});
  