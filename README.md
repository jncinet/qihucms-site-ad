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
| status            | tinyint   |           |           | 1         | 分类状态    |
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