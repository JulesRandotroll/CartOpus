<html lang="fr">
<head>
  <title><?php echo $TitreDeLaPage; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
</head>

<body>
    <div class="row" style = "background-color:#15B7D1;padding 20px;border-color=#0E7896;color=#0E7896">
        <div class="text-center">
        <nav class="navbar navbar-default" style="background-color:#0E7896;padding 20px;border-color=#0E7896;color=#0E7896">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <?php
                            echo'<a href="'.site_url('Visiteur/loadAccueil').'">'.img('logoAccueil.png').'</a>';
                            //.site_url => référence au debut de l'uRL ex : http://cartopus... ou http://127.0.0.1/cartopus....
                            //dans les deux cas site URL fonctionnera.
                            echo'<a href="'.site_url('Visiteur/loadAccueil').'">'.img('LogoCarte.png').'</a>'
                        ?>

                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <!-- <ul class="nav navbar-nav">
                        <?php echo'<li><a href="'.site_url('Visiteur/loadAccueil').'" style="color:#FFFFFF;font-size:35">Accueil</a></li>'?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="color:#FFFFFF">Page 1 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Page 1-1</a></li>
                                <li><a href="#">Page 1-2</a></li>
                                <li><a href="#">Page 1-3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"  style="color:#FFFFFF">Page 2</a>
                        </li>
                        <li>
                            <a href="#"  style="color:#FFFFFF">Page 3</a>
                        </li>
                    </ul> -->
