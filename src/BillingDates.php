<?php

namespace BillingDates;

class Calculator {
    public function calculateMonthlyCycle(\DateTime $billingStartDate, $currentDateTime = null) {
        if ($currentDateTime) {
            $now = \DateTimeImmutable::createFromMutable($currentDateTime);
        } else {
            $now = new \DateTimeImmutable;
        }

        $prevMonth = $now->modify('first day of -1 month');
        $nextMonth = $now->modify('first day of +1 month');

        $billingStartDateDayOfMonth = (int) $billingStartDate->format('j');
        $currentDateOfMonth = (int) $now->format('j');

        $start = null;
        $end = null;
        if ($currentDateOfMonth <= $billingStartDateDayOfMonth) {
            //meaning it's prev cycle
            $start = $prevMonth->modify('+' . $billingStartDateDayOfMonth. ' day')->modify('-1 day');

            $lastDayOfThisMonth = (int) $now->modify('last day of this month')->format('j');

            if ($lastDayOfThisMonth < (int) $start->format('j')) {
                //meaning current month has less days than prev month, so pick
                //last day of current month
                $end = $now->modify('last day of this month');
            } else {
                $end = $now->modify('first day of this month')->modify('+' . $billingStartDateDayOfMonth. ' day')->modify('-1 day');
            }
        } else {
            //meaning it's next cycle
            $start = $now->format('Y-m-') . $billingStartDateDayOfMonth;
            $end = $nextMonth->format('Y-m-') . $billingStartDateDayOfMonth;
        }

        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}
