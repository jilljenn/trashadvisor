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
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script> 
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="jquery-ui-1.11.4.custom/external/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<link href="./css/carousel.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
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
#tdb { 
margin-top : 60px;
height: 97% ;
} 
#tdb_1 { 
margin-top : 60px;
height: 97% ;
} 

/* Add a dark background color to the footer */
#tab {
	background-color: #f5f5f0;
	//color: #f5f5f5;
	padding: 32px;
}

#tab a {
	//color: #f5f5f5;
}

#tab a:hover {
	color: #777;
	text-decoration: none;
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
				<li  role="presentation" class="dropdown">
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
				<li  role="presentation" class="dropdown">
					
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
 
 
 <div id="tdb" class="container-fluid text-center"> 			
			<div class="row">
				<div class="col-xs-12">
				  <img src="graph_contrib_j_c.php" alt="contributions par jour">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
				  <img src="graph_contrib_j.php" alt="contributions par jour">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
				  <img src="graph_contrib_h.php" alt="contributions par heure">
				</div>
			</div>
	
			<!-- --->
			<div id="tab" class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3 text-center">		

						
						
				  <div class="tab-content">
					  <div id="home" class="tab-pane fade in active">
						<h2>Contributions par département</h2>
						<p>
						
						<!-- table start --->
								<table id="example" class="table table-striped display compact">
									<thead>
										<tr>
											
											<th>région</th>
											<th>dpt</th>
											<th>nb contributions</th>
											<th>nb communes</th>
											
											<th></th>		
										</tr>
									</thead>
									<tbody class="searchable">
										
								<?php 
								require("connections/mysql.php"); 
								$sql = "select LEFT(`code_INSEE`, 2) as dpt, count(distinct(`id_declarant`)) as nb, 
								count(distinct(`code_INSEE`)) as nb_commune 
								FROM couleur_dechet 
								GROUP BY LEFT(`code_INSEE`, 2) 
								ORDER BY LEFT(`code_INSEE`, 2); " ;
								$sql = "select LEFT(`code_INSEE`, 2) as dpt, count(distinct(`id_declarant`)) as nb, 
								count(distinct(`code_INSEE`)) as nb_commune, `NOM_DEPT,C,30`, `NOM_REG,C,35`
								FROM `couleur_dechet` as a, `commune_geofla` as b 
								WHERE a.`code_INSEE` = b.`INSEE_COM,C,5` 
								GROUP BY LEFT(`code_INSEE`, 2) 
								ORDER BY LEFT(`code_INSEE`, 2); " ;


									$res = $mysqli->query($sql);
									$row = $res->fetch_assoc();
									$res->data_seek(0);

									$xdata = [];
									$ydata = [];
									//$xdata[0] = strtotime('2016-07-05');
									//$ydata[0] = 0;
									$nb_sum = 0;

									while ($row = $res->fetch_assoc()) 	
										{		
											echo "<tr>";
											echo "<td>".$row['NOM_REG,C,35']."</td>";
											//echo "<td></td>";//<a href='./"."'><span class='glyphicon glyphicon-open'></span></a>
											echo "<td>".$row['NOM_DEPT,C,30']." (".$row['dpt'].")</td>";
											echo "<td>".$row['nb']."</td>";
											echo "<td>".$row['nb_commune']."</td>";
											
											if (isset($row['dpt']) AND $row['dpt']!=""){
												echo "<td><img src='graph_contrib_j_c_dpt.php?dpt=".$row['dpt']."' alt='contributions par jour'></td>";
												} else {
												echo "<td></td>";
												};
											
											echo "</tr>";
										};
									
								?>		
									</tbody>
								</table>


								</p>
							  </div>
				  
					<!-- table end--->
				  
				</div>
				  <a class="up-arrow" href="#" data-toggle="tooltip" title="haut">
							<span class="glyphicon glyphicon-chevron-up"></span>
						  </a>
						<script>
						$(document).ready(function(){
							// Initialize Tooltip
							$('[data-toggle="tooltip"]').tooltip(); 
						})
						</script>
				</div>	
  
			</div>
</div>

<div id="tdb_1" class="container-fluid text-center"> 				
			<!-- --->
			<div id="tab" class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3 text-center">					
				  <div class="tab-content">
					  <div id="home_1" class="tab-pane fade in active">
						<h2>Les dernières contributions</h2>
						<p>
						
						<!-- table start --->
								<table id="example_1" class="table table-striped display compact">
									<thead>
										<tr>			
											<th>code postal</th>
											<th>commune</th>
											<th>date</th>
											<th></th>		
										</tr>
									</thead>
									<tbody class="searchable">
										
								<?php 
								require("connections/mysql.php"); 
								$sql = "SELECT `code_postal`, b.`NOM_COM,C,50`, a.`declaration_date` 
								FROM `couleur_dechet` as a, `commune_geofla` as b 
								WHERE a.`code_INSEE` = b.`INSEE_COM,C,5` GROUP BY `id_declarant` ORDER BY `id_declarant` DESC LIMIT 30; " ;


									$res = $mysqli->query($sql);
									$row = $res->fetch_assoc();
									$res->data_seek(0);

									$xdata = [];
									$ydata = [];
									//$xdata[0] = strtotime('2016-07-05');
									//$ydata[0] = 0;
									$nb_sum = 0;

									while ($row = $res->fetch_assoc()) 	
										{		
											echo "<tr>";
											//echo "<td></td>";//<a href='./"."'><span class='glyphicon glyphicon-open'></span></a>
											echo "<td>".$row['code_postal']."</td>";
											echo "<td>".$row['NOM_COM,C,50']."</td>";
											echo "<td>".$row['declaration_date']."</td>";
											echo "<td></td>";
											echo "</tr>";
										};
									
								?>		
									</tbody>
								</table>


								</p>
							  </div>
				  
					<!-- table end--->
				  
				</div>
				  <a class="up-arrow" href="#" data-toggle="tooltip" title="haut">
							<span class="glyphicon glyphicon-chevron-up"></span>
						  </a>
						<script>
						$(document).ready(function(){
							// Initialize Tooltip
							$('[data-toggle="tooltip"]').tooltip(); 
						})
						</script>
				</div>	
  
			</div>
</div>

<script>
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
$(document).ready(function() {
  //$('#example').dataTable();
  
   $('#example').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
	$('#example_1').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
  $(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
  
});
</script>	 
		 
</body>
</html>