<?php
if(isset($_POST['submit'])) {
  $save_result = file_put_contents('settings.ini',
                                   array("[prompter]", "\n",
                                         "text_size=", $_POST['text_size'], "\n",
                                         "text_colour=", $_POST['text_colour'], "\n",
                                         "text_speed=", $_POST['text_speed'], "\n",
                                         "container_height=", $_POST['container_height'], "\n",
                                         "target_time=", $_POST['target_time']));
    $file = '/storage/content/84/130584/poru.se/public_html/projects/dh/stage_prompter/textfile.txt';
    $fp = fopen($file, 'w');
    $data = $_POST['textfile'];
    fwrite($fp, $data);
    fclose($fp);

  if($save_result === false) die('Failed to save settings');
}
 
extract(parse_ini_file('settings.ini'));
 
$theData = file_get_contents('textfile.txt');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Virtual TV Prompter</title>
<link type="text/css" rel="stylesheet" media="all" href="style.css" />
 
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/prompter-1.0.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
$(document).ready(function() {
  $rollprompter = $('div.wrapper div#prompter').prompter('pointer', <?php echo $text_speed;?>);
 
//  Use start/stop controls on prompter mouseover
//  $rollprompter.mouseover(function() {
//    $($rollprompter).trigger('stop');
//  });
//  $rollprompter.mouseout(function() {
//    $($rollprompter).trigger('start');
//  });
 
  // begin paused
  $($rollprompter).trigger('stop');
 
  $('#play').click(function() {
    $($rollprompter).trigger('unpause');
  });
  $('#pause').click(function() {
    $($rollprompter).trigger('pause');
  });
 
  $('.trigger').click(function(){
    $('.panel').toggle('fast');
    return false;
  });
 
  $('#sizer a').click(function(){
    var ourText = $('.wrapper p');
    var currFontSize = ourText.css('fontSize');
    var finalNum = parseFloat(currFontSize, <?php echo $text_size;?>);
    var stringEnding = currFontSize.slice(-2);
    if(this.id == 'large') {
      finalNum *= 1.2;
    }
    else if(this.id == 'small'){
      finalNum /=1.2;
    }
    ourText.css('fontSize', finalNum + stringEnding);
  });
});
//--><!]]>
</script>
</head>

<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
  setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>
<body onload="JavaScript:timedRefresh(60010);">
 <div id="main_wrapper">
 <video autoplay loop poster="poster.png" id="bgvid">
<source src="bgloop_25.webm" type="video/webm">
<source src="bgloop_25.mp4" type="video/mp4">
</video>
<br><br><br>
<br>
<br>
<br>
<br>
<br>
<div id="numbers">
<?php
$minute_old = substr($target_time, -2, 2);   
$hour_old = substr($target_time, -4, 2);    

$hour_curr = date('H');
$minute_curr = date('i');

$hour_diff = ($hour_old-$hour_curr)*3600;
$minute_diff = ($minute_old-$minute_curr)*60;

$total_diff = $hour_diff+$minute_diff;
?>
<script>
  var time_sec = "<?php echo $total_diff;?>";
</script>
<script src="countdown.js" type="text/javascript"></script>

<script type="application/javascript">
var myCountdown2 = new Countdown({
                  time: time_sec, 
                  width:600, 
                  height:250, 
                  rangeHi:"hour"  // <- no comma on last item!
                  });

</script>
</div>
<center>
<div class="wrapper">
  <div id="prompter" style="height: <?php echo $container_height;?>px"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p style="font-size: <?php echo $text_size;?>pt; white-space: normal; font-family: Arial; font-weight: bold; color: <?php echo $text_colour;?>; padding: 2px; padding-left: 46px;">

    <?php echo nl2br($theData);?>
      <br /><br />
      <br /><br /><br /><br />
      <!--This is the prompter text. It will flow at a constant speed and it can be paused by mousing over it. It was built as an alternative for executable TV teleprompter systems, and as a jQuery demonstration. More text here, and even more.<br /><br />[Commercial break]<br /><br />More text keeps flowing up.-->
    </p>
  </div>
</div>
</div>
 </center>
 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- // Begin Prompter Options //-->
<div class="panel">
  <h3>Prompter Inställningar<a href="#" class="trigger"><img src="images/close.png" alt="" style="float: right" /></a></h3>
 
  <form action="index.php" method="post">
    <div>
      <input type="text" name="text_size" id="text_size" value="<?php echo $text_size;?>" />
      <label for="text_size">Textstorlek <span>standard är 100</span></label>
    </div>
    <div>
      <input type="text" name="text_colour" id="text_colour" value="<?php echo $text_colour;?>" />
      <label for="text_colour">Textfärg <span>standard är #000 (svart) vit = #FFFFFF</span></label>
    </div>
    <div>
      <input type="text" name="container_height" id="container_height" value="<?php echo $container_height;?>" />
      <label for="container_height">Promter-höjd <span>standard är 450</span></label>
    </div>
    <div>
      <input type="text" name="target_time" id="target_time" value="<?php echo $target_time;?>" />
      <label for="target_time">Sluttid för aktivitet <span>format: TTMM</span></label>
    </div>
    <div>
      <textarea type ="text" name="textfile" rows="6" cols="40"><?php echo $theData;?></textarea>
      <label for="textfile">Vad ska stå för de på scen?</label>
    </div>
    <div>
      <input type="submit" name="submit" value="Apply changes" />
    </div>
  </form>
 
  <div style="clear:both;"></div>
</div>
<!-- // End Prompter Options //-->
</body>
</html>