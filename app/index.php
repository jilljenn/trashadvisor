<?php 

  ?>

 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" type="image/gif" href="animated_favicon1.gif" >

<title>Trash Advisor - Partageons la couleur de nos poubelles !</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.min.css">
<script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script> 
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="jquery-ui-1.11.4.custom/external/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<link href="./css/carousel.css" rel="stylesheet">

<style>
.logo-beta{
text-align:center;
text-transform:uppercase;
position:absolute;
top:26px;
right:-35px;
-webkit-transform:rotate(45deg);
transform:rotate(45deg);
-webkit-filter: opacity(40%);
filter: opacity(40%); 
width:150px;
background-color:#4B950F;
color:#fff;
padding:3px;
font-size:14px;
font-weight:400;
z-index:9999}

}

#menu {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 10;
    border: 0;
	-webkit-filter: opacity(90%) ;
	filter: opacity(90%) ; 
    font-size: 12px !important;
    line-height: 1 !important;
    //letter-spacing: 4px;
    border-radius: 0;
}


// Class
.center-block {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

// Usage as a mixin
.element {
  .center-block();
}
.bord1 {
border-radius: 10px;
border: 1px solid #666;
}
.bord {
border: 1px solid #666;
}
.center {
     margin: auto;
    // width: 50%;
    // border: 3px solid green;
    padding: 10px;
	position: relative;
	padding-top: 12px;
	
}
.centrage {
margin: auto;
text-align: center;
}
.col-social {
background-color: #FEFEFE;
padding: 10px;
-webkit-filter: brightness(100%) grayscale(60%) opacity(90%) ;//grayscale(100%); sepia(100%)
filter: brightness(100%) grayscale(60%)  opacity(90%) ; //blur(3px)
//margin: auto;
border-radius: 10px;
border: 1px solid #EEE;
}
</style>
</head>

  <body>
         <div class="logo-beta">Bêta</div>
		 <div id="fb-root"></div>
				<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>
<!-- NAVBAR
================================================== -->	 
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<ul id="menu" class="nav nav-pills center text-center">
				<!--menu smartphone -->
				<li  role="presentation"  class="dropdown  visible-xs-block">				 
						<a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-menu-hamburger"></span>
						</a>			
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<li role="presentation"><a href="./"><span class="glyphicon glyphicon-home"></span> accueil</a></li>
								<li role="presentation"><a href="contribuer.php"><span class="glyphicon glyphicon-hand-right"></span> contribuer</a></li>
								<li role="presentation"><a href="carte.php"><span class="glyphicon glyphicon-eye-open"></span> consulter</a></li>
								<li role="presentation"><a href="savoir_plus.php"><span class="glyphicon glyphicon-info-sign"></span> en savoir plus</a></li>				
						</ul>
					
				</li>
				<!--menu smartphone -->
				
				<!--menu pc tablette -->
				<li role="presentation" class="hidden-xs"><a href="./"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> accueil</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="contribuer.php"><span class="glyphicon glyphicon-hand-right"></span> <span class="hidden-xs">contribuer</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="carte.php"><span class="glyphicon glyphicon-eye-open"></span> <span class="hidden-xs">consulter</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="savoir_plus.php"><span class="glyphicon glyphicon-info-sign"></span> <span class="hidden-xs">en savoir plus</span></a></li>				
				<!--menu pc tablette -->
				
				<!--menu dropdown twitter -->
				<li class="dropdown">
						 <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuTwt" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
							</span>
						</a>
						
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuTwt">
								<li role="presentation">
									<a href="https://twitter.com/ruche_pp" target="_blank">
										<span>
											<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
										</span>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li role="presentation" style="padding-left: 10px;padding-right: 10px;">		
									<a href="https://twitter.com/ruche_pp" class="twitter-follow-button" data-lang="fr" data-show-count="true">Follow @ruche_pp</a>
										<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
								</li>
								<li role="presentation" style="padding-left: 10px;padding-right: 10px;">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://communeruche.fr/trashadvisor/" data-via="ruche_pp" data-lang="fr" 
											data-related="ruche_pp" data-hashtags="trashadvisor, poubselfy">Tweeter</a> 
									<script>
										!function(d,s,id){
												var js,
												fjs=d.getElementsByTagName(s)[0],
												p=/^http:/.test(d.location)?'http':'https';
												if(!d.getElementById(id)){
													js=d.createElement(s);
													js.id=id;
													js.src=p+'://platform.twitter.com/widgets.js';
													fjs.parentNode.insertBefore(js,fjs);
													}
											}(document, 'script', 'twitter-wjs');
									</script>
								</li>								
						</ul>
					
				</li>
				<!--menu dropdown twitter -->
				<!--menu dropdown facebook -->
				<li class="dropdown">
					
						 <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuFB" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
							</span>
						</a>
						
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuFB">
								<li role="presentation">
									<a href="https://www.facebook.com/trashadvisorcommuneruche/" target="_blank">
										<span>
											<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
										</span>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li  role="presentation" style="padding-left: 10px;padding-right: 10px;"><div class="fb-follow" data-href="https://www.facebook.com/trashadvisorcommuneruche/" data-layout="standard" data-size="small" data-show-faces="true"></div></li>
								<li  role="presentation" style="padding-left: 10px;padding-right: 10px;"><div class="fb-like" data-href="http://communeruche.fr/trashadvisor/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></li>
								
						</ul>
				</li>
				<!--menu dropdown facebook -->
				
		</ul>
	</div>		
 </nav>			

    <!-- Carousel
    ================================================== -->
	
    <div class="carousel slide" id="myCarousel" data-ride="carousel">
      <!-- Indicators -->
	 
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0"></li>
        <li class="active" data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item">
          <?php /*<img class="first-slide" alt="First slide" src="">*/ ?>
          <div class="container">
            <div class="carousel-caption">
			   <h2>De quelles couleurs sont les poubelles dans votre commune ?</h2>
			   <img  class="img-responsive center-block bord1" src="img/contribuer.png"><br>
               <p><a class="btn btn-lg btn-primary" role="button" href="contribuer.php"><span class="glyphicon glyphicon-hand-right"></span> Contribuer !</a></p>
            </div>
          </div>
        </div>
        <div class="item active">
         <?php /* <img class="second-slide" alt="Second slide" src=""> */ ?>
          <div class="container">
            <div class="carousel-caption">
			   <h2>Partageons la couleur de nos poubelles ! </h2><h3>TRASH'Advisor</h3>
			 <?php /* <h4> Bientôt les vacances... Mais qu'est-ce que je vais faire de mes déchets ?<br>
			   <em>(Souvenez-vous, les jeter sur la bord de l'autoroute, c'est mal !)</em> 
			   */ ?>
			   La carte de France des couleurs des poubelles ? <br>Quelle bonne idée ! Construisons-la ensemble...
			   <br></h4><br>
            </div>
          </div>
        </div>
		 <div class="item">
          <?php /*<img class="first-slide" alt="First slide" src=""> */ ?>
          <div class="container">
            <div class="carousel-caption"><br>
              <img  class="img-responsive center-block" src="img/carte_fr_menu.png"><br>
               <h2>La carte de la couleur des poubelles issue de la contribution collective !</h2><a class="btn btn-lg btn-primary" role="button" href="carte.php"><span class="glyphicon glyphicon-eye-open"></span> Consulter</a>
            </div>
          </div>
        </div>
		
      </div>
      <a class="left carousel-control" role="button" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" role="button" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- 4 columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <a href="contribuer.php"> <img width="140" height="140" class="img-circle bord" alt="Generic placeholder image" src="img/contribuer_logo.png">
		  
          <h3><span class="glyphicon glyphicon-hand-right"></span> Contribuer</h3></a>
          <?php /*<p>...</p>
          <p><a class="btn btn-default" role="button" href="contribuer.php">Je contribue </a></p>*/?>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-4">
         <a href="carte.php"> <img width="140" height="140" class="img-circle bord" alt="Generic placeholder image" src="img/carte_fr_menu.png" >
		 
          <h3><span class="glyphicon glyphicon-eye-open"></span> Consulter</h3></a>
          <?php /* <p>...</p>
          <p><a class="btn btn-default" role="button" href="carte.php">Je consulte </a></p>*/?>
        </div><!-- /.col-lg-3 -->
		 <div class="col-lg-4">
		  <a href="savoir_plus.php">
          <img width="140" height="140" class="img-circle  bord" alt="Generic placeholder image" src="img/triman_logo.png">
          <h3><span class="glyphicon glyphicon-info-sign"></span> En savoir plus</h3></a>
           <?php /*<p>...</p>
          <p><a class="btn btn-default" role="button" href="#"><i>A venir</i></a></p>*/?>
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->

	 
      <!-- FOOTER -->
      <footer>
        <?php /*
		<img  class="img-responsive center-block" src="img/la_ruche_logo_pt.jpg">
		<p class="pull-right"><a href="#">Haut de page</a></p><div class="center-block"><span class="text-center">2016, Empowered by La Ruche <a href="#">.</a> <a href="#">.</a></span> </div>
		*/ ?>
		<div class="center text-center">
			<img class=" center" src="img/la_ruche_logo_pt.jpg"/> 
			<br>
			<span style="font-size: 12px;">Empowered by LaRuche</span>
		</div>	
			
	  </footer>
  
 
<div class="container-fluid centrage">
	<div class="row">
		<div class="col-xs-12 col-md-4  col-social centrage">		  
			<a href="https://twitter.com/ruche_pp" class="twitter-follow-button" data-lang="fr" data-show-count="true">Follow @ruche_pp</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			<br>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://communeruche.fr/trashadvisor/" data-via="ruche_pp" data-lang="fr" data-related="ruche_pp" data-hashtags="trashadvisor, poubselfy">Tweeter</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			
		</div>
		<div class="col-xs-12 col-md-4   centrage">		  
			
		</div>
		<div class="col-xs-12 col-md-4  col-social centrage">
			<div class="fb-follow" data-href="https://www.facebook.com/trashadvisorcommuneruche/" data-layout="standard" data-size="small" data-show-faces="true"></div>
			<br>
			<div class="fb-like" data-href="http://communeruche.fr/trashadvisor/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
		</div>
	</div><!-- /.row -->
</div>
</body>
</html>