<?php 

class Convertion{
	
	function igs2ngs($igs, $ngs){
	
		$i;
		$l;
		$endOfFile = 0;
	
	
		/* open both files */
		if( ( $in = fopen($igs,"r") ) == NULL )
		{
			return false;
		}
		if( ( $out = fopen($ngs,"w") ) == NULL )
		{
			return false;
		}
	
		$line = fgets($in);
	
		$chars = str_split($line);
	
		if($chars[0] == '#' && $chars[1] == 'c' )
		{
			$chars[1] = 'a';
			fprintf($out,"%s",implode("", $chars));
		}
		else
		{
			return false;
		}
	
		/* read and echo the second line */
		$line = fgets($in);
		fprintf($out,"%s",$line);
	
		/* read and modify lines 3 thru 4 */
		for( $l = 3; $l < 5; $l++ )
		{
			$line = fgets($in);
			$chars = str_split($line);
				
			for( $i = 9; $i < 60; $i += 3)
			{
				if( $chars[$i] == ' ' && $chars[$i+1] == ' ' && $chars[$i+2] == '0' )
				{
					// do nothing
				}
				else
				{
					if( $chars[$i] != 'G' )
					{
						return false;
					};
					$chars[$i] = ' ';
					if( $chars[$i+1] == '0' ) $chars[$i+1] = ' ';  /* change G03 into __3 */
				}
			}
				
			fprintf($out,"%s",implode("", $chars));
		}
	
		/* read and echo lines 5 thru 12 */
		for( $l = 5; $l < 13; $l++ )
		{
			$line = fgets($in);
			fprintf($out,"%s",$line);
		}
	
		/* read lines 13 thru 15 */
		for( $l = 13; $l < 16; $l++ )
		{
			$line = fgets($in);
		}
		fprintf($out,
				"%%c c  cc ccc ccc cccc cccc cccc cccc ccccc ccccc ccccc ccccc\n");
		/* In the sp3a format, this line should be all c's */
		fprintf($out,
				"%%c cc cc ccc ccc cccc cccc cccc cccc ccccc ccccc ccccc ccccc\n");
		fprintf($out,
				"%%f  0.0000000  0.000000000  0.00000000000  0.000000000000000\n");
		/* In the sp3a format, these should all be zeroes */
	
		/* read and echo lines 16 thru 23 */
		for( $l = 16; $l < 24; $l++ )
		{
			$line = fgets($in);
			fprintf($out,"%s",$line);
		}
	
		/* read and modify all of the Position and Clock Records
		 (and Velocity and Clock Rate-of-Change Records)
		 Omit any EP or EV records records -- these will NOT go into the sp3a file */
	
		while( !$endOfFile )
		{
			$line = fgets($in);
				
			if($line == NULL )
			{
	
				$endOfFile = 1;
				fclose($in);
				fclose($out);
				return false;
			}
				
			$chars = str_split($line);
	
			if( $chars[0] == 'P' && $chars[1] == 'G' )
			{
				$chars[1] = ' ';
				if( $chars[2] == '0') $chars[2] = ' ';  /* change PG03 into P__3 */
				fprintf($out,"%.60s\n",implode("", $chars));  /* truncate to 60 columns */
			}
			else if( $chars[0] == 'V' && $chars[1] == 'G' )
			{
				$chars[1] = ' ';
				if( $chars[2] == '0') $chars[2] = ' ';  /* change VG03 into V__3 */
				fprintf($out,"%.60s\n",implode("", $chars));  /* truncate to 60 columns */
			}
			else if( $chars[0] == 'E' && $chars[1] == 'P' )
			{
				// do nothing, do NOT write these types of sp3c records to the sp3a file
			}
			else if( $chars[0] == 'E' && $chars[1] == 'V' )
			{
				// do nothing, do NOT write these types of sp3c records to the sp3a file
			}
			else if( $chars[0] == 'E' &&  $chars[1] == 'O' &&  $chars[2] == 'F' )
			{
				$endOfFile = 1;
				fprintf($out,"%s",implode("", $chars));
			}
			else
			{
				fprintf($out,"%s",implode("", $chars));  /* print out all time tag lines without changes */
			}
	
		}
	
		fclose($in);
		fclose($out);
	
		return true;
	
	}
	
}
	
?>