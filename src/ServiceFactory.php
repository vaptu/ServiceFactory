<?php

namespace ServiceFactory;

use ServiceFactory\Etcd\ServiceFactoryEtcd;
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
    static public function NewService(string $registry_class_name, $host = null, $port = null){
        if($registry_class_name === ServiceFactoryEtcd::class){
            return new ServiceFactoryEtcd($host, $port);
        }else if($registry_class_name === ServiceFactoryConsul::class){
            return new ServiceFactoryConsul($host, $port);
        }

        throw ServiceFactoryException("registry not support", 3);
    }
}
