<?php
/**
 *
 * @author Emmanuel Taborda Carmona
 */
class GNSS {

	public function getDayGPS($day, $month, $year)
	{
		//Algoritmo de congruencia de Zeller
		if ($month <= 2)
		{
			$month = $month + 10;
			$year = $year - 1;
		}
		else
		{
			$month = $month - 2;
		}
	
		$a = $year % 100;
		$b = $year / 100;
	
		$dayGPS =
		(
			700 +
			((26 * $month - 2) / 10) +
			$day +
			$a +
			$a / 4 +
			$b / 4 -
			2 * $b
		) % 7;
	
		return $dayGPS;
	}
	
	public function getDayofYear($day,  $month,  $year)
	{
		$monthDayB = array(0, 31, 60, 91, 121, 152, 182, 213, 244, 274, 305, 335, 366);
		$monthDayNB = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365);
		
		$dayofYear = 0;
		
		if ($month > 1) {
			if ((($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) == true) {
				$dayofYear = $monthDayB[$month-1];
			} else {
				$dayofYear = $monthDayNB[$month-1];
			}
		}
	
		for ( $i = 0; $i < $day; $i++) {
			$dayofYear++;
		}
	
		return $dayofYear;
		
	}
	
	function getWeekGPS( $day,  $month,  $year) {
	
		$monthDayB = array(0, 31, 60, 91, 121, 152, 182, 213, 244, 274, 305, 335, 366);
		$monthDayNB = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365);
	
		//$day set 1/ enero / 1994
		$cont1 = $this->getDayGPS(1, 1, 1994);
		$weekGPS = 729;
	
		for ( $i = 1994; $i < $year; $i++) {
			if ((($i % 4 == 0 && $i % 100 != 0) || $i % 400 == 0) == true) {
				for ( $j = 0; $j < 366; $j++) {
					$cont1++;
					if ($cont1 == 7) {
						$weekGPS++;
						$cont1 = 0;
					}
				}
			} else {
				for ( $j = 0; $j < 365; $j++) {
					$cont1++;
					if ($cont1 == 7) {
						$weekGPS++;
						$cont1 = 0;
					}
				}
			}
		}
	
		if ($month > 1) {
			if ((($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) == true) {
				for ( $i = 0; $i < $monthDayB[$month - 1]; $i++) {
					$cont1++;
					if ($cont1 == 7) {
						$weekGPS++;
						$cont1 = 0;
					}
				}
	
			} else {
				for ( $i = 0; $i < $monthDayNB[$month - 1]; $i++) {
					$cont1++;
					if ($cont1 == 7) {
						$weekGPS++;
						$cont1 = 0;
					}
				}
			}
		}
	
		for ( $i = 0; $i < $day; $i++) {
			$cont1++;
			if ($cont1 == 7) {
				$weekGPS++;
				$cont1 = 0;
			}
		}
	
		return $weekGPS;
	}
	
	public function  converToDate($year, $dayOfYear){
	
		$monthdayB = array(31,60,91,121,152,182,213,244,274,305,335,366);
		$monthdayNB = array(31,59,90,120,151,181,212,243,273,304,334,365);
	
		$arr = array();
		$date = array();
		$m=0;
	
		if((($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0)==true){
			$arr = $monthdayB;
		}else{
			$arr = $monthdayNB;
		}
	
		if($dayOfYear<= $arr[0]){
			$m=0;
		}else if($dayOfYear>$arr[0] && $dayOfYear<= $arr[1]){
			$m=1;
		}else if($dayOfYear>$arr[1] && $dayOfYear<= $arr[2]){
			$m=2;
		}else if($dayOfYear>$arr[2] && $dayOfYear<= $arr[3]){
			$m=3;
		}else if($dayOfYear>$arr[3] && $dayOfYear<= $arr[4]){
			$m=4;
		}else if($dayOfYear>$arr[4] && $dayOfYear<= $arr[5]){
			$m=5;
		}else if($dayOfYear>$arr[5] && $dayOfYear<= $arr[6]){
			$m=6;
		}else if($dayOfYear>$arr[6] && $dayOfYear<= $arr[7]){
			$m=7;
		}else if($dayOfYear>$arr[7] && $dayOfYear<= $arr[8]){
			$m=8;
		}else if($dayOfYear>$arr[8] && $dayOfYear<= $arr[9]){
			$m=9;
		}else if($dayOfYear>$arr[9] && $dayOfYear<= $arr[10]){
			$m=10;
		}else if($dayOfYear>$arr[10]){
			$m=11;
		}
	
		$date['year'] = $year;
		
		$date['month'] = $m + 1;
	
		if($m==0){
			$date['day'] = $dayOfYear;
	
		}else{
			$date['day'] = $dayOfYear-($arr[$m-1]);
		}
		return $date;
	}
		
}

?>