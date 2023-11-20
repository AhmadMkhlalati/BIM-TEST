<?php

namespace App\Interfaces\Admin;

interface FinancialReportRepositoryInterface
{
    public function generateMonthlyReport($startDate, $endDate);
}
