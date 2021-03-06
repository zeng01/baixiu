<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
  <style>
    .txt {
      white-space: nowrap;/*让文本强制一行显示*/
    }
  </style>
</head>
<body>
<?php 

    $id=$_GET['id'];
    $name=$_GET['name'];

    require_once 'admin/tools/phpTools.php';

    $sql="select p.id,p.title,u.nickname,c.name,p.views,p.feature,p.likes,p.content,p.created from
          posts p inner join users u on p.user_id = u.id 
          inner join categories c on p.category_id = c.id 
          where p.status = 'published' and p.category_id=$id order by p.id desc limit 5";

    $posts=mysqli_select($sql);
          
?>
  <div class="wrapper">
    <div class="topnav">
      <ul>
      <?php 
          $categorysql="select * from categories";
          $category=mysqli_select($categorysql);

          $calssArr=Array('fa-glass','fa-phone','fa-fire','fa-gift','fa-hot','fa-shopping','fa-gift','fa-gift');
          ?>
          <?php
          foreach ($category as $key => $value) :
        ?>
        <li><a href="list.php?id=<?php echo $value['id']?>&name=<?php echo $value['name']?>"><i class="fa <?php echo $calssArr[$key]?>"></i><?php echo $value['name']?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php
          foreach ($category as $key => $value) :
        ?>
        <li><a href="list.php?id=<?php echo $value['id']?>&name=<?php echo $value['name']?>"><i class="fa <?php echo $calssArr[$key]?>"></i><?php echo $value['name']?></a></li>
        <?php endforeach ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
        <?php 
            //随机推荐
          $sql1="select id,title,views,feature from posts where status='published' order by rand() limit 5";
          $randPosts=mysqli_select($sql1);
          foreach ($randPosts as $value) : 
          ?>
          <li>
            <a href="detail.php?id=<?php echo $value['id'] ?>">
              <p class="title"><?php echo $value['title'] ?></p>
              <p class="reading">阅读(<?php echo $value['views'] ?>)</p>
              <div class="pic">
                <img src="<?php echo $value['feature'] ?>" alt="">
              </div>
            </a>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
        <?php
            $comSql="select id,author,created,content from comments where status='approved' order by id desc limit 6";
            $comment=mysqli_select($comSql);

            foreach ($comment as $key => $value) :
              
          ?>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span><?php echo $value['author'] ?></span><?php echo $value['created'] ?>说:
                </p>
                <p><?php echo $value['content'] ?></p>
              </div>
            </a>
          </li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $name ?></h3>
        <?php 
        foreach($posts as $value) :
          $commtentSql="select * from comments where post_id=".$value['id']." and status='approved'";
            $commentCount=count(mysqli_select($commtentSql));
          ?>
        <div class="entry">
          <div class="head">
            <a href="javascript:;"><?php echo $value['title'] ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname'] ?> 发表于 <?php echo $value['created'] ?></p>
            <p class="brief"><?php echo $value['content'] ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views'] ?>)</span>
              <span class="comment">评论(<?php echo $commentCount ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes'] ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $name ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $value['feature'] ?>" alt="">
            </a>
          </div>
        </div>
            <?php endforeach;?>
        
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
<script src="assets/vendors/jquery/jquery.js"></script>
<script src='admin/tools/template-web.js'></script>
<script>
window.onscrll
</script>
</html>
