# PMO-3789短query未下单用户返利实验需求

## 链接

### jira
[http://jira.17gwx.com/browse/PMO-3789](http://jira.17gwx.com/browse/PMO-3789)

### prd
[http://prd.17gwx.com/Growth/返利实验需求_杨杨/#g=1&p=返利实验](http://prd.17gwx.com/Growth/返利实验需求_杨杨/#g=1&p=返利实验)

### 蓝湖
IOS [https://lanhuapp.com/url/yt4Tw-ystqa](https://lanhuapp.com/url/yt4Tw-ystqa)

Android [https://lanhuapp.com/url/ifLwN-kYtf3](https://lanhuapp.com/url/ifLwN-kYtf3)


## 功能块

### 返利
返利需求依赖[PMO-3794返利需求第三期](http://prd.17gwx.com/Growth/%E5%9F%BA%E7%A1%80%E8%BF%94V6/#g=1&p=%E5%9F%BA%E7%A1%80%E8%BF%94%E5%90%8E%E5%8F%B0v6)

### 新人专享标示
服务端在接口中加入`user_has_order`字段，来标记用户是否下过单

客户端根据服务端返回的`user_has_order`来决定是否展示新人专享标示

>这里的是否下过单指的是uid和device_id都未下过单的用户

#### 影响到的接口
|名称|接口及文档|其他|
|:--|:--|:--|
|首页feed|[/v2/index/topic](http://doc.17gwx.com/sqkb-api-v2/#%E9%A6%96%E9%A1%B5%E5%88%97%E8%A1%A8)||
|主搜|[/v2/search/coupon/listByWord](http://doc.17gwx.com/sqkb-api-v2/#%E4%B8%BB%E6%90%9C)|`coupon_list`和`rec_coupon_list`都有|
|弹窗搜索|[/v2/search/popSearch/listByWord](http://doc.17gwx.com/sqkb-api-v2/#%E5%BC%B9%E7%AA%97%E6%90%9C%E7%B4%A2)||
