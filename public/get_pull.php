<?php
/**
 * alltosun.com 主页面 get_pull.php
 * ============================================================================
 * 版权所有 (C) 2009-2018 北京互动阳光科技有限公司，并保留所有权利。
 * 网站地址: http://www.alltosun.com
 * ----------------------------------------------------------------------------
 * 许可声明：这是一个开源程序，未经许可不得将本软件的整体或任何部分用于商业用途及再发布。
 * ============================================================================
 * $Author: 赵高举 (zhaogj@alltosun.com) $
 * $Date: 2018/10/26 18:19 $
 * $Id$
 */
   // 与webhook配置相同，为了安全，请设置此参数
   $secret = "loveyou";
   // 项目路径
   $secret = "loveyou";
   // 项目路径
   $path = "/home/wwwroot/myBlog";
   // 校验发送位置，正确的情况下自动拉取代码，实现自动部署
   //echo '<pre>';
   //var_dump($_SERVER);
   //echo '</pre>';
  $param = $_POST['payload'];
  $payload = json_decode($param, true);
  $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
  if ($signature) {
      $hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
      if (strcmp($signature, $hash) !== 0) {
          exit('token is error');
      }
      $branch = explode('/', $payload['ref'])[2];
      if ($branch == 'master') {
          echo shell_exec("cd {$path} && git pull origin master 2>&1");
      } else {
          echo 'is not master';
          exit();
      }
  }
