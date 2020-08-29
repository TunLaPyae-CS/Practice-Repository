<?php
require('components/db_connect.php');

//--------------------------------------------------------------------------
function compareVideo($videoYoutube)
{
    $videoYoutubeId =  $videoYoutube->contentDetails->videoId;
    global $videosDatabase;
    global $videosToAdd;
    $videoExists = false;
    foreach ($videosDatabase as $videoDatabase) {
        if ($videoYoutubeId == $videoDatabase["videoId"]) {
            $videoExists = true;
        }
    }
    if (!$videoExists) {
        $formattedVideo = ['videoId' => '', 'imageUrl' => '', 'description' => '', 'title' => ''];
        $formattedVideo['title'] = $videoYoutube->snippet->title;
        $formattedVideo['description'] = substr($videoYoutube->snippet->description, 0, 350);
        $formattedVideo['imageUrl'] = $videoYoutube->snippet->thumbnails->medium->url;
        $formattedVideo['videoId'] = $videoYoutube->contentDetails->videoId;
        $videosToAdd[] = $formattedVideo;
    }
}
//This gets you Youtube Videos
function getVideosYoutubeApi($channelID, $maxresult)
{
    $json = file_get_contents('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=15&playlistId=UU_kHjyFSbgLvESmeLhxLB8g&key=AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo');
    $obj = json_decode($json);
    return $obj->items;
}
//This gets you Database Videos
function getVideosMysqlDatabase()
{
    $sql = "SELECT * FROM videos";
    global $db;
    $res = mysqli_query($db, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}
//This will construct an insert query for the new videos
function constructQuery($videos)
{
    $tempSql = "INSERT INTO `videos` (`videoId`, `imageUrl`, `description`,`title`) VALUES ";
    for ($i = 0; $i + 1 < count($videos); $i++) {
        $videoId = $videos[$i]['videoId'];
        $imageUrl = $videos[$i]['imageUrl'];
        $description =  $videos[$i]['description'];
        $title = $videos[$i]['title'];
        $tempSql = $tempSql . "('$videoId','$imageUrl','$description','$title'),";
    }
    $videoId = $videos[count($videos) - 1]['videoId'];
    $imageUrl = $videos[count($videos) - 1]['imageUrl'];
    $description =  $videos[count($videos) - 1]['description'];
    $title = $videos[count($videos) - 1]['title'];
    $tempSql = $tempSql . "('$videoId','$imageUrl','$description','$title')";
    return $tempSql;
}
$videosYoutube = getVideosYoutubeApi('UC_kHjyFSbgLvESmeLhxLB8g', 20);
$videosDatabase = getVideosMysqlDatabase();
$videosToAdd = [];
array_map('compareVideo', $videosYoutube);
$videosToAdd = array_reverse($videosToAdd);
if (!empty($videosToAdd)) {
    $sql = constructQuery($videosToAdd);
    mysqli_query($db, $sql);
    mysqli_close($db);
};
//--------------------------------------------------------------------------

require('components/db_connect.php');
function renderhtml($video)
{
    global $count;
    // $title =  $video->snippet->title;
    // $description = $video->snippet->description;
    // $imgurl = $video->snippet->thumbnails->medium->url;
    // $videourl = "https://www.youtube.com/watch?v=" .$video->id->videoId;
    $title =  $video['title'];
    $description = $video['description'];
    $imgurl = $video['imageUrl'];
    $videoId = $video['videoId'];
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
$sql = "SELECT * FROM videos ORDER BY id DESC LIMIT 15;
";
$res = mysqli_query($db,$sql);
$videos = mysqli_fetch_all($res, MYSQLI_ASSOC);
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