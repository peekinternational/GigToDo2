<?php


@session_start();

if(!isset($_SESSION['admin_email'])){
	
echo "<script>window.open('login','_self');</script>";
	
}else{
    
	
?>

<?php

$directory = "../conversations/conversations_files/";

$handle = opendir($directory);

$restircted = array(".","..","Thumbs.db");

while($file = readdir($handle)){
	
if(!in_array($file, $restircted)){
	
$files_array[] = $file;
	
}
	
}

$count = 0;

$limit = 3;

$page = 1;

/// Page will start from 0 and multiply by per page

$start = ($page - 1) * $limit;




?>


    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1><i class="menu-icon fa fa-file"></i>Files</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">All Inbox Files</li>
                    </ol>
                </div>
            </div>
        </div>

    </div>


    <div class="container">
    
    <div class="row"><!--- 2 row Starts --->

<?php

if(count(glob("$directory/*")) === 0) { 

}else{

for($i = $start; $i < count($files_array); $i++){

$count ++;

?>

    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
        <!--- col-lg-3 col-md-4 col-sm-6 mb-3 Starts --->

        <div class="card">
            <!--- card Starts --->

            <div class="card-header">
                <!--- card-header Starts --->

                <?php echo $files_array[$i]; ?>

            </div>
            <!--- card-header Ends --->

            <div class="card-body text-center">
                <!--- card-body text-center Starts --->

                <?php

if(exif_imagetype('../conversations/conversations_files/' . $files_array[$i]) == IMAGETYPE_JPEG or  exif_imagetype('../conversations/conversations_files/' . $files_array[$i]) == IMAGETYPE_PNG or exif_imagetype('../conversations/conversations_files/' . $files_array[$i]) == IMAGETYPE_GIF){

?>

                    <img src="../conversations/conversations_files/<?php echo $files_array[$i]; ?>" class="img-fluid">

                    <?php }else{ ?>

                    <i class="fa fa-file-code fa-5x"></i>

                    <?php } ?>

            </div>
            <!--- card-body text-center Ends --->

            <div class="card-footer">
                <!--- card-footer Starts --->


                <a href="../conversations/conversations_files/<?php echo $files_array[$i]; ?>" download class="float-left">

<i class="fa fa-download"></i> Download

</a>

                <a href="index?delete_inbox_file=<?php echo $files_array[$i]; ?>" class="float-right">

<i class="fa fa-trash-alt"></i> Delete

</a>


            </div>
            <!--- card-footer Ends --->

        </div>
        <!--- card Ends --->

    </div>
    <!--- col-lg-3 col-md-4 col-sm-6 mb-3 Ends --->

    <?php

if($limit == $count){
	
break;
	
}

?>

        <?php } } ?>

        </div>
        <!--- 2 row Ends --->


        <div class="row">
            <!--- 3 row Starts --->

            <div class="col-lg-12">
                <!--- col-lg-12 Starts --->

                <ul class="pagination d-flex justify-content-center">
                    <!--- pagination d-flex justify-content-center Starts --->

                    <?php

            /// Using ceil function to divide the total records on per page

            $total_pages = ceil(count(@$files_array) / $limit);

            echo "

            <li class='page-item'>

            <a href='index?inbox_files_pagination=1' class='page-link'> First Page </a>

            </li>

            ";

            for($i=1; $i<=$total_pages; $i++){

            echo "

            <li class='page-item'>

            <a href='index?inbox_files_pagination=".$i."' class='page-link'>".$i."</a>

            </li>

            ";

            }

            echo "

            <li class='page-item'>

            <a href='index?inbox_files_pagination=$total_pages' class='page-link'> Last Page </a>

            </li>

            ";



            ?>

                            </ul>
                            <!--- pagination d-flex justify-content-center Ends --->

                        </div>
                        <!--- col-lg-12 Ends --->

                    </div>
                    <!--- 3 row Ends --->

                    </div>


                    <?php } ?>