<?php

include_once '../vendor/autoload.php';

use Consul\ServiceFactory\ServiceFactory;

$sf = new \ServiceFactory\Consul\ServiceFactoryConsul();
print_r($sf->Service('com.zhigui.xian.sms.aliyun'));
