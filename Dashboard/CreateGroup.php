<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/20/14
 * Time: 12:46 AM
 */
require_once "../Models/Announcement/Announcement_Group.php";
$obj = new Announcement_Group();
if($obj->captureData()) {
    $obj->insertRecord();
}
else {
    echo "Enter Group Details";
}
?>

<html>
<head><title>Create Group</title></head>
<body>
<?php
$obj->buildForm("POST");
?>
</body>
</html>