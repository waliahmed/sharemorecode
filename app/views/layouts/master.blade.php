<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>sharemoreco.de</title>
        <link rel="stylesheet" href="packages/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="packages/bootstrap-flat-css/bootstrap-flat.css">
        <link rel="stylesheet" href="styles/css/app.css">
    </head>
    <body>
        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url( '/' ) }}">{+} sharemoreco.de</a>
            </div>
            <div class="collapse navbar-collapse">
                <form class="navbar-form navbar-right">
                  <input type="text" class="form-control col-lg-8" placeholder="Search">
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div><!-- /.nav-collapse -->
          </div><!-- /.container -->
        </div><!-- /.navbar -->

        <div class="main" role="main">
        <div id="flash-container">
            <div class="container">
                <div class="alert alert-danger" ng-show="error">
                    <button type="button" class="close">×</button>
                    <span></span>
                </div>
                <div class="alert alert-success" ng-show="success">
                    <button type="button" class="close">×</button>
                    <span></span>
                </div>
                <div class="alert alert-info" ng-show="info">
                    <button type="button" class="close">×</button>
                        <span></span>
                </div>
                <div class="alert alert-warning" ng-show="warning">
                    <button type="button" class="close">×</button>
                        <span></span>
                </div>
            </div>
        </div>

        @yield( 'content' )

        <script src="packages/jquery/jquery.min.js"></script>
        <script src="packages/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="packages/lodash/dist/lodash.min.js"></script>
        <script src="packages/backbone/backbone-min.js"></script>
        <script src="scripts/js/app.js"></script>
        <script src="scripts/js/modules/flash.js"></script>

        @yield( 'scripts' )
    </body>
</html>