<?php

namespace ServiceFactory\Consul;

use SensioLabs\Consul\ServiceFactory;
use ServiceFactory\Exception\ServiceFactoryException;
use ServiceFactory\ServiceFactoryInterface;

const SERVICE_STATUS_PASSING = "passing";

class ServiceFactoryConsul implements ServiceFactoryInterface
{
    protected $service = null;
    protected $client  = null;

    /**
     * ServiceFactoryConsul constructor.
     *
     * @param string $host
     */
    function __construct($host, $port){
        $host = $host ?? "127.0.0.1";
        $port = $port ?? "8500";

        $protocol = strpos(sprintf("%s:%s", $host, $port), "http");
        if($protocol === false || $protocol > 0){
            $host = "http://$host";
        }

        $this->client = new ServiceFactory(['base_uri' => $host]);
    }

    /**
     * @param string $service_name
     * @param array  $filter
     *
     * @return $this
     * @throws ServiceFactoryException
     */
    public function Service(string $service_name, $filter = []){
        $health = $this->client->get('health');
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

    /**
     * @return string
     * @throws ServiceFactoryException
     */
    public function AgentAddress(){
        if($this->service === null){
            throw new ServiceFactoryException("service not initialize", 2);
        }

        $address = $this->service->Service->Address;
        $port = $this->service->Service->Port;
        return "$address:$port";
    }
}
