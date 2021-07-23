<?PHP
$API_KEY = "your_api_key";
$API_ACTION = htmlentities($_GET['control']);
$API_URL = "https://api.hebergnity.com/vps";


if($API_ACTION == 'start' OR $API_ACTION == 'stop' OR $API_ACTION == 'reboot') {
  $API_URL = $API_URL."/".$API_ACTION."/".$API_KEY;
  $fgc = file_get_contents($API_URL);
}

$status = file_get_contents("https://api.hebergnity.com/vps/status/".$API_KEY);
$cpu = file_get_contents("https://api.hebergnity.com/vps/cpu/".$API_KEY);
$ram = file_get_contents("https://api.hebergnity.com/vps/ram/".$API_KEY);
$storage = file_get_contents("https://api.hebergnity.com/vps/storage/".$API_KEY);
$mem = 1950000000 - $ram/100;
$resultmem = $mem / 1e+9;
$hd = 32364000000 - $storage/100;
$resulthd = $hd / 1e+9;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="FAL GROUP - https://florianleroy.fr">
    <title>Control a Hebergnity VPS using PHP - Hebergnity</title>
    
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="https://hebergnity.com/favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="https://hebergnity.com/favicon.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://hebergnity.com/favicon.png">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="https://hebergnity.com/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="https://hebergnity.com/favicon.png">
    <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="https://hebergnity.com/favicon.png">
    <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="https://hebergnity.com/favicon.png">
    <link rel="icon" type="image/png" href="https://hebergnity.com/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="theme-color" content="#7952b3">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  
  <body>
    <main>
      <div class="container py-4">
        <header class="pb-3 border-bottom">
          <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img style="width: 50px" src="https://hebergnity.com/favicon.png" alt="Hebergnity" class="m-2">
            <span class="fs-4">Hebergnity</span>
          </a>
        </header>
    
        <!--<div class="p-5 mb-4 bg-dark text-white rounded-3" style="height: 500px; background: url('https://i.imgur.com/2B6BdtU.jpg'); background-position: 30% 47%">-->
        <div class="p-5 mb-4 bg-light text-dark rounded-3" style="height: 600px; background: url('https://i.imgur.com/vrPsRpO.jpg'); background-position: 30% 50%">
          <div class="container-fluid py-5">
            <h1 class="display-5 mt-5 fw-bold">Control a Hebergnity VPS using PHP.</h1>
            <p class="col-md-7 text-dark fs-4">An API is a programming interface developed with the aim of calling on the functionalities of another computer system: it therefore makes it possible to make them compatible with each other.</p>
          </div>
        </div>
    
        <div class="row  mb-4 align-items-md-stretch">
          <?PHP if(!empty($fgc)) { ?>
            <div class="col-md-12">
              <div class="alert alert-success">
                <i class="fas fa-robot"></i> <b>API response :</b> <?= $fgc; ?><br />
                <small><a href="?time=<?= time(); ?>">Reload the page</a></small>
              </div>
            </div>
          <?PHP } ?>
          
          <div class="col-md-5 align-items-center">
            <div class="h-100 p-4 text-white bg-dark rounded-3 text-center align-middle">
              <a class="btn btn-success" href="?control=start"><i class="fas fa-play"></i> Start</a>
              <a class="btn btn-warning" href="?control=reboot"><i class="fas fa-undo"></i> Reboot</a>
              <a class="btn btn-danger" href="?control=stop"><i class="fas fa-stop"></i> Stop</a>
            </div>
          </div>
          <div class="col-md-3 align-items-center">
            <div class="h-100 p-4 text-white bg-dark rounded-3 text-center align-middle">
              <a class="btn btn-outline-light">Status : <?= $status; ?></a>
            </div>
          </div>
          <div class="col-md-4 align-items-center">
            <div class="h-100 p-4 text-white bg-dark rounded-3 text-center align-middle">
              CPU : <?= $cpu; ?><br />
              RAM : <?= substr($resultmem, 0, 4); ?> Go<br />
              Storage : <?= substr($resulthd, 0, 4); ?> Go<br />
            </div>
          </div>
        </div>
    
        <div class="p-5 mb-4 bg-dark text-white rounded-3 text-center" style="height: 350px; background: url('https://hebergnity.com/bg/13bg-min.jpg'); background-position: 60% 30%">
          <div class="container-fluid py-5">
            <p class="col-md-12 text-light h5">
              You have the rights to modify this page and to customize the layout.<br />
              <br />
              You also have the right to extract the elements of the API and put them in place on another page with controlled access 
              (examples: administration page of your site, intranet, localhost, ...)
            </p>
            <a class="btn btn-primary btn-lg mt-4" href="//hebergnity.com">Go to Hebergnity website</a>
          </div>
        </div>
    
        <footer class="pt-3 mt-4 text-muted border-top">
          &copy; FAL GROUP &infin; 2017-<?= date('Y'); ?> // <a href="//florianleroy.fr" target="_blank">www.florianleroy.fr</a>
        </footer>
      </div>
    </main>
  </body>
</html>
