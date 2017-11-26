<?php

class Transformation{
	
	public function getGeodeticCoordinates($X, $Y, $Z, $a, $f){
		
		//Relación entre coordenadas cartesianas geocéntricas y coordenadas geodésicas.
		//página 57.
		
		$b = $a * (1 - $f);
		
		$e2 = (pow($a, 2) - pow($b, 2)) / pow($a, 2);
		$ep2 = (pow($a, 2) - pow($b, 2))/ pow($b, 2);
		$r = sqrt(pow($X, 2) + pow($Y, 2));
		$v2 = deg2rad (atan($Z * $a / $r * $b));
		
		$fi = rad2deg ( atan( ($Z + $ep2 * $b * pow(sin($v2), 3))  / ($r - $e2 * $a * pow(cos($v2), 3))) ); 
		
		$v1 = $a * pow(1 - $e2 * pow(sin(deg2rad($fi)), 2), -1/2);
		
		$lambda = rad2deg (atan($Y/$X) ); 
		
		$h = ($r / cos(deg2rad($fi))) - $v1;
		
		$result['latitude'] = $fi;
		$result['longitude'] = $lambda;
		$result['height'] = $h;
		$result['X'] = $X;
		$result['Y'] = $Y;
		$result['Z'] = $Z;
		
		return $result;

	}
	
	public function getDateJulian($day, $month, $year){
		
		if($month <= 2){
			$month = $month + 12;
			$year = $year - 1;
		}
		
		$A = intval($year/100);
		$B = 2- $A + intval($A/4);
		
		$DJ = intval(365.25 * ($year + 4716)) + intval(30.6001 * ($month + 1)) + $day + $B - 1524.5;
		
		return $DJ;
		
	}
	
