<?php

 function insertion_Sort($array)
{
	for($i=0;$i<count($array);$i++){
		$val = $array[$i];
		$j = $i-1;
		while($j>=0 && $array[$j] > $val){
			$array[$j+1] = $array[$j];
			$j--;
		}
		$array[$j+1] = $val;
	}
return $array;
}
$array = array(5, 15, -10, 4, -25, 13, 7);
echo "Original Array :\n";
echo implode(', ',$array );
echo "\nSorted Array :\n";
print_r(insertion_Sort($array));
?>