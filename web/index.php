<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

require_once 'web/KafkaProducer.php';
$producer = new KafkaProducer();
$producer->send();