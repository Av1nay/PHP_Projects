<?php
    include 'db_ch03-1.php';
	if ($_GET['action'] == 'edit'){
	    //retrieve the record's information
        $select_movie_query = 'select movie_name, movie_type, movie_year, movie_leadactor, movie_director from movie where movie_id='.$_GET['id'];
        $select_movie_result = mysqli_query($conn, $select_movie_query) or die(mysqli_error($conn));
        extract(mysqli_fetch_assoc($select_movie_result));
    }else{
	    //set values to blank
        $movie_name = '';
        $movie_type = 0;
        $movie_year = date('Y');
        $movie_leadactor = 0;
        $movie_director = 0;
    };

    echo '
    <html>
    <head>
        <title>'.ucfirst($_GET['action']).' Movie</title>
    </head>
    <body>
    <!--<form action="commit.php?action=add&type=movie" method="post">-->
    <form action="commit.php?action='.$_GET['action'].'&type=movie" method="post">
    <!--<form action="#" method="post">-->
        <table>
            <tr>
                <td>Movie Name</td>
                <td><input type="text" name="movie_name" value="'.$movie_name.'" placeholder="Type movie name to add"></td>
            </tr>
            <tr>
                <td>Movie Type</td>
                </td><td><select name="movie_type">';
                            //select the movie type information
                        $movie_type_query = 'select movietype_id, movietype_label from movietype order by movietype_label';
                        $movie_type_result = mysqli_query($conn, $movie_type_query) or die(mysqli_error($conn));
                        //populate the select options with the results
                        while ($movie_type_row = mysqli_fetch_object($movie_type_result)){
                            if ($movie_type_row->movietype_id == $movie_type){
                                echo '<option value="'.$movie_type_row->movietype_id.'" selected ="selected">';
                            }else{
                                echo '<option value ="'.$movie_type_row->movietype_id.'">';
                            }
                            echo $movie_type_row->movietype_label.'</option>';
                        }
                    echo '</select></td>
            </tr>
            <tr>
                <td>Movie Year</td>
                <td><select name="movie_year">';
                            //populate the select options with years
                        for ($year= date("Y"); $year>=1970;$year--){
                            if ($year == $movie_year){
                                echo '<option value="'.$year.'"selected="selected">'.$year.'</option>';
                            }else{
                                echo '<option value ="'.$year.'">'.$year.'</option>';
                            }

                        }
                    echo '</select> </td>
            </tr>
            <tr>
                <td>Lead Actor</td>
                <td><select name="movie_leadactor">';
                            // select actors
                        $people_is_actor_query = 'select people_id, people_fullname from people where people_is_actor = 1 order by people_fullname';
                        $people_is_actor_result = mysqli_query($conn, $people_is_actor_query) or die(mysqli_error($conn));

                        //populate the select options with the results
                        while ($people_is_actor_row = mysqli_fetch_object($people_is_actor_result)) {
                            if ($people_is_actor_row->people_id==$movie_leadactor){
                                echo '<option value="'.$people_is_actor_row->people_id.'"selected="selected">';
                            }else{
                                echo '<option value="' . $people_is_actor_row->people_id . '">';
                            }
                            echo $people_is_actor_row->people_fullname . '</option>';
                        }
                    echo '</select>
                </td>
            </tr>
            <tr>
                <td>Director</td>
                <td>
                    <select name="movie_director">';
                            $people_is_director_query = 'select people_id, people_fullname from people where people_is_director = 1 order by people_fullname';
                        $people_is_director_result = mysqli_query($conn,$people_is_director_query) or die(mysqli_error($conn));
                            //populate the select options with the results
                        while($people_is_director_row = mysqli_fetch_object($people_is_director_result)){
                            if ($people_is_director_row->people_id==$movie_director){
                                echo '<option value="'.$people_is_director_row->people_id.'"selected="selected">';
                            }else{
                                echo '<option value="'.$people_is_director_row->people_id.'">';
                            }
                                echo $people_is_director_row->people_fullname.'</option>';
                        }
                    echo '</select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">';
                if($_GET['action']=='edit'){
                    echo '<input type ="hidden" value="'.$_GET['id'].'" name="movie_id" />';
                }
                    echo '<input type="submit" name="submit" value="'.ucfirst($_GET['action']).'">
    
                </td>
            </tr>
        </table>
    </form>
    </body>
    </html>';
?>
