<?php
//AIzaSyDg_69Q2DzWHLRySCeqIps6aehWbbAU1bos
require("configurations/db_connect.php");
function handleRoutes($route)
{
    if (empty($route)) {
    }
    else{
        header("Location:" . $route);
    }
}
function handleDelete(){
    global $db;
    $videoId = $_POST['deleteButton'];
    $sql = "DELETE FROM `videos` WHERE `videoId` = '$videoId'";
    mysqli_query($db, $sql);
    unset($_POST['deleteButton']);
}
function renderTr($video)
{
    $rowId = $video['id'];
    $title = $video['title'];
    $image = $video['imageUrl'];
    $timeSaved = $video['timeSaved'];
    $videoId = $video['videoId'];
    echo "
        <tr data-videoId='$videoId' class='videoRow'>
            <td>$rowId</td>
            <td>$title</td>
            <td>$videoId</td>
            <td>$image</td>
            <td>...</td>
            <td>$timeSaved</td>
            <td><form action='index.php' method='post'><button type='submit' class='btn brand' name='deleteButton' value='$videoId'>x</button></form></td>
        </tr>
        ";
}
if (isset($_POST['navbutton'])) {
    handleRoutes($_POST['navbutton']);
}
if (isset($_POST['deleteButton'])) {
    handleDelete();
}
$sql = "SELECT * FROM videos";
$res = mysqli_query($db, $sql);
$videos = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<?php include("templates/header.php") ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>VideoId</th>
        <th>ImageUrl</th>
        <th>Description</th>
        <th>TimeSaved</th>
        <th>DeleteButton</th>
    </tr>
    <?php array_map('renderTr', $videos) ?>
</table>
<?php include("templates/footer.php") ?>