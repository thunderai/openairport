<?
function datediff($start_date,$end_date="now",$unit="D") {
		$unit = strtoupper($unit);
		$start=strtotime($start_date);
		if ($start === -1) {
			print("invalid start date");
		}
		
		$end=strtotime($end_date);			
		if ($end === -1) {
			print("invalid end date");
		}
		
		if ($start > $end) {
			$temp = $start;
			$start = $end;
			$end = $temp;
		}
		
		$diff = $end-$start;
		
		$day1 = date("j", $start);
		$mon1 = date("n", $start);
		$year1 = date("Y", $start);
		$day2 = date("j", $end);
		$mon2 = date("n", $end);
		$year2 = date("Y", $end);
		
		switch($unit) {
			case "D":
				print(intval($diff/(24*60*60)));
				$diff = (intval($diff/(24*60*60)));
				break;
			case "M":
				if($day1>$day2) {
					$mdiff = (($year2-$year1)*12)+($mon2-$mon1-1);
				} else {
					$mdiff = (($year2-$year1)*12)+($mon2-$mon1);
				}
				print($mdiff);
				$diff = $mdiff;
				break;
			case "Y":
				if(($mon1>$mon2) || (($mon1==$mon2) && ($day1>$day2))){
					$ydiff = $year2-$year1-1;
				} else {
					$ydiff = $year2-$year1;
				}
				print($ydiff);
				$diff = $ydiff;
				break;
			case "YM":
				if($day1>$day2) {
					if($mon1>=$mon2) {
						$ymdiff = 12+($mon2-$mon1-1);
					} else {
						$ymdiff = $mon2-$mon1-1;
					}
				} else {
					if($mon1>$mon2) {
						$ymdiff = 12+($mon2-$mon1);
					} else {
						$ymdiff = $mon2-$mon1;
					}
				}
				print($ymdiff);
				$diff = $ymdiff;
				break;
			case "YD":
				if(($mon1>$mon2) || (($mon1==$mon2) &&($day1>$day2))) {
					$yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2-1))/(24*60*60));						
				} else {
					$yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2))/(24*60*60));
				}
				print($yddiff);
				break;
			case "MD":
				if($day1>$day2) {
					$mddiff = intval(($end - mktime(0, 0, 0, $mon2-1, $day1, $year2))/(24*60*60));						
				} else {
					$mddiff = intval(($end - mktime(0, 0, 0, $mon2, $day1, $year2))/(24*60*60));
				}
				print($mddiff);
				$diff = $mddiff;
				break;
			default:
			print("{Datedif Error: Unrecognized \$unit parameter. Valid values are 'Y', 'M', 'D', 'YM'. Default is 'D'.}");
			
		}
	return($diff);
	}
?>