<?php
function pDistance($x, $y, $x1, $y1, $x2, $y2) {
	// x, y is your target point and x1, y1 to x2, y2 is your line segment.
	
		$A = $x - $x1;
		$B = $y - $y1;
		$C = $x2 - $x1;
		$D = $y2 - $y1;

		$dot = $A * $C + $B * $D;
		$len_sq = $C * $C + $D * $D;
		$param = $dot / $len_sq;

		$xx = 0;
		$yy = 0;

		if ($param < 0 || ($x1 == $x2 && $y1 == $y2)) {
			$xx = $x1;
			$yy = $y1;
		}
		else if ($param > 1) {
			$xx = $x2;
			$yy = $y2;
		}
		else {
			$xx = $x1 + $param * $C;
			$yy = $y1 + $param * $D;
		}

		$dx = $x - $xx;
		$dy = $y - $yy;
		$sqroot = sqrt($dx * $dx + $dy * $dy);

		return $sqroot;

	}
	
function pDistance2($x1,$y1, $x2,$y2, $x3,$y3) {
    $px = $x2-$x1;
    $py = $y2-$y1;

   $something = $px * $px + $py * $py;

	if($something <= 0 ) {
			// For some reason something is less than or equal to zero
			$u = 0;
		} else {
			$u =  (($x3 - $x1) * $px + ($y3 - $y1) * $py) / $something;
		}

    if($u > 1) {
			$u = 1;
		} else {
			$u = 0;
		}

    $x = $x1 + $u * $px;
    $y = $y1 + $u * $py;

    $dx = $x - $x3;
    $dy = $y - $y3;

    # Note: If the actual distance does not matter,
    # if you only want to compare what this function
    # returns to other results of this function, you
    # can just return the squared distance instead
    # (i.e. remove the sqrt) to gain a little performance

    $dist = sqrt($dx*$dx + $dy*$dy);

    return $dist;
}	
?>