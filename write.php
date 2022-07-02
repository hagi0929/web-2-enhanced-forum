<?php
include_once('init.php');
?>
<?php top('Forum Board');
headerInit(); ?>

    <script src="main.js"></script>
    <div class="container_contents">
        <div class="wrapper">
            <form action="writeFinal.php" method="post" id="writeFinalSubmit">
                <div class="nav">
                    <a class="btn" href="javascript:Submit('writeFinalSubmit',['inputBoxTitleWrite', 'inputBoxContentWrite'])">Create</a>
                    <a class="btn" href="index.php">Cancel</a>
                </div>
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