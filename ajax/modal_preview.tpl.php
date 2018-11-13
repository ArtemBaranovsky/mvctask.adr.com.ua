
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Превью">
    <meta name="author" content="Артем Барановский">

    <title>Превью задачи</title>

    <!-- Custom styles for this template -->
    <link href="/css/bootstrap.offcanvas.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
		  
          <div class="row">
            <div class="col-xs-6 col-lg-5">
              <h4>Имя пользователя</h4>
              <h5><?=$_POST['formName']?></h5>
              <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>-->
            </div><!--/span-->
            <div class="col-xs-6 col-lg-5">
              <h4>E-mail пользователя</h4>
              <h5><?=$_POST['formEmail']?></h5>
              <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>-->
            </div><!--/span-->

           </div><!--/row-->

		   
        <div class="col-xs-12 col-sm-9">
          <div class="jumbotron">
            <h3>Текст задания:<img src="<?=$_POST['formImage']?>" style="width: 200px; float:right; margin-top: -40px"></h3>
            <h5><?=$_POST['formTask']?></h5>
          </div>
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Артем Барановский 2018</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    <script src="/js/bootstrap.offcanvas.min.js"></script>
  </body>
</html>
