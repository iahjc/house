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

            .addRemake {
                position: absolute;
                right: 0;
                top: 0;
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
                <td>沟通次数</td>
                <td width="20%">操作</td>
            </tr>

            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($data["rf_id"]); ?></td>
                    <td><?php echo ($data["zf_lxr"]); ?></td>
                    <td><?php echo ($data["rf_c"]); ?></td>
                    <td>小区</td>
                    <td><?php echo ($data["zf_lxdh"]); ?></td>
                    <td><?php echo ($data["contact"]); ?></td>
                    <td width="20%"><span onclick="sendSms()">发送</span>&nbsp;&nbsp;<span onclick="setBj(<?php echo ($data["rf_id"]); ?>, this)">标记</span>&nbsp;&nbsp;<span onclick="addRemake(<?php echo ($data["rf_id"]); ?>, this, '<?php echo ($data["remake"]); ?>')">备注</span>&nbsp;&nbsp;<span class="isValid" onclick="setYX(<?php echo ($data["rf_id"]); ?>, this, 1)">有效</span> <span class="isValid"  onclick="setYX(<?php echo ($data["rf_id"]); ?>, this, 0)">无效</span></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>


        <div id="remake">
            <textarea></textarea>
            <button class="addRemake">确定</button>
        </div>

        <div id="bg">

        </div>

        <div class="next-page">下一页</div>

    <script>
        function addRemake(uid, obj, remake) {
            $("#remake textarea").val("")
            $("#remake textarea").val(remake);
            $("#bg").fadeIn()
            $("#remake").fadeIn()
            $("#remake").attr("data-uid", uid);
        }

        /**
         * 确认添加备注
         */
        $(".addRemake").on("click", function () {

            var uid = $("#remake").attr("data-uid")
            var val = $("#remake textarea").val()

            $.ajax({
                type: "POST",
                url: "/index.php?s=/home/index/addRemake/id/"+uid+".html",
                data: "remake="+val,
                success: function(res) {
                    if(res == 1) {
                        alert("备注添加成功");
                        $("#bg").fadeOut()
                        $("#remake").fadeOut()
                    }
                }
            });
        });

        function setBj(data_id, obj) {
            $.ajax({
                type: "GET",
                url: "/index.php?s=/home/index/bj/id/"+data_id+".html",
                success: function(res) {
                    if(res == 1) {
                        alert("标注成功");
                        $(obj).text("已标注");
                        $(obj).css({
                           "color": "red"
                        });
                    }
                }
            });
        }

        function sendSms() {

        }

        function setYX(uid, obj, type) {
            $.ajax({
                type: "GET",
                url: "/index.php?s=/home/index/setValid/id/"+uid+".html",
                data: "isValid=" + type,
                success: function(res) {
                    if(res == 1) {
                        if(type == 0) {
                            alert("无效设置成功");
                        } else {
                            alert("有效设置成功")
                        }
                        $(obj).parent().find(".isValid").remove()
                    }
                }
            });
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