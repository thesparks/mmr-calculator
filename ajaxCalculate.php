<?php

require_once __DIR__ . '/autoload.php';

use Classes\MMRCalculator;
use Classes\MMRPriceList;
use Type\TMMRValue;
use Type\TMMRPriceValue;

$list = new MMRPriceList();

$list->add(
    new TMMRValue(2500),
    new TMMRPriceValue(1)
);

$list->add(
    new TMMRValue(3500),
    new TMMRPriceValue(3)
);

$list->add(
    new TMMRValue(5500),
    new TMMRPriceValue(5)
);

$list->add(
    new TMMRValue(7000),
    new TMMRPriceValue(10)
);

$calculator = new MMRCalculator($list);

$price = $calculator->calculate(
    new TMMRValue((int)$_REQUEST['startMMR']),
    new TMMRValue((int)$_REQUEST['endMMR'])
);

echo json_encode(['price' => $price]);