<?php 
//custom data
$data = array(
	'image' => array(
		'path' => 'http://localhost/test/new-spot-the-difference-master2/spot-the-difference.jpg',
		'width' => '800',
		'height' => '600',
		),
	'data' => array(
		'x_array' => array(270,132,272,284,369),
		'y_array' => array(6,282,390,169,385),
		'rad_array' =>array(25,16,16,16,10),
		'seconds' => 120,
		),
	
	);
$img_data = json_encode($data);
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Spot the Difference</title>
</head>
<script language="javascript">
var x,y;
var count = 0;
var length = 0;
//customized data  
var img_data = <?php print $img_data?>;
var total_seconds = img_data.data.seconds;
//center position x, y and radius
var x_array=img_data.data.x_array;     
var y_array=img_data.data.y_array;
var rad_array=img_data.data.rad_array;
//--end of customized data

function Cirkus(centerX,centerY, radius ) {
var canvas=document.getElementById("Canvas");
//Refer to the image
var img=document.getElementById('image1'); 

    var obCanvas = canvas.getContext('2d');
   
    obCanvas.beginPath();
    obCanvas.arc(centerX, centerY, radius, 0, 2*Math.PI, false);
    obCanvas.lineWidth = 2;
    obCanvas.strokeStyle = 'blue';
    obCanvas.stroke();
}


function position (e)
{
	var x_diff;
  var y_diff;
	var distance0, distance1;
	var width=document.getElementById('Canvas').width;
	var offset_left =  document.getElementById('Canvas').offsetLeft;
	var offset_top =  document.getElementById('Canvas').offsetTop;

 	e = e || window.event

	if (e.pageX == null && e.clientX != null ) { 
		var html = document.documentElement
		var body = document.body
	
		e.pageX = e.clientX + (html && html.scrollLeft || body && body.scrollLeft || 0) - (html.clientLeft || 0)
		e.pageY = e.clientY + (html && html.scrollTop || body && body.scrollTop || 0) - (html.clientTop || 0)
	}
	x=e.pageX;
	y=e.pageY;
	x = x - offset_left;
	y = y - offset_top;

  

  if(x_array.length == y_array.length)
  {
  	  length = x_array.length;
	  for (var i = 0; i < length; i++) {
			x_diff=x_array[i]-x;
			y_diff=y_array[i]-y;
			x_diff1=x_diff+width/2;
			distance0=Math.sqrt(x_diff*x_diff+y_diff*y_diff);
			distance1=Math.sqrt(x_diff1*x_diff1+y_diff*y_diff);
			
			if ( (distance0 < rad_array[i])||(distance1 < rad_array[i])) 
			{
				Cirkus(x_array[i],y_array[i],rad_array[i]);
				Cirkus(x_array[i]+width/2,y_array[i],rad_array[i]);
				count++;
				if(length == count)
				{
					clearInterval(timer);
					alert('Congratulations! You\'ve found all the ' + length + ' differences');
				}
				
			}
	  }
  }
}

function toHHMMSS(seconds) {
  var sec_num = parseInt(seconds); // don't forget the second param
  var hours   = Math.floor(sec_num / 3600);
  var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
  var seconds = sec_num - (hours * 3600) - (minutes * 60);

  if (hours   < 10) {hours   = "0"+hours;}
  if (minutes < 10) {minutes = "0"+minutes;}
  if (seconds < 10) {seconds = "0"+seconds;}
  var time    = hours+':'+minutes+':'+seconds;
  return time;
}

function img ()
{
	
	var canvas=document.getElementById("Canvas");
	var img=document.getElementById('image1'); 
	//Refer to the image
	var obCanvas = canvas.getContext('2d');
	obCanvas.drawImage(img,0,0);
	obCanvas.stroke();
}

function update_timer()
{
	total_seconds -= 1;
	document.getElementById("timer_number").innerHTML = toHHMMSS(total_seconds);
	if(total_seconds == 0)
	{
		clearInterval(timer);
		alert('Time Out, click to reload page to restart the game.');
		location.reload();
	}	
}

var timer = setInterval(update_timer, 1000);

</script>

<style>
	.wrap {
		margin: 0 auto;
		width: <?php print $data['image']['width'];?>px;
	}
	.timer{
		font-size: 2em;
		color: red;
	}
</style>

<body onload="img()">	
	<div class="wrap">
		<h1>Spot the Difference Game</h1>
		<p>Can you spot the differences?  Click on all 5 of them in the picture on the right to be entered to win.</p>
		
		<div class="timer"><span>Time Left:</span><span id="timer_number"></span></div>
    <canvas id="Canvas" width="<?php print $data['image']['width'];?>" height="<?php print $data['image']['height'];?>" onclick="position()"> 
         Your browser does not support Canvas. 
    </canvas>
  </div>
	<img id="image1" src="<?php print $data['image']['path'];?>"  border="0"  width="0" height="0" />
</body>
</html>
