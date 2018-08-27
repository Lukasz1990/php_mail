<?php 
$msg = '';
$msgClass = '';

if(filter_has_var(INPUT_POST,'submit')) {
        
        $name = htmlspecialchars($_POST['name']) ;
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(!empty($email) && !empty($name) && !empty($message)) {
            
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $msg = 'Please use a valid email';
                $msgClass = 'alert-danger';

            } else {
                $toemail = 'lukasz.fijalkowski1337@gmail.com';
                $subject = 'Contact Request from' . $name ;
                $main = '<h1>Contact Request from</h1>
                        <h2>Name</h2><p>'.$name.'</p>
                        <h2>email</h2><p>'.$email.'</p>
                        <h2>message</h2><p>'.$message.'</p>';

                $headers = "MIME-Version: 1.0". "\r\n";
                $headers.="Content-Type:text/html;charset=UTF-8"."\r\n";
                $headers.="From" .$name. "<".$email.">"."\r\n";

                if (mail($toemail,$subject,$main,$headers)) {
                    $msg = 'Email has been sent';
                    $msgClass = 'alert-success';
                } else {
                    $msg = 'Email was not sent';
                    $msgClass = 'alert-danger';
                }
 

            }

        }
        else {
            $msg = 'Please fill data in all fields';
            $msgClass = 'alert-danger';
        }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Website</a>
        </div>
    </div>
    </nav>
<div class="container">
<?php if($msg !=''): ?> 
    <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?>
    </div>

<?php endif; ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>"
  <div class="form-group">
    <label>Name</label>
    <input type="text"  name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : '';?>">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text"  name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : '';?>">
  </div>
  <div class="form-group">
    <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : '';?></textarea>
    <label>Message</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    
</body>
</html>