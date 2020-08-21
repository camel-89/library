<pre>
<?php

$file = file_get_contents('./bind.log');

if(!isset($_GET['date'])) $date = '';
elseif(!strtotime($_GET['date'])) $date = '';
elseif(!$date = date("d-M-Y", strtotime($_GET['date']))) $date = '';

if(preg_match_all('/(?<datetime>' . $date . '.+)\..+query:.+(?<domainname>[\-\w]+\.(?!dlink)\w+) IN/iU', $file, $matches)) {

	$unique_names = array_unique($matches['domainname']);

	$i = 0;
	
	$out = '';

	foreach($unique_names as $k => $v) {
		$out .= ++$i . "\t" . $matches['datetime'][$k] . "\t" . $v . PHP_EOL;
	}

	echo $out;

}

?>
</pre>