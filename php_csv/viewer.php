<?php 
    session_start();
    if(!isset($_SESSION['csv'])){
        header('location: index.html');
        die();
    } elseif (!isset($_GET['page'])){
        $csv = $_SESSION['csv'];
        $page = 0;
        $pagecount = ceil(count($csv)/50);
    } else {
        $csv = $_SESSION['csv'];
        $page = $_GET['page'];
        $pagecount = ceil(count($csv)/50);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta charset="UTF-8">
    	<title>PHP with MySQL - Advanced CSV</title>
    	<meta name="description" content="PHP with MySQL - 07/11/14 - Advanced CSV">
    	<link rel="stylesheet" type="text/css" href="csv-style.css">
    </head>
    <body>
        <div id="container">
        	<div id="wrapper">
        		<div id="title">
                    <h1>File Upload and CSV Manipulation</h1>
                </div><!-- end of title -->
                <div id="body">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <?php
                                    foreach($csv[0] as $header){
                                        echo "<th>" . $header . "</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($i=1+(50*$page); $i<51+(50*$page); $i++){
                                    if(isset($csv[$i])){
                                        echo "<tr>";
                                        echo "<td class='bold'>" . $i . "</td>";
                                        foreach($csv[$i] as $tablevalue){
                                            echo "<td>" . $tablevalue . "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div> <!--end body -->
                <div id="footer">
                    <p>
                        <?php
                            $prev = $page-1;
                            $next = $page+1;
                            if($page!=0){
                                echo "<a href='viewer.php?page=" . $prev . "' class='prev'>Previous Page</a>";  
                            }
                            echo "<span class='bold'>Current Page:  " . $next . "</span>";
                            if ($page+1!=$pagecount){
                                echo "<a href='viewer.php?page=" . $next . "' class='prev'>Next Page</a>";
                            }
                        ?>
                    </p>
                </div><!-- end of footer -->
        	</div>  <!-- end wrapper -->
        </div><!-- end of container -->
    </body>
</html>