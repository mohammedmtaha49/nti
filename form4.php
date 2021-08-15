<?php

  require "conn.php";
  $errors = array();
  $folder = "./images/";

  if ($_SERVER['REQUEST_METHOD']  == "POST")
  {

    if (empty($_POST['title']))
    {
      $errors[] = "required name";
    }
    else
    {
      $title = clean_input($_POST['title']);
      if (ctype_alpha(str_replace(" ", "", $title)) == false )
      {
          $errors[] = "only characters and white spaces allowed in title";
      }
    }

    if (empty($_POST['content']))
    {
      $errors[] = "required content";
    }
    else
    {
      $content = clean_input($_POST['content']);
    }

    if (empty($_FILES['image']['name']))
    {
      $errors[] = "required image";
    }
    else
    {
      $image = $_FILES['image'];
      $image_name = $_FILES['image']['name'];
      $image_temp = $_FILES['image']['tmp_name'];
      $extent = explode(".", $image_name);
      $image_extension = strtolower(end($extent));
      $extensions = array("gif", "png", "jpeg", "jpg");
      if (!in_array($image_extension, $extensions))
      {
        $errors[] = "not allowed extensions";
      }
      else
      {
        $file_name = rand().time().".".$image_extension;
        $final_path = $folder.$file_name;

        $sql = "INSERT INTO posts(title, content, image) 
                            VALUES('$title', '$content', '$file_name')";

        $query = mysqli_query($conn, $sql);

      }
    }


    if (empty($errors))
    {
      move_uploaded_file($image_temp, $final_path);
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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Contact Us</title>
  </head>
  <body>

    <div class="container mt-3">
    <h1>Contact us for your concerns</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="title" class="form-control" id="name" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="desc">Content</label>
            <textarea class="form-control" name="content" id="desc" cols="20" rows="5"></textarea> 
        </div>

        <div class="form-group">
            <label for="image">img</label>
            <input type="file" name="image" class="form-control"> 
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> <br>

    <div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $sql2 = "SELECT * FROM posts";
      $query2 = mysqli_query($conn, $sql2);
      $i = 1;
      while ($posts = mysqli_fetch_assoc($query2))
      {
      ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><?php echo $posts['title']; ?></td>
      <td><?php echo $posts['content']; ?></td>
      <td><img src="<?php echo $folder.$posts['image'] ?>" width="100" height="100"></td>
    </tr>
    <?php
     }
    ?>
  </tbody>
</table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

