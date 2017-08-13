<?php
if(!defined('InEmpireCMS'))
{
  exit();
}
$login = is_userlogin();

$totalquery="select count(*) as total from {$dbtbpre}follows where `f_user` ='".$userid."'";
$followNum=$empire->gettotal($totalquery);

$fansTotalquery="select count(*) as total from {$dbtbpre}follows where `s_user` ='".$userid."'";
$fansNum=$empire->gettotal($fansTotalquery);
//判断是不是用户自己
if($login['userid'] == $userid){
  $myid = true;
}else{
  $myid = false;
}
$nameValue = $myid == true?'我':'TA';
//判断是不是已关注对象
 $folSql = "SELECT count(*) AS total FROM {$dbtbpre}follows WHERE `f_user` = '".$login['userid']."' AND `s_user` = '".$userid."'";
 $fNum = $empire->gettotal($folSql);
 
 if($fNum == 1){//页面变量
    $folBol = 1;
 }else{
    $folBol = 0;
 }
$app = array();
// 获取用户资料
$userquery = $empire->query("select username,email,groupid,userfen,zgroupid,checked,registertime,userpic from ".eReturnMemberTable()." as t1 left join {$dbtbpre}enewsmemberadd as t2 on t1.userid = t2.userid where t1.".egetmf('userid')."='$userid'");
$userprofile =  json_encode(mysql_fetch_assoc($userquery));

// 获取用户订阅标签信息
$user_tag_sub = $empire->query("select * from {$dbtbpre}enewstags as t1 left join {$dbtbpre}tag_subscribe as t2 on t1.tagid = t2.tag_id where t2.userid ='$userid'");
while($r = mysql_fetch_assoc($user_tag_sub)){
   $app['tags_subscribe'][] = $r;
}

// 获取用户粉丝
$user_fan_sql = $empire->query("select username,email from {$dbtbpre}enewsmember as t1 left join {$dbtbpre}follows as t2 on t1.userid = t2.s_user where t2.s_user ='$userid'");
while($r = mysql_fetch_assoc($user_fan_sql)){
   $app['fans'][] = $r;
}

// 获取用户关注
$user_fol_sql = $empire->query("select username,email from {$dbtbpre}enewsmember as t1 left join {$dbtbpre}follows as t2 on t1.userid = t2.s_user where t2.f_user ='$userid'");
while($r = mysql_fetch_assoc($user_fol_sql)){
   $app['follower'][] = $r;
}

// 获取用户专辑信息_收藏信息
$user_album_favorite = $empire->query("select * from {$dbtbpre}album_favorite as t1 left join {$dbtbpre}album_info as t2 on t1.aid = t2.aid where t1.userid ='$userid'");
while($r = mysql_fetch_assoc($user_album_favorite)){
   $app['album']['favorite'][] = $r;
}
// 获取用户专辑信息_创建信息
$user_album_create = $empire->query("select * from {$dbtbpre}album_info where userid ='$userid'");
while($r = mysql_fetch_assoc($user_album_create)){
   $app['album']['create'][] = $r;
}

//获取用户图片--收藏
$fava = $empire->query("select * from {$dbtbpre}enewsfava where `userid` = '".$userid."' order by favatime desc");
while($r = mysql_fetch_assoc($fava)){
   $app['photo']['fava'][] = $r;
}

//获取用户图片--发布
$user_pub = $empire->query("select * from {$dbtbpre}ecms_photo where `userid` = '".$userid."' order by id desc");
while($r = mysql_fetch_assoc($user_pub)){
   $app['photo']['public'][] = $r;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>个人主页 - 热热兔</title>
  <link rel="stylesheet" href="/dist/css/index.css">
  <link rel="stylesheet" href="/dist/css/personal.css">
  <script src="/dist/jq.js" type="text/javascript"></script>
  <script src="/dist/index.js" type="text/javascript"></script>
</head>
<script>
  var app = app || {};
  app['hasfollow'] = <?=$folBol;?>;
  app['userprofile'] = <?=$userprofile;?>;
  app = <?=json_encode($app)?>
</script>
<body>
<div class="headWrap">
<header class="cl">
      <div class="logo-nav fl">
        <a href="/"  class="logo">热热兔</a>
        <nav>
          <a href="/">首页</a>
          <a href="/add/">上传图片</a>
          <a href="/">用户排名</a>
          <a href="/download/">APP下载</a>
        </nav>
      </div>
      <div class="login-search fr">
        <div class="search-part">
          <div class="search-wrap">
          <form action="/e/search/index.php" method="post">
            <input type="hidden" name="classid" value="32">
            <input type="hidden" name="show" value="title">
            <input type="text" id="search" name="keyboard">
            <i class="search-ico"></i>
          </form>
          </div>
        </div>
    <div class="loginWrap">
<!--login-start-->
<?php

if(empty($login)){
?>
        <div class="login-register fr">
          <a href="javascript:;" class="login">登陆</a>
          <span></span>
          <a href="javascript:;" class="register">注册</a>
        </div>
<?
}else{
  $hsMsg = $login['havemsg'] == 1 ? true:false;
?>
<div class="logined">
  <img src="<?=$login['userpic']?>" width="30" height="30" class="logined-userhd">
  <span><?=$login['username']?></span>
  <i class="logined-rotate"></i>
        <div class="logined-list">
    <ul>
      <li><a href="/user/<?=$login['userid']?>"><i class="u-page"></i>个人主页</a></li>
      <li><a href="/e/member/EditInfo/"><i class="u-setting"></i>修改资料</a></li>
      <li><a href="/e/member/msg/" class="<?= $hsMsg = $hsMsg ? 'newTip': '';?>"><i class="u-msg"></i>消息通知</a></li>
      <li><a href="/e/member/doaction.php?enews=exit"><i class="u-exit"></i>退出登录</a></li>
    </ul>
  </div>
</div>
<script>
var timestamp = "<?=time();?>";
var userid = "<?=$login['userid']?>";
var vertify = "<?=md5('nr99s_salt'.time())?>";
 var classid = 32;
</script>
<?
}
?>
<!--login-end-->
</div>
      </div>
    </header>
</div>
<div class="fillBox"></div>
       <div class="tags hide">
      <a href="">推荐</a>
      <?
  $tagsGood = $empire->query("select tagid,tagname from {$dbtbpre}enewstags where isgood=1");
  while($tags= mysql_fetch_array($tagsGood )) {
?>
     <a href="/e/tags/?tagname=<?=$tags['tagname']?>" data-id="<?=$tags['tagid']?>"><?=$tags['tagname']?></a>
<?
  }
?>
    </div>