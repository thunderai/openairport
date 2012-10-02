<?php

function datecheck($date, $yearepsilon=5000, $format='dmy') {
  $date=str_replace("/", "-", $date);
  $format = strtolower($format);
  if (count($datebits=explode('-',$date))!=3) return false;
  $year = intval($datebits[strpos($format, 'y')]);
  $month = intval($datebits[strpos($format, 'm')]);
  $day = intval($datebits[strpos($format, 'd')]);

  if ((abs($year-date('Y'))>$yearepsilon) || // year outside given range
     ($month<1) || ($month>12) || ($day<1) ||
     (($month==2) && ($day>28+(!($year%4))-(!($year%100))+(!($year%400)))) ||
     ($day>30+(($month>7)^($month&1)))) return false; // date out of range

  return array(
   'year' => $year,
   'month' => $month,
   'day' => $day
  );
}
?>