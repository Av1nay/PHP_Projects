<?php
session_start();
include 'header.php';

echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><hr>';

?>
<style>
    th{
        text-align: right;
    }
</style>
<form action="insert_commit.php" method="post">
	<table align="center">
		<tr>
			<th>Moviename:</th>
            <td><input tyep="text" name="moviename" required></td>

		</tr>
        <tr>
            <th>Genre:</th>
            <td>
                <select name="genre">
	                <?php
	                $query_to_select_movietype = 'select * from movietype order by movietype_label';
	                $execute_query_to_select_movietype = mysqli_query($connect_db_movie_review,$query_to_select_movietype) or die($connect_db_movie_review);
	                $movie_type ='';
	                while ($result_of_execute_query_to_select_movietype = mysqli_fetch_object($execute_query_to_select_movietype)){
		                if ($result_of_execute_query_to_select_movietype -> movietype_id !== $movie_type){
			                echo '<option value="'.$result_of_execute_query_to_select_movietype -> movietype_id.'">';
		                }
		                echo ucwords($result_of_execute_query_to_select_movietype -> movietype_label.'</option>');
	                }
	                ?>

                </select>
            </td>
        </tr>
        <tr>
            <th>Year Of Released:</th>
            <td>
                <select name="year" >
                    <?php
                        for ($y= date("Y"); $y>=1900; $y--){
                            echo '<option>'.$y;
                        }
                    ?>
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Movie Running Time:</th>
            <td>
                <input type="time" name="running_time">
            </td>
        </tr>
        <tr>
            <th><label>Actor:</label></th>
            <td>
                <select name="actor">
                    <option value="actor_value" selected>Select actor</option>
                    <?php
                        $select_actors_query = 'select people_id, people_fullname from people where people_is_actor =1 order by people_fullname asc' ;
                        $execute_select_actors_query = mysqli_query($connect_db_movie_review,$select_actors_query);
                        $actor_list = '';
                        while($result_of_execute_select_actors_query = mysqli_fetch_object($execute_select_actors_query)){
                            if ($result_of_execute_select_actors_query -> people_id !== $actor_list){
                                echo '<option value="'.$result_of_execute_select_actors_query -> people_id.'">';
                            }
                            echo ucwords($result_of_execute_select_actors_query -> people_fullname.'</option>');
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Director:</th>
            <td>
                <select name="director">
                    <option value="director_value" selected>Select director</option>
                    <?php
                        $select_director_query = 'select people_id, people_fullname from people where people_is_director =1 order by people_fullname asc';
                        $execute_select_director_query = mysqli_query($connect_db_movie_review, $select_director_query);
                        $director_list ='';
                        while ($result_of_execute_select_director_query = mysqli_fetch_object($execute_select_director_query)) {
	                        if ( $result_of_execute_select_director_query->people_id != $director_list ) {
		                        echo '<option value= "' . $result_of_execute_select_director_query->people_id . '">';
	                        }
	                        echo ucwords($result_of_execute_select_director_query->people_fullname . '</option>');
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="ADD" >
            </td>
        </tr>
	</table>
</form>
</body>
</html>
<?php include 'footer.php';?>
