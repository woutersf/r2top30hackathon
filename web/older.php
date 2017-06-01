<?php

include 'settings.php';

if (!isset($_GET['id'])) {
  $_GET['id'] = 0;
}

$sql = 'SELECT * FROM users where id = ' . intval($_GET['id']) . ' limit 1';
$user = FALSE;
foreach ($dbh->query($sql) as $row) {
  $user = $row;
}

if ($user == FALSE) {
  echo 'oei die persoon hebben we niet gevonden. <a href="index.php">Proef zelf eens van ons spelletje.</a>';
  die();
}
if (!isset($_GET['hoeveeljaar'])) {
  $_GET['hoeveeljaar'] = 18;
}
$leeftijd = $_GET['hoeveeljaar'];
$selecteerleeftijd  = strtotime('+ ' . $leeftijd . ' YEARS', $user['geboortedatum']);
$user['birthday'] = date('d / m / Y', $selecteerleeftijd);
//no id = Oei, probeer het zelf eens
// KNOP to frontpage.


$from = last_friday($selecteerleeftijd);
$krantdate = date('Y/m/d', $selecteerleeftijd);
$to = strtotime('+ 6 days', $from);

$hitlijst = getHitlijstData('lists?parent_lid=3288&air_date_from=' . $from . '&air_date_to=' . $to);
$pos = 0;
$aftellijst = getHitlijstData('lists/' . $hitlijst->$pos->lid);
$first_song = $aftellijst->songs[0];
//var_dump($first_song->youtube_url);


if(isset($_GET['share'])) {
  $title = 'De '.$leeftijd.'ste verjaardag van '. $user['name'];
  $hijzij = $user['name'];
}else{
  $title = 'Op jouw '.$leeftijd.'e verjaardag';
  $hijzij = 'je';
}

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $first_song->title; ?> stond op 1 toen ik geboren werd</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="<?php echo $first_song->title; ?> stond op 1 toen ik <?php echo $leeftijd; ?> werd">
  <meta name="og:description" content="Ontdek ook jouw top30 geboorteplaat">
  <meta name="og:title" content="<?php echo $first_song->title; ?> stond op 1 toen ik <?php echo $leeftijd; ?> werd">
  <meta name="og:image" content="<?php echo $first_song->title; ?> stond op 1 toen ik <?php echo $leeftijd; ?> werd">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link rel="stylesheet" href="css/top30.css">
