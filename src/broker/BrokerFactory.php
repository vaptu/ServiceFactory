<?php


class BrokerFactory
{

    /**
     * @param string $broker_class_name
     * @param null   $host
     * @param null   $port
     *
     * @return BrokerFactoryNsq
     * @throws \ServiceFactory\Exception\BrokerFactoryException
     */
    static public function NewBroker(string $broker_class_name, $host = null, $port = null){
        if($broker_class_name === BrokerFactoryNsq::class){
            return new BrokerFactoryNsq($host, $port);
        }

        throw new \ServiceFactory\Exception\BrokerFactoryException(1, "broker not support");
    }
}