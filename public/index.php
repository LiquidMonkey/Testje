<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rente berkenenaar</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid">
      <h1>Bereken uw rente!</h1>
      <form class="inline-form" method="post" action="submit.php">
        <div class="form-group">
          <label class="col-md-2 control-label" for="money">Uw bedrag: </label>
          <div class="col-md-10">
            <input class="form-control" name="money" id="money" type="text" placeholder="€4.10"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="rente">Uw rente: </label>
          <div class="col-md-10">
            <input class="form-control" name="rente" id="rente" type="text" placeholder="5%"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="years">Aantal jaren: </label>
          <div class="col-md-10">
            <input class="form-control" name="years" id="years" type="text" placeholder="2"/>
          </div>
        </div>
        <input type="submit" value="Bereken">
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
