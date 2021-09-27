# laravel-printer-cloud-sdk

适用于 laravel 的云打印机

## 安装

```shell
composer require puzzle9/laravel-printer-cloud-sdk -vvv
php artisan vendor:publish --tag=laravel-printersdk
```

### 使用

#### 飞鸽云 <https://admin.feieyun.com/index.php>

```php
$print = \Puzzle9\PrinterCloudSdk\PrinterCloudSdk::feieyun();
$print->printAdd('sn', 'key');
$print->printDel('sn');
$print->printStatus('sn');
$print->printTxt('sn', 'content');
$print->printCleanAll('sn');
$print->orderStatus('order_id');
```
