<?php

namespace ServiceFactory\Etcd;

use LinkORB\Component\Etcd\Client;
use ServiceFactory\Exception\ServiceFactoryException;
use ServiceFactory\ServiceFactoryInterface;

const GO_MICRO_SERVICE_PREFIX = "/micro/registry/";

class ServiceFactoryEtcd implements ServiceFactoryInterface
{
    protected $service = null;

    protected $version = null;

    protected $client = null;

    /**
     * ServiceFactoryEtcd constructor.
     *
     * @param $host
     * @param $port
     */
    public function __construct($host = null, $port = null){
        $host = $host ?? "127.0.0.1";
        $port = $port ?? "2379";

        $this->client = new \Etcd\Client(sprintf("%s:%s", $host, $port), "v3");
    }

    public function Service(string $service_name, $filter = []){
        $response = $this->client->getKeysWithPrefix(GO_MICRO_SERVICE_PREFIX . $service_name);
        if(!isset($response['kvs'])){
            throw new ServiceFactoryException("service not found", 1);
        }

        $services = $response['kvs'];
        foreach($services as $key => $value){
            $service_config = json_decode($value['value']);
            foreach($service_config->nodes as $val){
                $this->service = $val;
                break;
            }
        }

        if($this->service === null){
            throw new ServiceFactoryException("service not found", 1);
        }

        return $this;
    }

    public function AgentAddress(){
        if($this->service === null){
            throw new ServiceFactoryException("service not initialize", 2);
        }

        return $this->service->address;
    }
}
