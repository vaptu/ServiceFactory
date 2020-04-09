<?php


class BrokerFactoryNsq implements BrokerFactoryInterface
{
    protected $host;
    protected $port;

    function __construct($host, $port){
        $this->host = $host ?? "127.0.0.1";
        $this->port = $port ?? "4151";
    }

    public function Publish(string $topic, \Google\Protobuf\Internal\Message $message){
        $msg_data = [
            "Header" => [
                "Micro-From-Service" => "test",
                "Content-Type"       => "application/grpc+proto",
                "Micro-Topic"        => $topic,
            ],
            "Body"   => base64_encode($message->serializeToString()),
        ];

        $client = new GuzzleHttp\Client(['base_uri' => sprintf("http://%s:%s", $this->host, $this->port)]);
        $response = $client->request("POST", "/pub", [
            "query" => [
                "topic" => $topic,
            ],
            "json"  => $msg_data,
        ]);

        $re = $response->getBody();
        printf($re);
    }
}