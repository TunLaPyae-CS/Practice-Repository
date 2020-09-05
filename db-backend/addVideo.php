<?php
require('configurations/db_connect.php');
$videoId = '';
$error = ['videoId' => ''];
if (isset($_POST['submit'])) {
    if (empty($_POST['videoId'])) {
        $error['videoId'] = "VideoId field is empty";
    }
    if (array_filter($error)) {
    } else {
        $videoId = $_POST['videoId'];
        // $postSql = "INSERT INTO `videos` (`id`, `email`, `username`, `password`) VALUES (NULL, '$email' , '$username', '$hashedpassword')";
        
        $getSql = "SELECT * FROM `videos` WHERE videoId = '$videoId'";
        $res = mysqli_query($db, $getSql);
        $videos = mysqli_fetch_all($res,MYSQLI_ASSOC);
        if(!empty($videos)){
            $error['videoId'] = 'This video already exists in our database';
        }
        else{
            $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails&id='.$videoId.'&key=AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo';
            $json = file_get_contents($url);
            $obj = json_decode($json);
            if(empty($obj->items)){
                $error['videoId'] = 'This video doesn\'t exist on youtube';
            }
            else{
                $videoYoutube = $obj->items[0];
                $videoId =  $videoYoutube->id;
                $imageUrl = $videoYoutube->snippet->thumbnails->medium->url;
                $description =  substr($videoYoutube->snippet->description, 0, 100);
                $title = $videoYoutube->snippet->title;
                $postSql = "INSERT INTO `videos` (`videoId`, `imageUrl`, `description`,`title`) VALUES ('$videoId','$imageUrl','$description','$title')";
                mysqli_query($db,$postSql);
                header("Location: index.php");
            }  
        }
    }
}
?>
<?php include("templates/header.php") ?>
<section class="container grey-text">
    <h4 class="center">Add Video</h4>
    <form action="addVideo.php" class="white" method="POST" style=" margin: auto !important">
        <label for="videoId">VideoId : </label>
        <input type="text" name="videoId" value="<?php echo $videoId; ?>">
        <div class="red-text"><?php echo $error['videoId']; ?></div>
        <div class="center"><button type="submit" name="submit" class="btn brand" value="submit">Submit</button></div>
    </form>
</section>
<?php include("templates/footer.php") ?>