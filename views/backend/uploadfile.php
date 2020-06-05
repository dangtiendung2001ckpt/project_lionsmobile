<form action="index.php?module=backend&control=Product&action=fileProcessing" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="submit">
</form>
<?php
foreach (getFlashError() as $key){
    echo $key;
}

