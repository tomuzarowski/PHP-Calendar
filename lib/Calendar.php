<?php
namespace Calendar;

//use Calendar\Utils;

class Calendar
{
    public int $month;
    public int $year;
    public array $daysOfWeek = ["Pon", "Wto", "Śro", "Czw", "Pią", "Sob", "Nie"];
    public string $firstDayOfMonth;
    public int $daysCount;
    public array $dateComponents;
    public int $dayOfWeek;
    public string $calendar;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
        $this->getFirstDayOfMonth($this->month, $this->year);
        $this->getDaysCount();
        $this->getDateComponents();
        $this->getFirstDayOfTheMonthIndex();
        $this->buildTable();
    }

    public function getTable(): string {
        return $this->calendar;
    }

    public function getFirstDayOfMonth($month, $year) {
        $this->firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    }

    public function getDaysCount() {
        $this->daysCount = date("t", $this->firstDayOfMonth);
    }

    public function getDateComponents() {
        $this->dateComponents = getdate($this->firstDayOfMonth);
    }

    public function getFirstDayOfTheMonthIndex() {
        $this->dayOfWeek = $this->dateComponents["wday"];
    }

    public function buildTable()
    {
        $calendar = "<table><thead>";
        $calendar .= "<tr>";

        foreach ($this->daysOfWeek as $day) {
            $calendar .= "<th>$day</th>";
        }

        $currentDay = 1;

        $calendar .= "</tr></thead><tbody><tr>";

        for ($i = 1; $i < $this->dayOfWeek; $i++) {
            $calendar .= "<td>&nbsp;</td>";
        }

        while ($currentDay <= $this->daysCount) {
            $calendar .= "<td class='day'>$currentDay</td>";

            if ($this->dayOfWeek == 7) {
                $this->dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $currentDay++;
            $this->dayOfWeek++;
        }

        if ($this->dayOfWeek != 7) {
            $remainingDays = 8 - $this->dayOfWeek;
            if ($remainingDays != 7) {
                $calendar .= str_repeat("<td>&nbsp;</td>", $remainingDays);
            }
        }

        $calendar .= "</tr></tbody></table>";

        $this->calendar = $calendar;
    }
}