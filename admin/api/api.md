登录判断接口：api/doLogin.php
参数：
    email
    password
返回：
    json

    {"code":"10000","msg": "ok"}
    或者
    {"code":"10001","msg": "fail"}

##保存session接口：
type:get
url:api/doSession.php
参数：无
返回：
    json

    {"code":"10000","msg": "ok"}
    或者
    {"code":"10001","msg": "fail"}


## 获取当前登录的用户信息接口
type:get
url:api/getUserInfo.php
data:没有
响应体：
    JSON
    { "id":1,"slug":"admin",...... }


## 获取网站统计数据的接口
type:get
url:api/getWebInfo.php
data:没有
响应体：
    JSON
    {wenzhang:700  caogao:210  fenlei:4  pinglun:400  daishenhe:83}

## 添加分类
type:post
url:api/doAddFenLei.php
data:
    name
    slug
响应体：
     {"code":"10000","msg": "ok"}
    或者
    {"code":"10001","msg": "fail"}

## 显示分类
type:get
url:api/doFenLei.php
data:无
响应体
    json
    {"name":"未分类"，...}

## 显示所有文章
type:get
url:api/doPosts.php
data:
    pageIndex:页码
    pageSize:页容量
响应体
    json
    {"title":"世界，你好",....}

## 显示所有评论
type:get
url:api/getComment.php
data
    pageIndex:页码
    pageSize:页容量
响应体
    json
    [data:{"":"",...},totalPage]

## 操作评论
type:post
url:api/editComment.php
data:
    status:显示状态
    id
响应体：
    json
    {"code":"10000","msg": "ok"}
    或者
    {"code":"10001","msg": "fail"}