</head>
<body class="detail">
<div class="container">
  <div class="row header-top">
    <div class="datum"><?php echo $user['birthday']; ?></div>
    <?php echo '<div>'; ?>
    <?php echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode($cur_url) . '&share=fb">Deel op Facebook</a>'; ?>
    <?php echo '<a href="https://twitter.com/home?status=' . urlencode($cur_url) . '&share=tw">Deel op Twitter</a>'; ?>
    <?php echo '</div>'; ?>
  </div>
  <div class="row header">
    <svg width="149" height="149" viewBox="0 0 149 149"><title>
        radio2-logo</title>
      <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%"
                filterUnits="objectBoundingBox" id="a">
          <feOffset in="SourceAlpha" result="shadowOffsetOuter1"/>
          <feGaussianBlur stdDeviation="8.5" in="shadowOffsetOuter1"
                          result="shadowBlurOuter1"/>
          <feColorMatrix
            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.140341938 0"
            in="shadowBlurOuter1" result="shadowMatrixOuter1"/>
          <feMerge>
            <feMergeNode in="shadowMatrixOuter1"/>
            <feMergeNode in="SourceGraphic"/>
          </feMerge>
        </filter>
      </defs>
      <g filter="url(#a)" transform="translate(17 16.723)" fill="none"
         fill-rule="evenodd">
        <circle fill="#FFF" cx="57.828" cy="58" r="57.264"/>
        <path
          d="M115.363 57.467a47.877 47.877 0 0 0-.046-1.61 57.486 57.486 0 0 0-.093-1.6 63.053 63.053 0 0 0-.135-1.587 69.409 69.409 0 0 0-.082-.79 38.01 38.01 0 0 1-.82 1.56 37.848 37.848 0 0 1-.905 1.527 37.8 37.8 0 0 1-2.062 2.966l-10.85 11.434-16.451 14.701h25.344a57.998 57.998 0 0 0 2.599-5.999 56.888 56.888 0 0 0 2.603-9.601 57.249 57.249 0 0 0 .898-11.001zm-86.021 1.746a1.7 1.7 0 0 1-.191.093c-.07.03-.145.056-.228.081a5.645 5.645 0 0 1-.582.135 12.248 12.248 0 0 1-.776.115l-.297.037-.299.038-.297.036-.298.038-.298.037-.298.037-.596.074a9.945 9.945 0 0 0-.58.092 5.47 5.47 0 0 0-.506.12c-.156.044-.3.095-.43.152-.132.057-.25.12-.356.191-.105.071-.198.15-.278.237a1.297 1.297 0 0 0-.32.63c-.027.125-.04.26-.04.405a1.422 1.422 0 0 0 .185.714c.061.108.136.208.223.301.087.094.188.18.301.257.113.078.237.147.373.208.136.06.283.112.44.154a3.853 3.853 0 0 0 1.051.129 6.107 6.107 0 0 0 1.69-.228 5.26 5.26 0 0 0 .746-.272 4.35 4.35 0 0 0 .652-.368c.2-.138.38-.29.54-.454a2.93 2.93 0 0 0 .41-.532 2.468 2.468 0 0 0 .35-1.268v-1.424a1.067 1.067 0 0 1-.291.235zm35.322 1.522c.076.243.171.479.29.702.118.225.258.438.422.635.164.198.352.379.565.54.212.16.45.302.715.418.265.117.558.208.878.27.32.064.669.098 1.048.098.38 0 .727-.034 1.047-.097a4.2 4.2 0 0 0 .878-.27 3.444 3.444 0 0 0 1.703-1.593 4.1 4.1 0 0 0 .29-.703c.075-.242.13-.492.167-.744a5.284 5.284 0 0 0-.167-2.26 4.128 4.128 0 0 0-.29-.702 3.66 3.66 0 0 0-.422-.634 3.444 3.444 0 0 0-1.28-.958 4.11 4.11 0 0 0-.879-.271 5.474 5.474 0 0 0-1.047-.096c-.38 0-.728.034-1.048.096a4.12 4.12 0 0 0-.878.27 3.503 3.503 0 0 0-.715.419 3.38 3.38 0 0 0-.565.54 3.64 3.64 0 0 0-.422.634c-.119.224-.214.46-.29.702a4.973 4.973 0 0 0-.168.744 5.42 5.42 0 0 0 0 1.516c.037.252.093.502.168.744zm-9.238-8.895h2.099v-2.337h-2.099v2.337zm0 12.96h2.099V53.668h-2.099V64.8zm-5.772 0h-2.133v-1.425h-.043a3.08 3.08 0 0 1-.353.414 3.69 3.69 0 0 1-.43.362 4.66 4.66 0 0 1-.493.31 5.642 5.642 0 0 1-1.123.458 6.697 6.697 0 0 1-1.846.262c-.421 0-.833-.033-1.229-.1a6.632 6.632 0 0 1-1.143-.294 5.97 5.97 0 0 1-1.033-.482 5.264 5.264 0 0 1-2.199-2.511 5.907 5.907 0 0 1-.353-1.171 6.983 6.983 0 0 1-.123-1.326c0-.467.043-.91.123-1.326.081-.417.2-.807.354-1.17a5.232 5.232 0 0 1 1.3-1.848 5.45 5.45 0 0 1 .898-.665 6 6 0 0 1 1.033-.482 6.67 6.67 0 0 1 1.143-.294 7.434 7.434 0 0 1 1.854-.071 6.672 6.672 0 0 1 1.224.224 5.434 5.434 0 0 1 1.117.45c.172.093.336.197.49.31.154.112.298.236.43.368s.253.273.36.425h.042v-5.715h2.133V64.8zm-16.302 0a7.46 7.46 0 0 1-.613.076 7.786 7.786 0 0 1-.215.018 7.648 7.648 0 0 1-.632.03l-.196.002a4.36 4.36 0 0 1-.38-.015 2.795 2.795 0 0 1-.344-.05 1.873 1.873 0 0 1-.307-.095 1.365 1.365 0 0 1-.266-.145 1.227 1.227 0 0 1-.4-.475 1.793 1.793 0 0 1-.13-.344 2.785 2.785 0 0 1-.082-.426 2.831 2.831 0 0 1-.373.406 3.77 3.77 0 0 1-.471.36 4.993 4.993 0 0 1-.551.309c-.195.094-.4.18-.613.258a7.748 7.748 0 0 1-1.344.352 8.505 8.505 0 0 1-1.381.12c-.462 0-.879-.03-1.255-.085a5.68 5.68 0 0 1-1.01-.236c-.298-.1-.56-.222-.788-.36a3.165 3.165 0 0 1-.593-.455 2.866 2.866 0 0 1-.688-1.087 3.238 3.238 0 0 1-.144-.574 4.122 4.122 0 0 1 .016-1.278c.04-.224.101-.433.186-.629.084-.195.192-.376.326-.543a2.66 2.66 0 0 1 .48-.461c.187-.141.401-.27.646-.385a5.89 5.89 0 0 1 .828-.31 9.622 9.622 0 0 1 1.021-.24c.375-.07.783-.128 1.229-.176l.303-.032.302-.032.303-.031.302-.032.302-.032.303-.032.302-.032.303-.032c.148-.016.29-.033.424-.053.134-.02.26-.042.379-.07a2.7 2.7 0 0 0 .33-.093 1.68 1.68 0 0 0 .278-.126c.084-.049.158-.104.223-.168a.927.927 0 0 0 .163-.216 1.05 1.05 0 0 0 .1-.273 1.882 1.882 0 0 0-.033-.856 1.39 1.39 0 0 0-.493-.733 1.943 1.943 0 0 0-.397-.237 2.95 2.95 0 0 0-.478-.165 4.583 4.583 0 0 0-.544-.104 7.396 7.396 0 0 0-.595-.055 11.724 11.724 0 0 0-.63-.016 8.13 8.13 0 0 0-.67.025 6.235 6.235 0 0 0-.629.078 4.306 4.306 0 0 0-.575.143 2.99 2.99 0 0 0-.507.214 2.22 2.22 0 0 0-.423.294 1.837 1.837 0 0 0-.543.866 2.427 2.427 0 0 0-.092.59h-1.995c.034-.348.094-.67.18-.966.085-.295.195-.566.33-.813a3.396 3.396 0 0 1 1.103-1.198c.232-.155.488-.288.767-.4a5.84 5.84 0 0 1 .91-.277 8.453 8.453 0 0 1 1.046-.16 12.42 12.42 0 0 1 1.183-.053c.283 0 .576.009.87.03.297.02.594.053.887.1.293.047.581.109.859.188.277.08.544.176.792.293.249.116.48.254.687.414a2.482 2.482 0 0 1 .892 1.26c.082.264.127.556.127.88v5.99c0 .083.005.16.014.231.01.072.024.137.043.197.019.06.043.115.071.165a.624.624 0 0 0 .236.235.74.74 0 0 0 .165.073c.06.019.125.032.197.042a1.612 1.612 0 0 0 .32.013l.094-.006.097-.008.098-.011a2.392 2.392 0 0 0 .19-.028 6.916 6.916 0 0 0 .173-.03v1.486zm-16.3-9.094l-.192-.045c-.062-.015-.123-.028-.184-.041a7.62 7.62 0 0 0-.535-.092 5.232 5.232 0 0 0-.584-.034c-.261 0-.512.02-.751.058-.24.038-.468.096-.683.173a3.259 3.259 0 0 0-.604.287 2.917 2.917 0 0 0-.934.916c-.12.19-.225.4-.309.628-.085.228-.15.475-.193.74-.044.265-.067.55-.067.853v5.65H9.91V53.668h2.107v2.038h.042c.124-.22.254-.423.39-.61.137-.186.278-.357.426-.512a4.388 4.388 0 0 1 .93-.75 3.925 3.925 0 0 1 2.047-.55 9.026 9.026 0 0 1 .506.013c.049.003.097.008.142.012a2.806 2.806 0 0 1 .271.039 3.429 3.429 0 0 1 .283.064v2.294zm45.273 2.351a6.2 6.2 0 0 1 .295-1.107c.131-.353.296-.692.493-1.009a5.274 5.274 0 0 1 1.584-1.62c.33-.217.695-.404 1.093-.558a6.85 6.85 0 0 1 1.294-.354c.466-.081.965-.124 1.498-.124s1.032.043 1.497.124c.465.08.897.2 1.294.354.398.154.762.341 1.093.558a5.263 5.263 0 0 1 1.584 1.62c.197.317.362.656.492 1.01.132.353.23.724.296 1.106.065.382.098.775.098 1.177 0 .4-.033.794-.098 1.176a6.195 6.195 0 0 1-.296 1.106 5.55 5.55 0 0 1-.492 1.01 5.264 5.264 0 0 1-1.584 1.62c-.33.216-.695.403-1.093.557a6.876 6.876 0 0 1-1.294.354 8.662 8.662 0 0 1-1.497.124 8.674 8.674 0 0 1-1.498-.124 6.944 6.944 0 0 1-1.294-.354 5.855 5.855 0 0 1-1.093-.558 5.314 5.314 0 0 1-.892-.735 5.307 5.307 0 0 1-.692-.885 5.609 5.609 0 0 1-.493-1.009 6.23 6.23 0 0 1-.295-1.106 6.955 6.955 0 0 1-.098-1.176c0-.402.032-.795.098-1.177zm-.108 26.011l29.752-27.651c.657-.613 1.312-1.23 1.958-1.854a64.827 64.827 0 0 0 1.898-1.902 40.334 40.334 0 0 0 1.774-1.98 28.195 28.195 0 0 0 1.589-2.082c.492-.715.943-1.451 1.343-2.214.4-.763.75-1.552 1.036-2.373a16.055 16.055 0 0 0 .902-5.33c0-.905-.08-1.78-.234-2.619a13.168 13.168 0 0 0-.68-2.402 12.218 12.218 0 0 0-1.091-2.145 11.53 11.53 0 0 0-3.27-3.355 11.744 11.744 0 0 0-2.107-1.128 12.469 12.469 0 0 0-2.377-.707 13.71 13.71 0 0 0-2.608-.245c-1.152 0-2.233.12-3.241.348a12.48 12.48 0 0 0-2.808.988c-.862.428-1.65.949-2.364 1.55-.713.6-1.352 1.281-1.913 2.03a13.77 13.77 0 0 0-1.453 2.427 15.876 15.876 0 0 0-.986 2.748c-.25.96-.42 1.958-.51 2.985a20.18 20.18 0 0 0-.026 3.142H61.283v-3.15a28.23 28.23 0 0 1 2.192-10.909 28.596 28.596 0 0 1 5.976-8.984 28.39 28.39 0 0 1 4.127-3.47 27.77 27.77 0 0 1 4.736-2.627 27.294 27.294 0 0 1 10.855-2.246h.172l.172.002.171.003.172.004.17.004.172.006.17.006.17.007a57.634 57.634 0 0 0-11.227-6.057A56.938 56.938 0 0 0 71.07 2.27 57.218 57.218 0 0 0 62.342.91a58.307 58.307 0 0 0-4.514-.175c-3.972 0-7.85.403-11.596 1.17a57.18 57.18 0 0 0-20.576 8.657 57.893 57.893 0 0 0-15.542 15.543 57.407 57.407 0 0 0-5.306 9.774A57.1 57.1 0 0 0 1.456 46.68a57.804 57.804 0 0 0-1.17 11.596c0 3.973.403 7.852 1.17 11.597a57.104 57.104 0 0 0 3.352 10.802 57.423 57.423 0 0 0 5.306 9.774 57.87 57.87 0 0 0 15.542 15.543 57.393 57.393 0 0 0 9.775 5.304 57.121 57.121 0 0 0 10.8 3.353 57.774 57.774 0 0 0 11.597 1.169 57.528 57.528 0 0 0 11.665-1.183 57.054 57.054 0 0 0 10.857-3.394 57.577 57.577 0 0 0 14.258-8.717 57.974 57.974 0 0 0 4.094-3.755H62.217v-14.7zM46.997 56.88a3.484 3.484 0 0 0-1.08-1.057 3.825 3.825 0 0 0-.707-.343 4.513 4.513 0 0 0-.805-.21 5.404 5.404 0 0 0-.894-.072c-.31 0-.606.024-.887.071a4.427 4.427 0 0 0-.797.21c-.25.094-.484.208-.7.344a3.488 3.488 0 0 0-1.069 1.057c-.138.216-.256.45-.351.702a4.412 4.412 0 0 0-.218.807 5.376 5.376 0 0 0-.016 1.689 4.417 4.417 0 0 0 .478 1.442c.122.22.266.427.432.617a3.4 3.4 0 0 0 .566.519c.212.153.448.287.707.397.26.11.543.197.852.255.309.06.643.09 1.003.09.363 0 .699-.03 1.01-.09.312-.058.598-.145.86-.255a3.45 3.45 0 0 0 1.724-1.533c.123-.22.224-.453.305-.695.08-.24.14-.491.18-.747a5.332 5.332 0 0 0-.016-1.688 4.382 4.382 0 0 0-.22-.808 3.701 3.701 0 0 0-.356-.702z"
          fill="#404040"/>
      </g>
    </svg>

    <?php echo '<a href="/"><h1>' . $title . '</h1></a>'; ?>
  </div>

  <div class="row content">
    <?php

    ?>

    <?php ?>

    <?php echo '<div class="songname-artist">'; ?>
    <?php echo '<div class="songname">' . $first_song->title . '</div>'; ?>
    <?php echo '<div class="artist">van ' . $first_song->name . '</div>'; ?>
    <small>stond op 1 in de Radio 2 Top 30 op de dag dat je <?php echo $leeftijd; ?> bent!
    </small>
    <?php echo '</div>'; ?>

    <?php
    if (isset($first_song->youtube_url)) {
      ?>
      <div class="mainvideobox">
        <iframe class="mainvideo" src="<?php echo $first_song->youtube_url; ?>"
                frameborder="0" allowfullscreen></iframe>
      </div>
      <?php
    }
    else {
      if (isset($first_song->audio_url)) {
        ?>
        <audio controls>
          <source src="<?php echo $first_song->audio_url; ?>" type="audio/mpeg">
          Your browser does not support the audio element.
        </audio>
        <?php
      }

    }
    ?>

    <?php
    if(isset($_GET['share'])) { ?>
    <center><a href="/">Ontdek jouw geboorteplaat!</a></center>
      <?php
    }else{
    ?>

      <center><?php echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode($cur_url) . '&share=fb">Deel op Facebook</a>'; ?></center>
      <center>
        <form METHOD="GET" ACTION="/older.php" >
          Wat stond er op 1 toen <?php echo $hijzij; ?>
          <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
          <select name="hoeveeljaar">
            <option>16</option>
            <option>18</option>
            <option>20</option>
            <option>30</option>
            <option>40</option>
            <option>50</option>
          </select>
          was?
          <input type="submit" value="Ontdet het hier">
        </form>
      </center>


      <?php
    }
    ?>


  </div>
  <div class="row content-bottom">
    <div class="content-bottom-left">
      <h2>Dit was de voorpagina</h2>
      <center><img
          src="http://hv.persgroep.be/hv/web/hln/papers/<?php echo $krantdate; ?>/HIGHRES">
      </center>
    </div>
    <div class="content-bottom-right">

      <h2>Dit was de top 30</h2>


      <?php
      echo '<ol>';
      foreach ($aftellijst->songs as $song) {
        //var_dump($first_song);
        echo '<li>';
        if (isset($song->image_url)) {
          echo '<img src="' . $song->image_url . '">';
        }

        echo $song->title . ' - ' . $song->name;

  //      if(!empty($song->audio_url)) {
  //        echo '<audio controls><source src="'. $song->audio_url.'" type="audio/mpeg">Your browser does not support the audio element.</audio>';
  //      }

        if (!empty($song->spotify_id)) {
          echo ' -  <a href="' . $song->spotify_id . '">Spotify</a>';
        }
        if (!empty($song->itunes_buy)) {
          echo ' <a href="' . $song->itunes_buy . '">Itunes</a>';
        }
        if (!empty($song->youtube_url)) {
          echo ' <a href="' . $song->youtube_url . '">Youtube</a>';
        }
        if(!empty($song->youtube_url)) {
          echo '<div><iframe class="mainvideo" src="'. $song->youtube_url. '"
                  frameborder="0" allowfullscreen></iframe></div>';
        }

        echo '</li>';
      }
      echo '</ol>';
      ?>

  </div>
  </div>

</div>
</body>


