<?php

require "functions.php";

class DateUtil
{
    private $day;

    private $hour;

    private $min;

    public static function create(string $d,int $h,int $m): DateUtil
    {
        $a = new self();
        $a->setDay($d);
        $a->setHour($h);
        $a->setMin($m);
        return $a;
    }
    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }
    /**
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }
    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param mixed $day
     */
    private function setDay($day): void
    {
        $this->day = $day;
    }

    /**
     * @param mixed $hour
     */
    private function setHour($hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @param mixed $min
     */
    private function setMin($min): void
    {
        $this->min = $min;
    }



    public function addMin(int $m): void
    {
        if($m<0){
          return;
        }
        if($this->min+$m>=60){
            $r = $this->min;
            $this->min = 0;
            $this->hour += 1;
            $this->addMin(($r + $m)-60);
        }
        else{
            $this->min += $m;
        }
    }

    public function format(): string
    {
        if(strlen("$this->min")===1){
            $m = "0$this->min";
        }
        else{
            $m = $this->min;
        }
        if(strlen("$this->hour")===1){
            $h = "0$this->hour";
        }
        else{
            $h = $this->hour;
        }
        return $this->day."T$h:$m";
    }

    public function default($hm = "09:00"): void

    {
        $hm = parseDate($hm);
        $this->setHour($hm[0]);
        $this->setMin($hm[1]);
    }

    public function isValid($a,$b): bool
    {
        if ($this->compare($a)===1 and $this->compare($b)===-1){
            return false;
        }
        else{
            return true;
        }
    }

    public function isInterval($date2,$a,$b): bool
    {
        if($this->compare($a)===0 and $date2->compare($b)===0){
            return true;
        }
        else{
            return false;
        }
    }

    public function compare($a): int
    {
        $a = parseDate($a);
        if($a[0] > $this->hour){
            return -1;
        }
        elseif ($a[0] === $this->hour){
            if ($a[1]>$this->min){
                return -1;
            }
            elseif ($a[1] === $this->min){
                return 0;
            }
            else {
                return 1;
            }
        }
        else{
            return 1;
        }
    }
}