<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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

#menu1 {
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

#cont_princ {
      width: 96%;
	  z-index: 1;
	  margin-top : 100px;}
#section1 {color: #555; border: 4px solid #457725; padding: 15px; margin-top : 10px; border-radius: 25px; min-height: 700px;}
#section2 {color: #555; border: 4px solid #f8a300; padding: 15px; border-radius: 25px;min-height: 700px;}
#section3 {color: #555; border: 4px solid #ce3500; padding: 15px;  margin-top : 10px;border-radius: 25px;min-height: 700px;}
#section4 {color: #555; border: 4px solid #122b3e; padding: 15px; border-radius: 25px;min-height: 700px;}

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
	<div class="logo-beta">bêta</div>
	<div id="fb-root"></div>
				<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>

<nav class="navbar navbar-default navbar-fixed-top">	
	<div class="container">
		<ul id="menu1" class="nav nav-pills center text-center">
				<!--menu smartphone -->
				<li  role="presentation"  class="dropdown  visible-xs-block">				 
						<a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu2" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-menu-hamburger"></span>
						</a>			
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
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
				<li   class="dropdown">
					
						 <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuTwt2" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
							</span>
						</a>	
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuTwt2">
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
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://communeruche.fr/trashadvisor/" data-via="ruche_pp" data-lang="fr" data-related="ruche_pp" data-hashtags="trashadvisor, poubselfy">Tweeter</a> 
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
								</li>								
						</ul>
					
				</li>
				<!--menu dropdown twitter -->
				<!--menu dropdown facebook -->
				<li class="dropdown">
					
						 <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuFB2" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
							</span>
						</a>
						
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuFB2">
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
<?php 	/*			
	<ul id="menu" class="nav nav-pills">
	<li role="presentation" ><a href="./"><span class="glyphicon glyphicon-home"></span></a></li>	
	<li role="presentation" ><a href="contribuer.php">contribuer</a></li>
	<li role="presentation"><a href="carte.php">consulter</a></li>
	<li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-info-sign"></span></a></li>	

	<li role="presentation">
		<a href="https://twitter.com/ruche_pp" target="_blank">
			<span >
				<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
			</span>
		</a>
	</li>
	<li role="presentation">
		<a href="https://www.facebook.com/trashadvisorcommuneruche/" target="_blank">
			<span >
				<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
			</span>
		</a>
	</li>
	</ul>
*/?>



  <div id="cont_princ" class="container-fluid">
    <div class="row">
        <div id="section1" class="col-xs-12 col-md-6"> 
          <h3>LE TRI DES DECHETS ET LES COULEURS DES POUBELLES</h3>
          <h4><p>En France, ce sont les collectivités territoriales (communautés de communes ou d’agglomération, métropoles…) qui sont responsables d’organiser 
		  la collecte et le tri des déchets.</p>
		 <p> Les collectivités peuvent choisir librement comment organiser le tri (combien de poubelles, que doit-on mettre dedans) et le code couleur associé.
		 </p>
		 <p> La <a href="https://www.legifrance.gouv.fr/affichTexteArticle.do;jsessionid=2909589AE993D4D40EC4A12787F4108C.tpdila09v_3?idArticle=JORFARTI000031044719&cidTexte=JORFTEXT000031044385&dateTexte=29990101&categorieLien=id" target="_blank">loi</a> prévoit cependant que les collectivités veillent, d’ici 2025, à harmoniser l’organisation du tri et les couleurs des poubelles sur 
		  l'ensemble du territoire national. </p>
		 <p>  Pour minimiser les coûts, il est prévu que cette harmonisation se fasse progressivement, en s’appuyant sur le renouvellement naturel des équipements de collecte.
		 </p> <p> L’ADEME (Agence de l’environnement et de la maîtrise de l’énergie) propose aux collectivités des <a href="http://www.ademe.fr/sites/default/files/assets/documents/organisation-collecte-dechets-menagers-papiers-201605-recommandations.pdf">recommandations sur l’organisation du tri et les couleurs 
		  des poubelles</a>. Il n’y a pas de solution unique idéale pour tous les territoires. Selon la nature du territoire (urbain, rural, touristique…), les solutions retenues 
		  peuvent être différentes, même si certaines ont fait leurs preuves.  !</p></h4>
        </div> 
		
		
		<div id="section3" class="col-xs-12 col-md-6"> 
          <h3>TRASHADVISOR : A QUOI CA SERT ?</h3>
          <h4><p>Bien sûr, cela peut vous aider à décider où partir en vacances, si vous êtes vraiment attaché(e) à vos habitudes ! </p>

		<p>Mais en fait, cela peut servir à plein d’autres choses :<br>
		- faire prendre conscience à chacun de sa connaissance (ou pas !) de l’organisation du tri de sa commune,<br>
		- voir si les gens connaissent (ou pas !) les « vraies » consignes de tri sur chaque territoire, pour savoir où faire porter les efforts de sensibilisation, <br>
		- construire une carte des couleurs des poubelles, pour mettre en évidence les différences d’un territoire à l’autre, et voir s’il est possible d’harmoniser facilement ces couleurs,<br>
		- et sûrement beaucoup d’autres idées (une carte d’anniversaire, une datavisualisation…) : <br>vos suggestions sont bienvenues !</p><br>

		<p>Mais attention !<br>
		- on peut « bien » trier sans connaître « par cœur » les couleurs des poubelles… Ce n’est pas grave de répondre « je ne sais pas » !<br>
		- Notre carte recense les règles « vécues » par les gens, et elle n’est pas forcément juste : avant de jeter vos déchets, vous pouvez vérifier les « vraies »
		consignes sur le site de votre commune, ou encore sur les sites <a href="http://consignedetri.fr/" target="_blank">consignesdetri.fr</a> ou 
		<a href="http://quefairedemesdechets.fr" target="_blank">quefairedemesdechets.fr</a>… ou bien en regardant votre poubelle dans les yeux ce soir.</p></h4>
		
	   </div> 
	   <div id="section2" class="col-xs-12 col-md-6"> 
          <h3>UN PEU PLUS DE DETAILS SUR LES DIFFERENTS TYPES DE DECHETS… </h3>
          <h4><p>L’immense majorité des collectivités a déjà mis en place depuis longtemps un tri du verre, des canettes, des emballages en carton, des papiers… 
		  et continue de collecter à part les déchets qui restent (non recyclables). </p>
		  <p>
			Pour les emballages en plastique, la plupart des collectivités ne collecte pour l’instant que les bouteilles en plastiques, mais pas les barquettes ou 
			les films en plastiques. Mais c’est en train de changer : fin 2016, déjà 15 millions d’habitants seront couverts par une collecte « étendue » des plastiques, 
			et l’objectif est de couvrir toute la population française d’ici 2022.</p>

			<p>Pour les déchets alimentaires, de plus en plus de collectivités offrent à leurs habitants des solutions de « tri à la source » : collecte dans un bac séparé, 
			ou compostage individuel ou collectif. </p>

			<p>Notre carte cherche à recenser les consignes de tri existantes et les couleurs des poubelles sur l’ensemble de ces déchets !</p></h4>
        </div> 
		<div id="section4" class="col-xs-12 col-md-6"> 
          <h3>QUI SOMMES-NOUS ET POURQUOI FAISONS-NOUS CELA ?</h3>
          <h4><p>Nous sommes une petite équipe de passionnés, convaincue du potentiel de la contribution collaborative (crowdsourcing) pour améliorer les politiques publiques, 
		  notamment dans le domaine du développement durable. 
		  
		  <p>Nous pensons que nous sommes nombreux, citoyens et acteurs publics, à nous mobiliser pour des projets d’intérêt 
		  général et créer des biens communs numériques ensemble, et que ce potentiel de contribution est encore trop peu reconnu et utilisé.</p>

		<p>Ce projet « Trashadvisor » est un exemple et un essai, afin de démontrer l’intérêt du grand public pour les démarches de crowdsourcing. </p>
		<p>Nous avons choisi un sujet (les couleurs des poubelles) qui concerne tout le monde dans son quotidien, pour que tout le monde puisse se sentir impliqué. </p>

		<p>Notre projet, à terme, est de créer une plate-forme sur les projets de crowdsourcing dans le domaine du développement durable, permettant de recenser et 
		de mettre en valeur les projets existants, de susciter de nouveaux projets et de renforcer l’envie de contribuer… et plus généralement d’offrir des ressources sur le crowdsourcing aux personnes intéressées. De telles plate-formes existent déjà, par exemple,
		<a href="https://crowdsourcing-toolkit.sites.usa.gov/" target="_blank">aux Etats-Unis</a> ou <a href="http://www.buergerschaffenwissen.de/" target="_blank">en Allemagne</a>.  </p></h4>
        </div> 

  </div>
</div>
</body>
<footer>
        <?php /*
		<img  class="img-responsive center-block" src="img/la_ruche_logo_pt.jpg">
		<p class="pull-right"><a href="#">Haut de page</a></p><div class="center-block"><span class="text-center">2016, Empowered by La Ruche <a href="#">.</a> <a href="#">.</a></span> </div>
		*/ ?>
		<div class="center text-center">
			<img class="center" src="img/la_ruche_logo_pt.jpg"> 
			<br>
			<span style="font-size: 12px;">Empowered by LaRuche</span>
		</div>	
		
</footer>
<div class="container-fluid centrage">
	<div class="row">
		<div class="col-xs-12 col-md-4  col-social centrage">		  
			<a href="https://twitter.com/ruche_pp" class="twitter-follow-button" data-lang="fr" data-show-count="true">Follow @ruche_pp</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			<br>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://communeruche.fr/trashadvisor/" data-via="ruche_pp" data-lang="fr" data-related="ruche_pp" data-hashtags="trashadvisor, poubselfy">Tweeter</a> 
			
			
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
</html>