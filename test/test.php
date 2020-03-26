<?php

include_once '../vendor/autoload.php';

$sf = new \ServiceFactory\Etcd\ServiceFactoryEtcd();
print_r($sf->Service('com.zhigui.xian.sms.aliyun')->AgentAddress());
