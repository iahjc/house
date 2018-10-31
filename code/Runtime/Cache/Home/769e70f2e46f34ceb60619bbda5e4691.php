<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>用户数据</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            table {
                width: 80%;
                margin: 0 auto;
            }
            table tr td {
                border: 1px solid #ccc;
                text-align: center;
            }
            h1 {
                text-align: center;
                line-height: 100px;
            }
            .next-page {
                text-align: center;
                line-height: 100px;
            }
            .user_nav {
                display: flex;
                list-style: none;
                line-height: 50px;
            }
            .user_nav li {
                width: 100px;
                text-align: center;
                color: red;
            }
            #remake {
                width: 400px;
                height: 500px;
                background: #ccc;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: 10;
                display: none;
            }

            #remake textarea {
                width: 100%;
                height: 100%;
            }

            #bg {
                width: 100%;
                height: 100%;
                position: fixed;
                left: 0;
                top: 0;
                overflow: hidden;
                background: rgba(0, 0, 0, .7);
                display: none;
            }
            span {
                cursor: pointer;
            }
        </style>
        <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    </head>
    <body>
        <ul class="user_nav">
            <li><a href="<?php echo U('Index/index');?>" >用户数据</a></li>
            <li><a href="<?php echo U('Index/index2');?>">跟踪</a></li>
            <li><a href="<?php echo U('Index/index3');?>">预约列表</a></li>
        </ul>
        <h1>用户数据</h1>
        <table>
            <tr>
                <td>id</td>
                <td>姓名</td>
                <td>村</td>
                <td>小区</td>
                <td>手机号</td>
                <td width="20%">操作</td>
            </tr>

            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($data["rf_id"]); ?></td>
                    <td><?php echo ($data["zf_lxr"]); ?></td>
                    <td><?php echo ($data["rf_c"]); ?></td>
                    <td>小区</td>
                    <td><?php echo ($data["zf_lxdh"]); ?></td>
                    <td width="20%"><span onclick="sendSms()">发送</span>&nbsp;&nbsp;<span onclick="setBj()">标记</span>&nbsp;&nbsp;<span onclick="addRemake()">备注</span>&nbsp;&nbsp;<span onclick="setYX()">有效</span></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>


        <div id="remake">
            <textarea></textarea>
        </div>

        <div id="bg">

        </div>

        <div class="next-page">下一页</div>

    <script>
        function addRemake() {
            $("#bg").fadeIn()
            $("#remake").fadeIn()
        }

        function setBj() {

        }

        function sendSms() {

        }

        function setYX() {
            
        }


        window.onload = function () {
            document.getElementById("bg").onclick = function () {
                $("#bg").fadeOut()
                $("#remake").fadeOut()
            }
        }
    </script>
    </body>
</html>