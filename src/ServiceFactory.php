<?php

namespace ServiceFactory;

use ServiceFactory\Exception\ServiceFactoryException;
use ServiceFactory\Consul\ServiceFactoryConsul;

class ServiceFactory
{
    /**
     * ServiceFactory constructor.
     *
     * @param string $registry
     *
     * @throws ServiceFactoryException
     */
    public function __construct(string $registry){
        if($registry === "consul"){
            return new ServiceFactoryConsul();
        }

        throw ServiceFactoryException("registry not support", 3);
    }
}
