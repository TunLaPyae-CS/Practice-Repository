<?php
//AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo
function renderhtml($video)
{
    // $title =  $video->snippet->title;
    // $description = $video->snippet->description;
    // $imgurl = $video->snippet->thumbnails->medium->url;
    // $videourl = "https://www.youtube.com/watch?v=" .$video->id->videoId;
    $title =  $video->snippet->title;
    $description = substr($video->snippet->description,0,350);
    $imgurl = $video->snippet->thumbnails->medium->url;
    $videourl = "https://www.youtube.com/watch?v=" . $video->snippet->contentDetails->videoId;
}
function getVideos($channelID, $maxresult)
{
    $json = file_get_contents( 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=15&playlistId=UU_kHjyFSbgLvESmeLhxLB8g&key=AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bo');
    $obj = json_decode($json);
    return $obj->items;
}
$videos = getVideos('UC_kHjyFSbgLvESmeLhxLB8g', 20);
// array_map('renderhtml',$videos);
var_dump($videos);
