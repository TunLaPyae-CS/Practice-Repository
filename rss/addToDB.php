<?php
// require('components/db_connect.php');
// //This adds videos on to the addVideos to add array
// function compareVideo($videoYoutube)
// {
//     $videoYoutubeId =  $videoYoutube->contentDetails->videoId;
//     global $videosDatabase;
//     global $videosToAdd;
//     $videoExists = false;
//     foreach ($videosDatabase as $videoDatabase) {
//         if ($videoYoutubeId == $videoDatabase["videoId"]) {
//             $videoExists = true;
//         }
//     }
//     if (!$videoExists) {
//         $formattedVideo = ['videoId' => '', 'imageUrl' => '', 'description' => '', 'title' => ''];
//         $formattedVideo['title'] = $videoYoutube->snippet->title;
//         $formattedVideo['description'] = substr($videoYoutube->snippet->description, 0, 350);
//         $formattedVideo['imageUrl'] = $videoYoutube->snippet->thumbnails->medium->url;
//         $formattedVideo['videoId'] = $videoYoutube->contentDetails->videoId;
//         $videosToAdd[] = $formattedVideo;
//     }
// }
// //This gets you Youtube Videos
// function getVideosYoutubeApi($channelID, $maxresult)
// {
//     $json = file_get_contents('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=15&playlistId=UU_kHjyFSbgLvESmeLhxLB8g&key=AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo');
//     $obj = json_decode($json);
//     return $obj->items;
// }
// //This gets you Database Videos
// function getVideosMysqlDatabase()
// {
//     $sql = "SELECT * FROM videos";
//     global $db;
//     $res = mysqli_query($db, $sql);
//     return mysqli_fetch_all($res, MYSQLI_ASSOC);
// }
// //This will construct an insert query for the new videos
// function constructQuery($videos)
// {
//     $tempSql = "INSERT INTO `videos` (`videoId`, `imageUrl`, `description`,`title`) VALUES ";
//     for ($i = 0; $i + 1 < count($videos); $i++) {
//         $videoId = $videos[$i]['videoId'];
//         $imageUrl = $videos[$i]['imageUrl'];
//         $description =  $videos[$i]['description'];
//         $title = $videos[$i]['title'];
//         $tempSql = $tempSql . "('$videoId','$imageUrl','$description','$title'),";
//     }
//     $videoId = $videos[count($videos) - 1]['videoId'];
//     $imageUrl = $videos[count($videos) - 1]['imageUrl'];
//     $description =  $videos[count($videos) - 1]['description'];
//     $title = $videos[count($videos) - 1]['title'];
//     $tempSql = $tempSql . "('$videoId','$imageUrl','$description','$title')";
//     return $tempSql;
// }
// $videosYoutube = getVideosYoutubeApi('UC_kHjyFSbgLvESmeLhxLB8g', 20);
// $videosDatabase = getVideosMysqlDatabase();
// $videosToAdd = [];
// array_map('compareVideo', $videosYoutube);
// if (!empty($videosToAdd)) {
//     $sql = constructQuery($videosToAdd);
//     mysqli_query($db, $sql);
//     mysqli_close($db);
//     var_dump($sql);
// };

