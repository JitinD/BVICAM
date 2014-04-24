<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/19/14
 * Time: 6:46 PM
 */

//require_once "Announcement/Announcement_All.php";

//$obj = new Announcement_All();

class Announcement {
    public $id;
    public $content;
    public $date;
    public $time;
    public $categoryId;
    public $groupId = array();
    public $tagId = array();
}

function getAllAnnouncements() {
    require_once("Announcement/Announcement_All.php");
    require_once("Announcement/Announcement_Map_All_Group.php");
    require_once("Announcement/Announcement_Map_All_Tag.php");
    $allAnn = array();
    $obj = new Announcement_All();
    $records = $obj->retrieveRecord();
    foreach($records as $record) {
        $annObj = new Announcement();
        $annObj->id = $record['AnnouncementId'];
        $annObj->content = $record['Content'];
        $annObj->date = $record['Date'];
        $annObj->time = $record['Time'];
        $annObj->categoryId = $record['CategoryId'];

        $mapAllGroupObj = new Announcement_Map_All_Group();
        $groups = $mapAllGroupObj->retrieveRecord(null, "AnnouncementId='$annObj->id'");
        foreach($groups as $group) {
            array_push($annObj->groupId, $group['GroupId']);
        }
        $mapAllTagObj = new Announcement_Map_All_Tag();
        $tags = $mapAllTagObj->retrieveRecord(null, "AnnouncementId='$annObj->id'");
        foreach($tags as $tag) {
            array_push($annObj->tagId, $tag['TagId']);
        }
        array_push($allAnn, $annObj);
    }
    return $allAnn;
}

//require_once("Announcement.php");
$allAnn = new Announcement();
$allAnn = getAllAnnouncements();
foreach($allAnn as $ann) {
    foreach($ann as $col=>$val){
        if(is_array($val)) {
            echo $col . " => ";
            foreach($val as $v) {
                echo $v . ", ";
            }
            echo "<br>";
        }
        else {
            echo $col . " => " . $val;
            echo "<br>";
        }
    }
    echo "<br>";
}