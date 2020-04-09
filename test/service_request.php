<?php

include_once '../vendor/autoload.php';

$sv = \ServiceFactory\ServiceFactory::NewService(\ServiceFactory\Etcd\ServiceFactoryEtcd::class);
$ev = new Event();
$ev->setId(1);
$ev->setTimestamp(time());
$ev->setMessage("hello");

$re = $sv->Service("com.vaptu.sms")->AgentAddress();
print_r($re);
