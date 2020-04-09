<?php

namespace ServiceFactory;

interface ServiceFactoryInterface
{
    public function Service(string $service_name, $filter = []);

    public function AgentAddress();
}
