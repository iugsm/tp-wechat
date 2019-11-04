TP-WeChat
===============

## 基于 ThinkPHP 6 的微信小程序鉴权系统

> 运行环境要求PHP7.1+。


## 安装

~~~
composer install
~~~

## 运行

```
php think run
```

## ThinkPHP 6 开发文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## 目录结构
```
tp-wechat
├─ app                          应用目录
│   ├─ api                      api 应用目录
│   │   ├─ config               api 应用配置目录
│   │   │    ├─ database.php    数据库配置文件（不建议提交到公开场合）
│   │   │    ├─ secure.php      JWT 配置（不建议提交到公开场合）
│   │   │    ├─ wechat.php      微信相关配置（不建议提交到公开场合）
│   │   ├─ controller           控制器目录
│   │   ├─ libs                 资源目录
│   │   │   ├─ exceptions       异常目录
│   │   ├─ model                模型目录
│   │   ├─ route                路由目录
│   │   ├─ service              service 目录
│   │   ├─ validate             验证器目录
│   ├─ ExceptionHandle.php      异常处理类
├─ config                       全局配置目录

```

## 使用说明
1. 请在 `database.php` 中填写数据库相关配置
2. 请在 `secure.php` 中填写 JWT 相关配置
3. 请在 `wechat.php` 中填写微信相关配置
4. 复杂业务建议抽象 `service` 层