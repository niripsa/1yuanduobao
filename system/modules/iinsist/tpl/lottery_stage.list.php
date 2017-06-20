<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css" />
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header lr10">
    <?php echo headerment( $ment ); ?>
    <span class="lr10"> </span><span class="lr10"> </span>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
        <tr>
            <th align="center">期号</th>
            <th align="center">开奖号码</th>
            <th align="center">后台设置中奖号码</th>
            <th align="center">本期开始时间</th>
            <th align="center">本期结束时间</th>
            <th align="center">当前状态</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ( (array)$recordlist as $v ) { ?>
        <tr>
            <td align="center"> 
                <?php echo $v['stage_no']; ?> 
            </td>
            <td align="center">
                <?php echo $v['lottery_number']; ?> 
            </td>
            <td align="center"> 
                <?php echo $v['setting_number']; ?> 
            </td>
            <td align="center">
                <?php echo $v['begin_time'];?>
            </td>
            <td align="center">
                <?php echo $v["end_time"]; ?>
            </td>
            <td align="center">
                <?php if($v["status"] == 2){ ?>
                    已开奖
                <?}else{?>
                    开奖中
                <? };?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div id="pages"><ul>共 <?php echo $page; ?> </ul></div>
</div>
</body>
</html>