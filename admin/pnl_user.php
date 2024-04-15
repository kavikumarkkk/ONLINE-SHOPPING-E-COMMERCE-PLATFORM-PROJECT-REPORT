<?php
include ('../db.php');


if ($_GET['act'] == 'delusr') 
{

	$id = decryptIt($_GET['id']);

	$query = "DELETE FROM fds_usrdt WHERE usrdt_id = '$id'";
	$result = mysqli_query($conn, $query);

	header ('location: pnl_user');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../groceries.ico">
	<title>admin@siu</title>
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
                    <a class="nav-link active " href="pnl_user">User Panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pnl_order">Order Panel </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pnl_catalog">Catalog Panel</a>
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
		<div class="row p-4">
			<div class="col">
				<h2>user list</h2>
				<table class="table">
					<tr>
						<th>no.</th>
						<th>name</th>
						<th>username</th>
						<th>address</th>
						<th>stat</th>
						<th>action</th>
					</tr>

					<?php

					$query = "SELECT * from fds_usrdt WHERE usrdt_stat!='admin'";
					$result = mysqli_query($conn, $query);
					$count = 1;
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)){

							echo '<tr>';
							echo '<td>' . $count++ . '</td>';
							echo '<td>' . $row['usrdt_nme'] . '</td>';
							echo '<td>' . $row['usrdt_usr'] . '</td>';
							echo '<td>' . $row['usrdt_adrs'] . '</td>';
							echo '<td>' . $row['usrdt_stat'] . '</td>';
							echo '<td><a href="pnl_user?act=delusr&id=' . encryptIt($row['usrdt_id']) . '" onclick="return confirm()">Delete</a></td>';
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