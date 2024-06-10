<?php
                    //pagination;
                    if($numpg>1){
                        echo "<div class='pagination pagination-sm justify-content-end rounded'>";
                        if($pg>1){
                            //prev
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>Prev</a></div>";
                        }
                        if($pg>3){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg-2>0){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-2); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg-2)."</a></div>";
                        }
                        if($pg-1>0){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg-1)."</a></div>";
                        }
                        echo "<div class='page-item active'>
                        <a class='page-link' href=''>".$pg."</a></div>";
                        if($pg+1<=$numpg){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg+1)."</a></div>";
                        }
                        if($pg+2<=$numpg){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+2); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg+2)."</a></div>";
                        }
                        if($pg < $numpg-2){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg < $numpg){
                            //next
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+1);
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; } 
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>Next</a></div>";
                        }
                        echo "</div>";
                    }
                    ?>