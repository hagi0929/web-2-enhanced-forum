<?php
include_once('init.php');
if (isset($_SESSION['user'])){
    $setUsername= $_SESSION['user']['userId'];
}
else{
    $setUsername= 0;
}
top('Forum Board');
headerInit();
navigator();
?>

    <script src="main.js"></script>
    <div class="container_contents">
        <div class="wrapper">
            <form action="writeFinal.php" method="post" id="writeFinalSubmit">
                <div class="nav">
                    <a class="btn" href="javascript:Submit('writeFinalSubmit',['inputBoxTitleWrite', 'inputBoxContentWrite'])">Create</a>
                    <a class="btn" href="index.php">Cancel</a>
                </div>
                <input type="hidden" name="authorID" value="<?=$setUsername?>">
                <div class="editView">
                    <div class="view-title">
                        <input class="inputBoxTitle" id = "inputBoxTitleWrite" name="Title" type="text" placeholder="Title" required>
                    </div>
                    <div class="view-content">
                        <textarea class="inputBoxContent" id = "inputBoxContentWrite" name="Content" rows="25"  placeholder="Content" required></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php footerInit(); ?>