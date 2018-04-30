<?php
function getImages($html) {
	$matches = array();
	$regex = '~http://somedomain.com/images/(.*?)\.jpg~i';
	preg_match_all($regex, $html, $matches);
	foreach ($matches[1] as $img) {
		saveImg($img);
	}
}

function saveImg($name) {
	$url = 'http://somedomain.com/images/'.$name.'.jpg';
	$data = get_data($url);
	file_put_contents('photos/'.$name.'.jpg', $data);
}

$i = 1;
$l = 101;

while ($i < $l) {
	$html = get_data('http://somedomain.com/id/'.$i.'/');
	getImages($html);
	$i += 1;
}
?>