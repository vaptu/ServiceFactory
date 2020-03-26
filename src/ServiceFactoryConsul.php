<?php

namespace ServiceFactory\Consul;

use SensioLabs\Consul\ServiceFactory;
use ServiceFactory\ServiceFactoryInterface;

const SERVICE_STATUS_PASSING = "passing";

class ServiceFactoryConsul extends ServiceFactoryInterface
{
    protected $service = null;

    /**
     * @param string $service_name
     * @param array  $filter
     *
     * @return $this
     * @throws Throwable
     */
    public function Service(string $service_name, $filter = []){
        $sf = new ServiceFactory();
        $health = $sf->get('health');
        $services_body = $health->service($service_name);
        $services = json_decode($services_body->getBody());
        if(is_array($services)){
            foreach($services as $key => $value){
                if($value->Checks[0]->Status == SERVICE_STATUS_PASSING){
                    $this->service = $value;
                    break;
                }
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

        $address = $this->service->Service->Address;
        $port = $this->service->Service->Port;
        return "$address:$port";
    }
}
