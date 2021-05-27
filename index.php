<?php require_once "app/db.php"; ?>
<?php require_once "app/function.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>


	<?php 
		/**
		 * add student data mangaement
		 */
		if(isset($_POST['add_student']) ){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];
			$location = $_POST['location'];

			

			/**
			 * form validation
			 */
			if (empty($name) || empty($email) || empty($cell) || empty($location) ) {
				 $mess = "<p class='alert alert-danger'>All Filds Are required ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
				//$mess = "<p class='alert alert-info'> Invalid Email Formate ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{

				$data = fileUpload($_FILES['photo'], 'photos/');
				$photo_name = $data['file_name'];

				if ($data['status'] == 'yes') {

					$sql = "INSERT INTO students(name, email, cell, location, photo, status) VALUES ('$name','$email','$cell','$location', '$photo_name', 'active')";
					$connection -> query($sql);


					$mess = "<p class='alert alert-success'>Data Stable! <button class='close' data-dismiss='alert'>&times;</button></p>";
				}else{
					$mess = "<p class='alert alert-danger'> invalid file formate ! <button class='close' data-dismiss='alert'>&times;</button></p>";
				}
			}
		}



	 ?>



	<div class="wrap shadow">
		<a class="btn btn-info btn-sm" href="all-student.php">All-student</a>
		<div class="card">
			<div class="card-body">
				<h2>Add new student</h2>

					<!-- show all massge iseting -->
					
					 <?php 
					 	 if (isset($mess)) {
					 	 	echo $mess;
					 	 }
					  ?>


				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value=" <?php old('name'); ?> " type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" value=" <?php old('email'); ?> " type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value=" <?php old('cell'); ?> " type="text">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<input name="location" class="form-control" value=" <?php old('location'); ?> " type="text">
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control" type="file">
					</div>
					<div class="form-group">
						<input name="add_student" class="btn btn-primary" type="submit" value="SignUp">
					</div>
				</form>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>