<?php
$count = 3;
//AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo
function renderhtml($video)
{
    global $count;
    // $title =  $video->snippet->title;
    // $description = $video->snippet->description;
    // $imgurl = $video->snippet->thumbnails->medium->url;
    // $videourl = "https://www.youtube.com/watch?v=" .$video->id->videoId;
    $title =  $video->snippet->title;
    $description = substr($video->snippet->description, 0, 350);
    $imgurl = $video->snippet->thumbnails->medium->url;
    $videourl = "https://www.youtube.com/watch?v=" . $video->contentDetails->videoId;
    $videoId = $video->contentDetails->videoId;
    $cardDiv = "
    <div class='col l4 m4 s12'>
    <div class='card sticky-action'>
        <div class='card-image'>
            <img src=" . $imgurl . " alt='youtube thumbnail'>
            <a href='#' class='btn red btn-floating halfway-fab pulse activator'>+</a>
        </div>
        <div class='card-content setheight'>
            <p>" . $title . "</p>
        </div>
        <div class='card-reveal'>
            <span class='card-title'>Description<i class='right'>x</i></span>
            <p>" . $description . "</p>
        </div>
        <div class='card-action popupClick '>
            <a data-videoId ='$videoId'>Watch</a>
        </div>
    </div>
    </div>
    ";
    if($count % 3 == 0){
        echo "<div class='row'> $cardDiv";
    }
    else if ($count % 3 == 2){
        echo "$cardDiv </div>";
    }
    else{
        echo $cardDiv;
    }
    $count++;
}
function getVideos($channelID, $maxresult)
{
    $json = file_get_contents('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=15&playlistId=UU_kHjyFSbgLvESmeLhxLB8g&key=AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo');
    $obj = json_decode($json);
    return $obj->items;
}
$videos = getVideos('UC_kHjyFSbgLvESmeLhxLB8g', 20);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./materialize/css/materialize.css">
    <style>.setheight{width:100%;height:6rem} .iframepopup{position:absolute; left: 30vw; top:20vh; z-index:5; padding-bottom: 3em; background-color: black;} </style>
</head>

<body SameSite = "none">
    <nav>
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Blog System
            </a>
        </div>
    </nav>
    <div class="container">
        <div id='popup'></div>
            <?php
            array_map('renderhtml', $videos);
            ?>
    </div>
    <footer class="section">
        <div class="center grey-text">CopyRight temporarily by lapyae</div>
    </footer>
    <script src="./materialize/js/materialize.js"></script>
    <script src="script.js"></script>
</body>

</html>