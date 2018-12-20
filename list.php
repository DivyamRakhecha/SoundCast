<!DOCTYPE html>
<html lang="en">
  	
  	<head>
	    
	    <meta charset="utf-8">

	    <title>List | Music Library</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

	    <link rel="stylesheet" href="assets/css/custom.css">
		
		<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	</head>
  	
  	<body>
    	
    	<div class="navbar customNavBar navbar-default navbar-fixed-top">
      		<div class="container">
        		<div class="navbar-header">
          			<a href="./" class="navbar-brand"><img src="assets/images/logo.png" alt="Logo" /></a>
      					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
      						<span class="icon-bar"></span>
      						<span class="icon-bar"></span>
      						<span class="icon-bar"></span>
      					</button>
        		</div>
        
        		<div class="navbar-collapse collapse" id="navbar-main">
    					<ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
    						<li class="active"><a href="list">Musics</a></li>
    						<li><a href="upload">Upload Audio</a></li>
    					</ul>
        		</div>
      		</div>
    	</div>

    	<div class="container">
        <table class="table ">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>Image</th>
              <th>Title</th>
              <th>Audio</th>
            </tr>
          </thead>
          <tbody>
        		<?php

              $audios = array();

              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL,"https://soundcast.back4app.io/classes/songs_library");
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

              $headers = [
                  'Content-Type: application/json',
                  'X-Parse-Application-Id: VSPdpDKRMND382hqIRFIaiVLgbkhM0E1rL32l1SQ',
                  'X-Parse-REST-API-Key: E4ZeObhQv3XoHaQ3Q6baHGgbDPOkuO9jPlY9gzgA'
              ];

              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

              $result = curl_exec($ch);

              curl_close ($ch);

              if(!empty($result)){
                $audios = json_decode($result);
              }

              if(!empty($audios) && !empty($audios->results)){
                $list = $audios->results;
                
                $counter = 0;
                foreach ($list as $audio) {
                  
                  if(empty($audio->link)){
                    continue;
                  } 

                  $ext = pathinfo($audio->link, PATHINFO_EXTENSION);
                  if(empty($ext) || $ext != 'mp3'){
                    continue;
                  }

                  $counter++;
            ?>
                <tr>
                  <td><?php echo $counter; ?></td>
                  <td><img src="<?php echo $audio->thumbnail; ?>" height="50" /></td>
                  <td><?php echo $audio->title; ?></td>
                  <td>
                    <audio controls>
                      <source src="<?php echo $audio->link; ?>" type="audio/mpeg">
                      Your browser does not support the audio.
                    </audio>
                  </td>
                </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
    	</div>

    	<footer class="text-center">
    		All Rights Reserved by Music Library
    	</footer>

    	<script src="assets/js/custom.js"></script>

  	</body>
</html>
