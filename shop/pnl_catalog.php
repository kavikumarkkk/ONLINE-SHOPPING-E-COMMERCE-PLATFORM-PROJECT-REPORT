<?php
session_start();
include ('../db.php');
$usr_id = $_SESSION['sess_id'];

if(!isset($_SESSION["sess_id"])) {
	header ('location: ../index');
} else {
	if ($_SESSION["sess_status"] != 'shop') {
		header ('location: ../index');
	} 
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../favicon.ico">
	<title>shop@fds</title>
	<link rel="stylesheet" href="../bootstrap/css/all.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script src="../bootstrap/js/jquery-3.4.1.min.js"></script>
</head>
<body style="background-color:powderblue;">


		
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#"><img src="groceries.ico" alt="Shop It Up" width="30" height= auto> Shop It Up</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="pnl_order ">Order Panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="pnl_catalog ">Catalog Pane </a>
                </li>
                
				</ul>
				<div class="my-2 my-lg-0">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-success my-2 my-sm-0" href="../action?act=lgout">Logout</a>
                </li>
				</ul>
            </div>
        
            
            </div>
        </div>
    </nav>
	<div class="container">

		<div class="row p-4  text-capitalize">
			<div class="col">
				<h2>catalog list | <small><a href="pnl_catalog_update?act=addctlog&id=null">add new menu</a> </small></h2>
				<table class="table">
					<tr>
						<th>no.</th>
						<th>picture</th>
						<th>name</th>
						<th>price</th>
						<th>description</th>
						<th>shop name</th>
						<th>action</th>
					</tr>

					<?php
					$query = "SELECT * from fds_ctlog WHERE ctlog_usrdt_id = '$usr_id'";
					$result = mysqli_query($conn, $query);
					$count = 1;

					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)){

							echo '<tr>';
							echo '<td>' . $count++ . '</td>';
							echo '<td><img class="img-fluid" width="150" src="../img/menu/'. $row['ctlog_img'] .'" alt="no image"></td>';
							echo '<td>' . $row['ctlog_nme'] . '</td>';
							echo '<td>' . $row['ctlog_prc'] . '</td>';
							echo '<td>' . $row['ctlog_desc'] . '</td>';
							echo '<td>' . $row['ctlog_shp'] . '</td>';
							echo '<td><a href="pnl_catalog_update?act=upctlog&id=' . encryptIt($row['ctlog_id']) . '">Update</a> | <a href="pnl_catalog_update?act=delctlog&id=' . encryptIt($row['ctlog_id']) . '">Delete</a></td>';
							echo '</tr>';

						}
					}

					?>
				</table>
			</div>
		</div>

	</div>

</body>
</html>