
<?php include 'include/header.php'; ?>

<?php 
if (!(isset($_SESSION['isLoggin']) && $_SESSION['isLoggin'])):
	header('Location: javascript://history.go(-1)');
else:

// var_dump($_POST);

?>
<?php include 'include/form/new-recipe-form.php' ?>

<?php endif ?>

<?php include 'include/footer.php'; ?>
