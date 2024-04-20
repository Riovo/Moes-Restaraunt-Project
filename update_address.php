<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['House Number'] .', '.$_POST['Address Line 1'].', '.$_POST['Address Line 2'].', '.$_POST['City'] .', '. $_POST['Town'] .', '. $_POST['County'] .', '. $_POST['Country'] .', '. $_POST['pin_code']. ' - '. $_POST['Eircode'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'address saved!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update address</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Enter Your Address</h3>
      <input type="text" class="box" placeholder="House Number" required maxlength="50" name="House Number">
      <input type="text" class="box" placeholder="Address Line 1" required maxlength="50" name="Address Line 1">
      <input type="text" class="box" placeholder="Address Line 2 (optional)" maxlength="50" name="Address Line 2">
      <input type="text" class="box" placeholder="City" required maxlength="50" name="City">
      <input type="text" class="box" placeholder="Town" required maxlength="50" name="Town">
      <input type="text" class="box" placeholder="County (if applicable)" required maxlength="50" name="County">
      <input type="text" class="box" placeholder="Country" required maxlength="50" name="Country">
      <input type="number" class="box" placeholder="pin code (if applicable)" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="text" class="box" placeholder="Eircode" required maxlength= "8" name="Eircode">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>




<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>