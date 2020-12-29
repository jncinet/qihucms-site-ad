<h1 align="center">站内广告管理</h1>

## 安装

```shell
$ composer require jncinet/qihucms-site-ad
```

## 使用
### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\SiteAd\SiteAdServiceProvider"
```

### 后台菜单
+ 广告套餐：site-ad/packages
+ 广告订单：site-ad/ads
+ 广告订单记录：site-ad/logs

### 创建广告方法
在需要添加广告的模型中添加一对一多态关联来获取广告
```shell
public function site_ads()
{
    return $this->morphOne('Qihucms\SiteAd\Models\SiteAd', 'moduleable');
}
```

## 接口
### 广告套餐列表
+ 请求方法 GET
+ 请求地址 site-ad/packages
+ 返回值
```
[
    {
        'id': 1,
        'name': "套餐名称",
        'desc': "套餐介绍",
        'count': 1, // 时长｜次数
        'unit': "单位",
        'amount': 1.00, // 价格
        'currency_type': {货币详细信息},
    },
    ...
]
```

### 广告套餐详细
+ 请求方法 GET
+ 请求地址 site-ad/packages/{id=套餐ID}
+ 返回值
```
{
    'id': 1,
    'name': "套餐名称",
    'desc': "套餐介绍",
    'count': 1, // 时长｜次数
    'unit': "单位",
    'amount': 1.00, // 价格
    'currency_type': {货币详细信息},
}
```

### 广告订单日志列表
+ 请求方法 GET
+ 请求地址 site-ad/logs?id=2广告订单ID&limit=15每页条数，选填&page=1页码，选填
+ 返回值
```
{
    "data": [
        {
            'id': 1,
            'site_ad_id': 2, // 广告订单ID
            'user_id': {会员信息},
            'ip': "ip",
            'province': "省",
            'city': "市",
            'district': "区",
            'device': "设备"
            'browse': "浏览器",
            'system': "系统",
            'net_type': "网络",
            'created_at': "2秒前"
        },
        ...
    ],
    "meta": {},
    "links": {},
}
```

### 广告订单日志详细
+ 请求方法 GET
+ 请求地址 site-ad/logs?id=2广告订单ID&limit=15每页条数，选填&page=1页码，选填
+ 返回值
```
{
    'id': 1,
    'site_ad_id': 2, // 广告订单ID
    'user_id': {会员信息},
    'ip': "ip",
    'province': "省",
    'city': "市",
    'district': "区",
    'device': "设备"
    'browse': "浏览器",
    'system': "系统",
    'net_type': "网络",
    'created_at': "2秒前"
}
```

### 广告订单日志创建
+ 请求方法 POST
+ 请求地址 site-ad/logs
+ 请求参数：
```
{
    'site_ad_id': 1, // 广告订单ID
    'province', // 省
    'city', // 市
    'district', // 区
    'device', // 设备
    'browse', // 浏览器
    'system', // 系统
    'net_type' // 网络
}
```
+ 返回值
```
{
    'id': 1,
    'site_ad_id': 2, // 广告订单ID
    'user_id': {会员信息},
    'ip': "ip",
    'province': "省",
    'city': "市",
    'district': "区",
    'device': "设备"
    'browse': "浏览器",
    'system': "系统",
    'net_type': "网络",
    'created_at': "2秒前"
}
```

## 数据库
### 广告套餐表：site_ad_packages
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| currency_type_id  | bigint    |           |           |           | 支付类型ID |
| name              | varchar   | 255       |           |           | 分类名称   |
| desc              | varchar   | 255       | Y         | NULL      | 套餐介绍   |
| count             | int       |           |           | 1         | 次数|时长  |
| unit              | tinyint   |           |           | 0         | 计算单位    |
| amount            | decimal   | 8,2       |           | 0.00      | 价格       |
| status            | tinyint   |           |           | 1         | 套餐状态    |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |

### 广告订单表：site_ads
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| site_ad_package_id| bigint    |           |           |           | 选择套餐   |
| user_id           | bigint    |           |           |           | 会员ID    |
| moduleable_id     | bigint    |           |           |           |           |
| moduleable_type   | varchar   | 255       |           |           |           |
| start_time        | timestamp |           | Y         | NULL      | 开始时间   |
| end_time          | timestamp |           | Y         | NULL      | 结束时间   |
| uv                | int       |           |           | 0         | 点击数     |
| pv                | int       |           |           | 0         | 展现数     |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |

### 广告订单日志表：site_ad_logs
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| id                | bigint    |           |           |           |           |
| site_ad_id        | bigint    |           |           |           | 选择套餐   |
| user_id           | bigint    |           |           |           | 会员ID    |
| ip                | varchar   | 45        | Y         | NULL      | IP        |
| province          | varchar   | 55        | Y         | NULL      | 省        |
| city              | varchar   | 55        | Y         | NULL      | 市        |
| district          | varchar   | 55        | Y         | NULL      | 区        |
| device            | varchar   | 55        | Y         | NULL      | 设备      |
| browse            | varchar   | 55        | Y         | NULL      | 浏览器     |
| system            | varchar   | 55        | Y         | NULL      | 系统       |
| net_type          | varchar   | 10        | Y         | NULL      | 网络       |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |
