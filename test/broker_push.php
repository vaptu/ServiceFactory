<?php

include_once '../vendor/autoload.php';

$br = BrokerFactory::NewBroker(BrokerFactoryNsq::class);
$ev = new Event();
$ev->setId(1);
$ev->setTimestamp(time());
$ev->setMessage("hello");
$br->Publish("com.vaptu.queue", $ev);
