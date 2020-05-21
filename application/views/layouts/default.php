<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- <link href="<?php echo PUBLIC_PATH ?>/css/main.css" rel="stylesheet"> -->
  <link href="<?php echo PUBLIC_PATH ?>/css/responsive.css" rel="stylesheet">
  <link href="<?php echo PUBLIC_PATH ?>/css/mystyle.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title><?php echo !empty($title) ? $title : 'title';?></title>
</head>
<body>
	<?php  include VIEWS_PATH.'/partials/header.php'; ?> 
	<?php echo $content; ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    var form = document.getElementById("insertWork");
    var button = document.getElementById("showInsertForm");
    var close = document.getElementById("close");
      button.addEventListener("click",function(e){
          form.style.display = "flex";
          button.innerHTML = "close";
          button.style.display = "none";
          close.style.display = "block";
      },false);
      close.addEventListener("click",function(e){
        console.log('dfg');
          form.style.display = "none";
          button.innerHTML = "Insert work";
          button.id = "showInsertForm";
          button.style.display = "block";
          close.style.display = "none";
      },false);

      // $("#search").hover(
      //     function() {
      //       $(this).css({
      //         "left": "6vw",
      //       });
      //     }
      // );
  </script>
</body>
</html>