	function ll2gk($s_Latitude, $s_Longitude){
	
		$d_Latitude  = $s_Latitude;
		$d_Longitude = $s_Longitude;
	
		// 		$sd_Latitude.replace( ",", "." );
		// 		$sd_Longitude.replace( ",", "." );
	
	
		//latitude  = QString( "%1" ).arg( d_Latitude, 0, 'f', 7 );
		//longitude = QString( "%1" ).arg( d_Longitude, 0, 'f', 7 );
	
		$latitude  = $d_Latitude;
		$longitude = $d_Longitude;
	
		// **********************************************************************************************
	
		$IMODE       = 2;
	
		$err         = "_NOERROR_";
	
		$iZFK		= 0;
	
		$pi			= 0.;
		$rho			= 0.;
	
		$A			= 0.;
		$B			= 0.;
		$AL			= 0.;
		$AM0			= 0.;
		$AN			= 0.;
		$BELT		= 0.;
		$ETAQ		= 0.;
		$EXZQ		= 0.;
		$G			= 0.;
		$Longitude0	= 0.;
		$QM			= 0.;
		$QN			= 0.;
		$tanLat		= 0.;
		$sinLat		= 0.;
		$cosLat		= 0.;
		$sqrtSAVE	= 0.;
	
		$AN2			= 0.;
		$AN3			= 0.;
		$AN4			= 0.;
		$AL2			= 0.;
		$AL3			= 0.;
		$AL4			= 0.;
		$AL5			= 0.;
		$d1			= 0.;
		$d2			= 0.;
		$d3			= 0.;
		$d4			= 0.;
		$d5			= 0.;
		//$d6			= 0.;
		$cL2			= 0.;
		$cL3			= 0.;
		$cL4			= 0.;
		$cL5			= 0.;
		$TT			= 0.;
	
		//-------------------------------------------------------------
	
		if ( $d_Longitude < 0 )
			$d_Longitude += 360.;
	
			$pi  = 4.*atan(1.);
			$rho = 180./$pi;
	
			switch ($IMODE)
			{
				case 1:
					//......Internationales Ellipsoid, grosse und kleine Halbachse
					//
					$A     = 6378388.0;
					$B     = 6356911.94613;
					$AM0   = 0.9996;
					$BELT  = 6.;
					break;
	
				case 2:
					//......Gauss-Krueger
					//
					$A     = 6377397.155;  // Bessel 1841
					$B     = 6356078.96325;
					$AM0   = 1.;
					$BELT  = 3.;
					break;
			}
	
			$d_Latitude = $d_Latitude/$rho;
			$sinLat     = sin( $d_Latitude );
			$cosLat     = cos( $d_Latitude );
			$tanLat     = tan( $d_Latitude );
	
			$EXZQ 	   = ($A*$A-$B*$B)/($A*$A);
			$sqrtSAVE = sqrt((1. - $EXZQ*$sinLat*$sinLat) );
	
			$AN  = ($A-$B)/($A+$B);
			$AN2 = $AN*$AN;
			$AN3 = $AN2*$AN;
			$AN4 = $AN2*$AN2;
	
			//--COMPUTATION OF CENTRAL MERIDIAN
			switch ($IMODE)
			{
				case 1:
					$iZFK 	   = (int) ( $d_Longitude/$BELT + 31. );
					$Longitude0 = (double) $iZFK * $BELT - $BELT/2. - 180.;
					break;
				default:
					$iZFK 	   = (int) ( ( $d_Longitude + $BELT/2. )/$BELT );
					$Longitude0 = (double) $iZFK * $BELT;
					break;
			}
	
			//--LENGTH OF MERIDIAN
			$G = $A/(1. + $AN) * ((1. + $AN2/4. + $AN4/64.)*$d_Latitude
					- ($AN - $AN3/8.)*1.5*sin(2.*$d_Latitude)
					+ ($AN2 - $AN4/4.)*15./16.*sin(4.*$d_Latitude)
					- $AN3*35./48.*sin(6.*$d_Latitude)
					+ $AN4*315./512.*sin(8.*$d_Latitude) );
	
			$AL  = ( $d_Longitude - $Longitude0 )/$rho;
			$AL2 = $AL*$AL;
			$AL3 = $AL2*$AL;
			$AL4 = $AL2*$AL2;
			$AL5 = $AL3*$AL2;
	
			$QN   = $A/$sqrtSAVE;
			$QM   = $A*(1. - $EXZQ)/($sqrtSAVE*$sqrtSAVE*$sqrtSAVE);
			$ETAQ = $QN/$QM - 1.;
			$TT   = $tanLat*$tanLat;
	
			//--COMPUTE COEFFICIENTS
			$cL2 = $cosLat*$cosLat;
			$cL3 = $cL2*$cosLat;
			$cL4 = $cL2*$cL2;
			$cL5 = $cL3*$cL2;
			$d1  = $QN*$cosLat;
			$d2  = $QN*$cL2*$tanLat/2.;
			$d3  = $QN*$cL3*(1. - $TT + $ETAQ)/6.;
			$d4  = $QN*$cL4*$tanLat*(5. - $TT + 9.*$ETAQ)/24.;
			$d5  = $QN*$cL5*(5. - 18.*$TT + $TT*$TT)/120.;
			//    $d6  = $sinLat*($cL2)*(1. + 3.*$ETAQ)/3.;
	
			//--COMPUTE  CG
			//   *CG = sinLat*AL + d6*AL3;
	
			//--COMPUTE COORDINATES
			$hoch     = ($d2*$AL2 + $d4*$AL4 + $G) * $AM0;
			$rechts   = ($d1*$AL + $d3*$AL3 + $d5*$AL5)*$AM0 + 500000.;// + (double) iZFK*1000000.;
			$streifen = $iZFK;
	
			$result['N'] = $hoch;
			$result['E'] = $rechts;
			$result['H'] = $streifen;
			
			return( $result );
	
	}
	
}

// $tr = new Transformation();
// var_dump($tr->getGeodeticCoordinates(6653588.1594, -14265056.7498, 21547856.4802, 6378137, 1/298.257223563));

?>