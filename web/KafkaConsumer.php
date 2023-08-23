<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

require_once __DIR__ . '/../vendor/autoload.php';

class KafkaConsumer
{
    public function consume()
    {
        $connectionFactory = new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => 'crm',
                'metadata.broker.list' => 'kafka',
                'enable.auto.commit' => 'false',
            ],
            'topic' => [
                'auto.offset.reset' => 'beginning',
            ]
        ]);

        $context = $connectionFactory->createContext();

        $infoQueue = $context->createQueue('info');

        $consumer = $context->createConsumer($infoQueue);

        while (true) {
            $message = $consumer->receive();

            if ($message) {
                #output message
                echo $message->getBody() . PHP_EOL;

                $consumer->acknowledge($message);
            }
        }
    }
}

$consumer = new KafkaConsumer();
$consumer->consume();
