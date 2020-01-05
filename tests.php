<?php

namespace BillingDates;

include __DIR__ . '/BillingDates.php';

function run_tests() {
    $defaultFormat = 'Y-m-d';
    $calculator = new Calculator;

    $startBillingDate = \DateTime::createFromFormat($defaultFormat, '2019-01-15');
    $stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2019-03-10');
    $data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);
    assert($data['start']->format('Y-m-d') == '2019-02-15');
    assert($data['end']->format('Y-m-d') == '2019-03-15');

    $startBillingDate = \DateTime::createFromFormat($defaultFormat, '2020-01-31');
    $stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2020-02-10');
    $data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);
    assert($data['start']->format('Y-m-d') == '2020-01-31');
    assert($data['end']->format('Y-m-d') == '2020-02-29');

    $startBillingDate = \DateTime::createFromFormat($defaultFormat, '2020-02-29');
    $stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2020-03-10');
    $data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);
    assert($data['start']->format('Y-m-d') == '2020-02-29');
    assert($data['end']->format('Y-m-d') == '2020-03-29');

    $startBillingDate = \DateTime::createFromFormat($defaultFormat, '2020-03-31');
    $stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2020-04-25');
    $data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);
    assert($data['start']->format('Y-m-d') == '2020-03-31');
    assert($data['end']->format('Y-m-d') == '2020-04-30');

    $startBillingDate = \DateTime::createFromFormat($defaultFormat, '2020-01-31');
    $stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2020-02-25');
    $data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);
    assert($data['start']->format('Y-m-d') == '2020-01-31');
    assert($data['end']->format('Y-m-d') == '2020-02-29');
}

run_tests();

echo 'All tests passed. Yay!'. PHP_EOL;
