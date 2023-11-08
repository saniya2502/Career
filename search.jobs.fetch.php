<?php 
	
	//Including database connection files to the page.
	require 'db.connect.php';
	
	if(isset($_POST['search_keyword']) || isset($_POST['search_location']) || isset($_POST['search_salary_ddl']) || 
		isset($_POST['search_exp']) || isset($_POST['search_func_area_ddl']) || isset($_POST['search_industry_type_ddl']))
	{
	if(empty($_POST['search_keyword']) &&  empty($_POST['search_location']) && empty($_POST['search_salary_ddl']) && 
			empty($_POST['search_exp']) && ($_POST['search_func_area_ddl'] == -1) && ($_POST['search_industry_type_ddl'] == -1))
		{
			echo '<script> alert("Enter atleast any field for desire search"); </script>';
			echo '<script> window.location.href = "search.jobs.php"; </script>';
		}
			
		else if(!empty($_POST['search_keyword']) || !empty($_POST['search_location']) || !empty($_POST['search_salary_ddl']) || 
			!empty($_POST['search_exp']) || !empty($_POST['search_func_area_ddl']) || !empty($_POST['search_industry_type_ddl']))
		{
			//Initializing variables with the user inputs.
			$searchCriteria = array();

if (!empty($_POST['search_keyword'])) {
    $key = $_POST['search_keyword'];
    $searchCriteria[] = "key_skill LIKE '%$key%'";
}

if (!empty($_POST['search_location'])) {
    $location = $_POST['search_location'];
    $searchCriteria[] = "location='$location'";
}

if (!empty($_POST['search_salary_ddl'])) {
    $salary = $_POST['search_salary_ddl'] * 100000;
    $searchCriteria[] = "ctc='$salary'";
}

if (!empty($_POST['search_exp'])) {
    $experience = $_POST['search_exp'];
    $searchCriteria[] = "experience='$experience'";
}

if (!empty($_POST['search_func_area_ddl'])) {
    $func_area = $_POST['search_func_area_ddl'];
    $searchCriteria[] = "func_area='$func_area'";
}

if (!empty($_POST['search_industry_type_ddl'])) {
    $industry_type = $_POST['search_industry_type_ddl'];
    $searchCriteria[] = "industry_type='$industry_type'";
}

// Construct the WHERE clause of the query
$whereClause = implode(' OR ', $searchCriteria);

// Query which is going to execute for database manipulation
$query = "SELECT * FROM job_details";
if (!empty($whereClause)) {
    $query .= " WHERE $whereClause";
}
			$query_search = mysqli_query($conn,$query);
						
				echo '	<table border="1">
							<tr>
								<td><center><b>Name</center></b></td>
								<td><center><b>Profile</b></center></td>
								<td><center><b>Key Skill</b></center></td>
								<td><center><b>Location</b></center></td>
								<td><center><b>CTC</b></center></td>
								<td><center><b>More</b></center></td>
							</tr>
						</table>';
				
						$query_rows_num = mysqli_num_rows($query_search);
			if($query_rows_num > 0)
			{		
				while($query_search_result = mysqli_fetch_array($query_search))
				{	
					echo '	<table border="1">
								<tr>
									<td><center>'.$query_search_result['name'].'</center></td>
									<td><center>'.$query_search_result['profile'].'</center></td>
									<td><center>'.$query_search_result['key_skill'].'</center></td>
									<td><center>'.$query_search_result['location'].'</center></td>
									<td><center>'.$query_search_result['ctc'].'</center></td>
									<td><center>';								
							
							echo	'<a href="search.jobs.view.php" onClick="MyWindow=window.open('."'search.jobs.view.php?id="
									.$query_search_result['id']."', '_window');".'return false;">	
										Click for Details			
									</a>
									</center></td>
								</tr>';		
				echo'	</table>';
				}
			}
			else
			{	echo '<script> alert("No result Found. Search with different keywords"); </script>';	}
		}
	}
