


<?php
    include ('dbconn.php');
    $id = $_GET["id"];
error_reporting(0);

?>

<!DOCTYPE HTML>
<html>
    <head><link rel="stylesheet" type="text/css" href="formstyle.css">



    </head>
    <body>

        
        <?php 
            include ('dbconn.php');

                $post = "SELECT * FROM BlogPosts WHERE id='$id' LIMIT 1 ";
                $result = $conn->query($post);

           

                if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()) {

                        $naam = $row['Naam'];
                        $title = $row['Title'];
                        $text = $row['Blogtext'];
                        $tags = $row['Tag_id'];
           


                            echo "<form action='editblog.php?id=$id' method='post'>";
                            echo "Name:";
                            echo "<br>";
                            echo "<input type='text' name='naam' placeholder='Naam' value='$naam'>";
                            echo "<br>";
                            echo "Title:";
                            echo "<br>";
                            echo "<input type='text' name='title' placeholder='Title' value='$title'>";
                            echo "<br>";
                            echo "Blogtext";
                            echo "<br>";
                            echo "<textarea name='blogtext' cols='32' rows='4' placeholder='plaats hier je  blog bericht.'>$text</textarea>";
                            echo "<br>";
                            echo "Gekoze tags zijn:";
                            echo $tags;
                            
                            $tag = "SELECT * FROM Tags";
                            $result = $conn->query($tag);

                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
//                                    $tags = $row['Tag_id'];
                                    echo "<input type='radio' name='taged' value='$tags'>";
                                    echo $row['Tag'];
                                }
                            }
                            echo "<br>";
                            echo "<input name='update' type='submit' value='Update'>";
                            echo "<input name='reset' type='reset' value='Reset'>";
                            echo "</form>";
                      }
                    }
        ?>

    </body>
</html>



<?php 

    if (isset($_POST['update'])){
        if (!empty($_POST['naam']) && $_POST['title'] && $_POST['blogtext'] && $_POST['taged']){
            $naam = $_POST['naam'];
            $title = $_POST['title'];
            $text = $_POST['blogtext'];
            $taged = $_POST['taged'];
            $up = 
            "UPDATE `BlogPosts` SET `Naam` = '$naam', `Title` = '$title', `Blogtext` = '$text', `tijd` = CURRENT_TIME(), `Tag_id` = '$taged'  WHERE `BlogPosts`.`id`= $id";
            
            
            mysqli_query($conn, $up);
            header("location:viewblog.php");
            
        }
        else {
            echo "er ging wat fout";
        }
    }


$conn->close();

?>

