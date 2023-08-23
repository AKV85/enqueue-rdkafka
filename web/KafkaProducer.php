<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

require_once __DIR__ . '/../vendor/autoload.php';

class KafkaProducer
{
    public function send(): void
    {
        try {
            $connectionFactory = new RdKafkaConnectionFactory([
                'global' => [
                    'group.id' => 'wms',
                    'metadata.broker.list' => 'kafka',
                    'enable.auto.commit' => 'false',
                ]
            ]);

            $context = $connectionFactory->createContext();

            $infoTopic = $context->createTopic('info');

            #example 1.

            $message = $context->createMessage("Hello Andersen's Team");
            $message->setKey('key-wms');
            $context->createProducer()->send($infoTopic, $message);

            #example 2.

//            $message = $context->createMessage("First Partition!");
//            $message->setKey('key-one');
//            $context->createProducer()->send($infoTopic, $message);
//
//            $message = $context->createMessage("Second Partition!");
//            $message->setKey('key-one');
//            $context->createProducer()->send($infoTopic, $message);

            #example 3.

//            for ($i = 0; $i <= 1000; $i++) {
//                $message = $context->createMessage($i . ') Hello, Team!');
//                $message->setKey('key-wms' . $i);
//                $context->createProducer()->send($infoTopic, $message);
//
//            }

            echo "Message sent successfully!";
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        } catch (\Interop\Queue\Exception $e) {
        }
    }
}

$producer = new KafkaProducer();
$producer->send();