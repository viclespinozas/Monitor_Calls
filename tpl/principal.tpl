<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>GYSMO</title>
  <link rel="stylesheet" href="librerias/jquery/css/cupertino/jquery-ui-1.10.3.custom.css" />
  <script src="librerias/jquery/js/jquery-1.9.1.js"></script>
  <script src="librerias/jquery/js/jquery-ui-1.10.3.custom.js"></script>
  <script src="librerias/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
</head>
<frameset cols="10%,*,10%" frameborder="NO" border="0" framespacing="1">
	<frame name="leftFrame" scrolling="no" noresize style="border:1px solid red;">
	<frameset rows="20%,7%,*" frameborder="NO" border="0" framespacing="1">
		<frame name="upCenterFrame" scrolling="no" noresize style="border:1px solid #333;">
		<frame name="middleCenterFrame" scrolling="no" noresize style="border:1px solid #333;">
		<frame name="mainCenterFrame" scrolling="no" noresize style="border:1px solid #333;">
	</frameset>
	<frame name="rightFrame" scrolling="no" noresize style="border:1px solid blue;">
</frameset>
</html>