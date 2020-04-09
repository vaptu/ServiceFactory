<?php


interface BrokerFactoryInterface
{
    public function Publish(string $topic, \Google\Protobuf\Internal\Message $message);
}