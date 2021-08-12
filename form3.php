<?php 

    $errors = array();
    $name = $email = $password = $address = $linkedin = $gender = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {


        if (empty($_POST['name']))
        {
            $errors[] = "name is required"; 
        }
        else
        {
            $name = clean_input($_POST['name']);
            if (ctype_alpha($name) == false )
            {
                $errors[] = "only characters allowed in name";
            }
        }

        if (empty($_POST['email']))
        {
            $errors[] = "email is required"; 
        }
        else
        {
            $email = clean_input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = "incorrect email";
            }
        }

        if (empty($_POST['address']))
        {
            $errors[] = "address is required"; 
        }
        else
        {
            $address = clean_input($_POST['address']);
            if (strlen($address) < 10)
            {
                $errors[] = "minimum 10 chars address";
            }
        }

        if (empty($_POST['password']))
        {
            $errors[] = "password is required"; 
        }
        else
        {
            $password = clean_input($_POST['password']);
            if (strlen($password) < 6)
            {
                $errors[] = "minimum 6 chars password";
            }
        }

        if (empty($_POST['linkedin']))
        {
            $errors[] = "linkedin is required"; 
        }
        else
        {
            $linkedin = clean_input($_POST['linkedin']);
            if (!filter_var($linkedin, FILTER_VALIDATE_URL))
            {
                $errors[] = "invalid linkedin url";
            }
        }

        if (empty($_POST['gender']))
        {
            $errors[] = "gender is required"; 
        }
        else
        {
            $gender = $_POST['gender'];
        }

        if ($_FILES['profile']['error'] == 4)
        {
          $errors[] = "upload your image";
        }
        else
        {
          $image = $_FILES['profile'];
          $image_name = $_FILES['profile']['name'];
          $extensions = array("jpg", "gif", "jpeg", "png");
          $extent = explode(".", $image_name);
          $image_extension = strtolower(end($extent));
          if (!in_array($image_extension, $extensions))
          {
            $errors[] = "not allowed extension";
          }
        }

        if (empty($errors))
        {
         $myfile = fopen('user.txt', 'w') or die ("unable to open the file");

          $txt = "name is : " . $name . "\n" .
                 "email is : " . $email . "\n".
                 "password is : " . $password . "\n".
                 "address is : " . $address . "\n" .
                 "linkedin url is : " . $linkedin . "\n" .
                 "gender is : " . $gender . "\n" .
                 "image name is : " . $image_name . "\n" ;

          fwrite($myfile, $txt);

          fclose($myfile);

        }
        else
        {
            foreach ($errors as $error)
            {
                echo $error . "<br>";
            }
        }

    }

    function clean_input($input)
    {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);

        return $input;
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>form validation</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1>Php Ajax Form Validation Example</h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" role="form" id="contactForm" class="contact-form" data-toggle="validator" class="shake">
    <div class="alert alert-danger display-error" style="display: none">
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" name="name" class="form-control" placeholder="Name">
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" class="email form-control" name="email" placeholder="Email" >
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" name="password" class="form-control" placeholder="your password" >
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" name="address" class="form-control" placeholder="your address" >
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" name="linkedin" class="form-control" placeholder="linkedin url" >
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
       <label>gender : </label>
       <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">male
       <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">female
      </div>
    </div>
    <input type="file" name="profile"><br>
    <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i> register me</button>
  </form>
</div>
</body>
</html>