<?php
include_once('init.php');
?>
<?php top('Forum Board');
headerInit(); ?>
    <div class="container_contents">
        <div class="wrapper">
            <form action="writeFinal.php" method="post">
                <div class="nav">
                    <a class="btn" href="delete.php">Create</a>
                    <a class="btn" href="index.php">Cancel</a>
                </div>
                <div class="editView">
                    <div class="view-title">
                        <input class="inputBoxTitle" name="Title" type="text" required>
                    </div>
                    <div class="view-content">
                        <textarea class="inputBoxContent" rows="25" required></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php footerInit(); ?>