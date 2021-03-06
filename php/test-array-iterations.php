<?php
function kbytes_to_string($kb)
{
    $units = array('TB','GB','MB','KB');
    $scale = 1024*1024*1024;
    $ui = 0;
 
    while (($kb < $scale) && ($scale > 1))
    {
        $ui++;
        $scale = $scale / 1024;
    }   
    return sprintf("%0.2f %s", ($kb/$scale),$units[$ui]);
}

// fixture for tests
$tab = array();
for($i=0;$i<=100000; $i++)
{
	$tab[$i]['act']=1;
	$tab[$i]['label']='label';
	$tab[$i]['rx']=1200000;
	$tab[$i]['tx']=1300000;
}

// test 1
$time1 = microtime(true);
for ($i=0; $i<sizeof($tab); $i++)
{
	if ($tab[$i]['act'] == 1)
  {
    $t = $tab[$i]['label'];
    $rx = kbytes_to_string($tab[$i]['rx']);
    $tx = kbytes_to_string($tab[$i]['tx']);
    $total = kbytes_to_string($tab[$i]['rx']+$tab[$i]['tx']);
		$id = ($i & 1) ? 'odd' : 'even';
		/*
    print "<tr>";
    print "<td class=\"label_$id\">$t</td>";
    print "<td class=\"numeric_$id\">$rx</td>";
    print "<td class=\"numeric_$id\">$tx</td>";
    print "<td class=\"numeric_$id\">$total</td>";
    print "</tr>\n";
		/**/
	}
}
printf("\nFor, all iterations end with sizeof: %0.2d msec\n", (microtime(true) - $time1) * 1000);

// test 2
$time2 = microtime(true);
for ($i=0, $max=count($tab); $i<$max; $i++)
{
	if ($tab[$i]['act'] == 1)
	{
		$t = $tab[$i]['label'];
		$rx = kbytes_to_string($tab[$i]['rx']);
		$tx = kbytes_to_string($tab[$i]['tx']);
		$total = kbytes_to_string($tab[$i]['rx']+$tab[$i]['tx']);
		$id = ($i & 1) ? 'odd' : 'even';
		/*
		print "<tr>";
		print "<td class=\"label_$id\">$t</td>";
		print "<td class=\"numeric_$id\">$rx</td>";
		print "<td class=\"numeric_$id\">$tx</td>";
		print "<td class=\"numeric_$id\">$total</td>";
		print "</tr>\n";
		/**/
	}
}
printf("\nFor, only one sizeof call: %0.2d msec\n", (microtime(true) - $time2) * 1000);

// test 3
$time3=microtime(true);
$max=count($tab); 
for ($i=0; $i<$max; $i++)
{
	$v = $tab[$i];

	if ($v['act'] == 1)
	{
		$t = $v['label'];
		$rx = kbytes_to_string($v['rx']);
		$tx = kbytes_to_string($v['tx']);
		$total = kbytes_to_string($v['rx']+$v['tx']);
		$id = ($i & 1) ? 'odd' : 'even';
		/*
		print "<tr>";
    print "<td class=\"label_$id\">$t</td>";
		print "<td class=\"numeric_$id\">$rx</td>";
		print "<td class=\"numeric_$id\">$tx</td>";
		print "<td class=\"numeric_$id\">$total</td>";
		print "</tr>\n";
		/**/
	}
}
printf("\nFor using reference: %0.2d msec\n", (microtime(true) - $time3) * 1000);

// test 4
$time4 = microtime(true);
foreach ($tab as $i => $v)
{
	if ($v['act'] == 1)
	{
		$t = $v['label'];
		$rx = kbytes_to_string($v['rx']);
		$tx = kbytes_to_string($v['tx']);
		$total = kbytes_to_string($v['rx']+$v['tx']);
		$id = ($i & 1) ? 'odd' : 'even';
		/*
		print "<tr>";
		print "<td class=\"label_$id\">$t</td>";
		print "<td class=\"numeric_$id\">$rx</td>";
		print "<td class=\"numeric_$id\">$tx</td>";
		print "<td class=\"numeric_$id\">$total</td>";
		print "</tr>\n";
		/**/
	}
}
printf("\nForeach: %0.2d msec\n", (microtime(true) - $time4) * 1000);

// test 5 
$time5 = microtime(true);
$mapper = function ($tab) use ($i,$v)
{
	if ($v['act'] == 1)
	{
		$t = $v['label'];
	  $rx = kbytes_to_string($v['rx']);
	  $tx = kbytes_to_string($v['tx']);
	  $total = kbytes_to_string($v['rx']+$v['tx']);
	
		/*
		print(sprintf('<tr><td class="label_%d">%s</td>'.PHP_EOL.
									 '<td class="numeric_%d">%s</td>'.PHP_EOL.
									 '<td class="numeric_%d">%s</td>'.PHP_EOL.
									 '<td class="numeric_%d">%s</td></tr>'.PHP_EOL
									,
			$i, $t, 
			$i, $rx, 
			$i, $tx,
			$i, $total
		));
		/**/
	}
};
//array_map($mapper, $tab);
array_walk($tab, $mapper);
printf("\nMapper closure: %0.2d msec\n", (microtime(true) - $time5) * 1000);
