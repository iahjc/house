<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>预约列表</title>
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
        .user_nav li a {
            color:  red;
        }
        .search {
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<ul class="user_nav">
    <li><a href="<?php echo U('Index/index');?>" >用户数据</a></li>
    <li><a href="<?php echo U('Index/index2');?>">跟踪</a></li>
    <li><a href="<?php echo U('Index/index3');?>">预约列表</a></li>
</ul>
<h1>预约列表</h1>
<div class="search">
    手机号/id/姓名：<input type="text" value="" placeholder="手机号/id/姓名"/> &nbsp;&nbsp;<span>搜索</span>
</div>
<table>
    <tr>
        <td>id</td>
        <td>姓名</td>
        <td>村</td>
        <td>小区</td>
        <td>手机号</td>
        <td>跟踪人</td>
        <td>沟通次数</td>
        <td width="20%">操作</td>
    </tr>

    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($data["rf_id"]); ?></td>
            <td><?php echo ($data["zf_lxr"]); ?></td>
            <td><?php echo ($data["rf_c"]); ?></td>
            <td>小区</td>
            <td><?php echo ($data["zf_lxdh"]); ?></td>
            <td>小明</td>
            <td>10</td>
            <td width="20%"><span>详情</span>&nbsp;&nbsp;<span>编辑备注</span></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

<div class="next-page">下一页</div>
</body>
</html>