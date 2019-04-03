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
require_once "./admin/tools/phpTools.php";

$sql="select p.id,p.title,u.nickname,c.name,p.views,p.feature,p.likes,p.content,p.created from
posts p inner join users u on p.user_id = u.id 
inner join categories c on p.category_id = c.id  where 
p.status = 'published' and p.id=$id";

$posts=mysqli_select($sql)[0];

//查询评论
$commtentSql="select * from comments where post_id=$id and status='approved'";
$commentCount=count(mysqli_select($commtentSql));

//查看后阅读量加1
$views=$posts['views'] +1;

$viewsql="update posts set views=$views where id=$id";
mysqli_Excute($viewsql);

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
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $posts['name'] ?></a></dd>
            <dd><?php echo $posts['title'] ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $posts['title'] ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $posts['nickname'] ?> 发布于 <?php echo $posts['created'] ?></span>
          <span>分类: <a href="javascript:;"><?php echo $posts['name'] ?></a></span>
          <span>阅读: (<?php echo $views ?>)</span>
          <span>评论: (<?php echo $commentCount ?>)</span>
        </div>
        <div><?php echo $posts['content'] ?></div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
        <?php
          $hotsql="select id,title,feature,views,likes from posts where status='published' order by views desc limit 5";
          $hotPosts=mysqli_select($hotsql);
         for ($i=0; $i <4 ; $i++) :
         ?>
          <li>
            <a href="detail.php?id=<?php echo $hotPosts[$i]['id'] ?>">
              <img src="<?php echo $hotPosts[$i]['feature'] ?>" alt="">
              <span><?php echo $hotPosts[$i]['title'] ?></span>
            </a>
          </li>
            <?php endfor;?>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
<!-- <script src="assets/vendors/jquery/jquery.js"></script>
<script src='admin/tools/template-web.js'></script>
<script type='text/html' id='list3'>
  {{each list3 value}}
  <div class="breadcrumb">
      <dl>
        <dt>当前位置：</dt>
        <dd><a href="javascript:;">{{value.name}}</a></dd>
        <dd>{{value.title}}</dd>
      </dl>
    </div>
    <h2 class="title">
      <a href="javascript:;">{{value.title}}</a>
    </h2>
    <div class="meta">
      <span>{{value.nickname}} 发布于 {{value.created}}</span>
      <span>分类: <a href="javascript:;">{{value.name}}</a></span>
      <span>阅读: ({{value.views}})</span>
      <span>评论: (143)</span>
    </div>
    <div>{{value.content}}</div>
    {{/each}}
</script>
<script type='text/html' id='list'>
  {{each list value}}
    <li>
      <a href="javascript:;">
        <p class="title">{{value.title}}</p>
        <p class="reading">阅读({{value.views}})</p>
        <div class="pic">
          <img src="{{value.feature}}" alt="">
        </div>
      </a>
    </li>
  {{/each}}
</script>
<script type='text/html' id='list2'>
  {{each list2 value}}
  <li>
      <a href="javascript:;">
        <div class="avatar">
          <img src="uploads/avatar_1.jpg" alt="">
        </div>
        <div class="txt">
          <p>
            <span>{{value.author}}</span>{{value.created}}说:
          </p>
          <p>{{value.content}}</p>
        </div>
      </a>
    </li>
  {{/each}}
</script>
<script>
  var url=location.href;
  id=url.substr(url.indexOf('=')+1);
  
  
  $.get({
    url:'getPostsId.php',
    data:{id:id},
    dataType:'json',
    success:function(obj){

      
      var li=template('list3',{list3:obj});
        $('.article').html(li);
    }
  })

  $.get({
      url:'admin/api/getCategories.php',
      dataType:'json',
      success:function(obj){
  
        
        var str="";
        for(var i=0;i<obj.length;i++){
          str+='<li><a href="list.html?categoryId='+obj[i].id+'"><i class="fa fa-glass"></i>'+obj[i].name+'</a></li>';
        }
        $('.nav').html(str);
      }
    })

    $.get({
      url:'sjposts.php',
      dataType:'json',
      success:function(obj){
        console.log(obj);
        
        var li=template('list',{list:obj});
        $('.random').html(li);
      }
    })

    $.get({
      url:'getComment.php',
      dataType:'json',
      success:function(obj){
        console.log(obj);
        
        var li=template('list2',{list2:obj});
        $('.discuz').html(li);
      }
    })
</script> -->
</html>
