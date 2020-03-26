<?php

namespace ServiceFactory;

abstract class ServiceFactoryInterface
{
    public function __construct(){
    }

    abstract public function Service(string $service_name, $filter = []);

    abstract public function AgentAddress();
}
