# php-billingdates
Generates start and end date for a billing cycle in PHP.

## Example usage
```
<?php
use BillingDates\Calculator;

$calculator = new Calculator;

$startBillingDate = \DateTime::createFromFormat($defaultFormat, '2019-01-15');
$stubCurrentDate = \DateTime::createFromFormat($defaultFormat, '2019-03-10');

$data = $calculator->calculateMonthlyCycle($startBillingDate, $stubCurrentDate);

echo $data['start']->format('Y-m-d') . PHP_EOL;
echo $data['end']->format('Y-m-d') . PHP_EOL;
```
outputs

```
2019-02-15
2019-03-15
```
