<?php

$data = array(
	'image' => array(
		'path' => 'http://localhost/test/new-spot-the-difference-master2/spot-the-difference.jpg',
		'width' => '800',
		'height' => '600',
		),
	'data' => array(
		'x_array' => array(270,132,272,284,369),
		'y_array' => array(6,282,390,169,385),
		'rad_array' =>array(25,16,16,16,10)
		)
	);


print json_encode($data);