<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\FinancialReportRepositoryInterface;

class FinancialReportService
{
    protected $financialReportRepository;

    public function __construct(FinancialReportRepositoryInterface $financialReportRepository)
    {
        $this->financialReportRepository = $financialReportRepository;
    }

    public function generateMonthlyReport($startDate, $endDate)
    {
        return $this->financialReportRepository->generateMonthlyReport($startDate, $endDate);
    }
}
