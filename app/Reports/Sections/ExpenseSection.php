<?php

namespace App\Reports\Sections;

class ExpenseSection
{
    public string $id    = 'expense';
    public string $title = 'ລາຍຈ່າຍ';
    public string $view  = 'reports.annual.sections.expense';

    public function data(int $year): array
    {
        // TODO: query expense data when module is built
        return ['year' => $year];
    }

    public function totals(int $year): array
    {
        return ['gross' => 0, 'faculty' => 0, 'p1' => 0, 'p2' => 0];
    }
}
