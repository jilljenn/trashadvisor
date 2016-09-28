<?php 
require("connections/mysql.php"); 
?>  
<?php  
//if (isset($_GET['maVariable'])) { echo $_GET['maVariable'];}; 
//if (isset($_GET['codepostal'])) { echo $_GET['codepostal'];}; 
?>
<?php

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
};


		

if (isset($_GET['maVariable']) AND isset($_GET['codepostal'])) {
	//print_r("GET ok");
	
    $get_array = str_getcsv($_GET['maVariable']);
	//print_r($get_array); 
	$date = date_create();

	
	foreach ($get_array as $key => $value) {	
		$value1 = str_getcsv($value,";","","");
		$value2 = str_getcsv($value1[0],"_","","");
		
		$insertSQL = sprintf("INSERT INTO couleur_dechet (id_declarant, conteneur_type, conteneur_couleur, dechet_type, code_postal, declaration_date) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(date_timestamp_get($date), "int"),
                       GetSQLValueString($value2[0], "text"),
                       GetSQLValueString($value2[1], "text"),
					   GetSQLValueString($value1[1], "text"),
					   GetSQLValueString($_GET['codepostal'], "int"),
					   GetSQLValueString(date("Y-m-d"), "date"));
			//print_r($insertSQL);
			$res = $mysqli->query($insertSQL) or die(mysql_error());
			
		};
	echo date_timestamp_get($date);
		//print_r($value);
		
		/*echo "test";
		function gototo($adresse)
	{
	echo "<script language='JavaScript'> 
    document.location.replace('".$adresse."'); 
       </script>"; } ;
	gototo('feedback.php');*/
				
	
};
  ?>

 
<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Trash Advisor</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.min.css">
<link rel="stylesheet" href="css/leaflet.css">
<script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script> 
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="jquery-ui-1.11.4.custom/external/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/leaflet.js"></script>
<script src="js/jscolor.min.js"></script>


<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" type="image/gif" href="animated_favicon1.gif" >
<style>
.ui-autocomplete {
  position: fixed;
  top: 100%;
  left: 0;
  z-index: 1051 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 600px;
 
}

.logo-beta{
text-align:center;
text-transform:uppercase;
position:absolute;
top:26px;
//margin-top:56px;
right:-35px;
-webkit-transform:rotate(45deg);
transform:rotate(45deg);
-webkit-filter: opacity(50%);
filter: opacity(50%); 
width:150px;
background-color:#4B950F;
color:#fff;
padding:3px;
font-size:14px;
font-weight:400;
z-index:1000}

}

.drop-here {
	z-index: 1;
	border: 2px dashed #EEAA55;
	background-color: #FCFDCA;
	min-height: 5px;
	height: auto !important;
	margin-bottom: 2px;
	 opacity: 0.70;
}

#drop-here__ {
	z-index: 1;
	border: 2px dashed #E4DA4A;
	background-color: #FCFDCA;
	min-height: 300px;
	height: auto !important;
	margin-bottom: 2px;
}

#drop-2 {
	z-index: 1;
	border: 2px dashed #E4DA4A;
	background-color: #FCFDFF;
	min-height: 150px;
	height: auto !important;
	margin-bottom: 1px;
}

.draggable-conteneur {
	width: 76px;
	height: 76px;
	line-height: 50px;
	font-size: 30px;
	font-weight: bold;
	color: #FFF;
	border-radius: 20px;
	border: 1px solid #999;
	text-align: center;
	float: left;
	margin:2px;
}

.draggable-dechet {
	width: 75px;
	height: 75px;
	line-height: 50px;
	font-size: 20px;
	font-weight: bold;
	color: #FFF;
	border-radius: 10px;
	border: 1px solid #999;
	text-align: center;
	float: left;
	margin: 2px;
}

ul, ul li { 
list-style: none; 
margin:0 ; 
padding: 0; 
}

div {  
        }

#drplist li 
{ 
	border: 2px dashed #E4DA4A;
	background-color: #FCFDCA;
	min-height: 60px;
	height: auto !important;		
 }

 ul#token-list li {
	padding-left: 0px;
	padding-right: 0px;
	margin-right: 0px;
	text-align: center;
}

ul#token-list-dechet li {
	z-index: 100;
	font-size: 11px;
	text-align: center;
}
 
button {
    float:right;
}
.jumbotron {
    background-color: #777;
	color: #FFFFFF;
}

</style>
</head>

<body>
<?php /*<ul id="menu" class="nav nav-pills">
	<li role="presentation"  class="active"><a href="./">accueil</a></li>	
	<li role="presentation"  class="active"><a href="contribuer.php">contribuer</a></li>
	<li role="presentation"  class="active"><a href="#">consulter</a></li>		
</ul>*/ ?>
<div class="logo-beta">bêta</div>
<div class="jumbotron" >

	
	<div class="container">
	
		
		<div class="col-xs-12"> 
			<h2>De quelles couleurs sont les poubelles dans votre commune ?</h2>
			<h3>Glissez les déchets dans les bonnes poubelles !</h3>
			<h5><em>En cas de doute, mettez le déchet dans la poubelle "je ne sais pas".</em></h5>
			<h3>Une fois terminé, cliquez sur le bouton &quot;Envoyer&quot;.</h3>
			<h5><em>Votre contribution est anonyme. 
				<br>Les données collectées ont vocation à être ouvertes dans un objectif de création de bien commun.</em></h5>
			
			
			<div ><button id="check-btn_1" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" type="submit" onclick="ajouter()"><span class="glyphicon glyphicon-ok"></span> Envoyer</button><form> <button id="reset-btn" type="submit"  onclick="document.location.reload(); return false;"  class="btn btn-danger" ><span class="glyphicon glyphicon-refresh"></span> Effacer</button></form></div>
			<!-- Modal -->
			<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h5 class="modal-title" style="color: #111111;" id="myModalLabel">Renseigner votre code postal puis valider</h5>
						</div>
												
						

    <div class="form-group">
        <label class="col-xs-3 control-label"></label>
        <div class="col-xs-12"> 
            <input id="postalcode" type="text" class="form-control" name="postalCode" />
			<input id="communenom" type="hidden" name="communenom" />
			<input id="INSEEcode" type="hidden" name="INSEEcode" />
			<div  id="communenom_txt" class="alert alert-info" role="alert"></div>
        </div>
    </div>


		
					<div class="modal-footer">
						<button id="check-btn" type="button" class="btn btn-primary">Valider</button>
					</div>
					
					</div>
				</div>
			</div>
		
		
		
		<!---->
		
		
		
		
		
		</div>
	</div>
		</p>
		
</div>


<div class="container-fluid" ALIGN="center">

<div class="row" ALIGN="center">
 <div class="col-xs-12" style="margin: 2px;"><ul class="list-inline" id="token-list-dechet" ALIGN="center"> 
		<li><div class="draggable-dechet unite"><img style="position: relative;padding-left: 8px;" class="img-responsive" src="img/plastique1.png" ALIGN="middle"><span style="font-size: 1px;color: #FFFFFF;">bouteille plastique</span></div><br>bouteille<br>plastique</li>

		<li><div class="draggable-dechet unite"><img style="position: relative;;padding-left: 14px;padding-top: 7px;" class="img-responsive" src="img/canette.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">canette</span></div><br>canette<br>.</li>
		<li><div class="draggable-dechet unite"><img style="position: relative;padding-top: 7px;" class="img-responsive" src="img/carton.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">emballage carton</span></div><br>emballage<br>carton</li>
		<li><div class="draggable-dechet unite"><img style="position: relative;padding-top: 7px;" class="img-responsive" src="img/papier.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">papier</span></div><br>papier<br>.</li>
		<li><div class="draggable-dechet unite"><img style="position: relative;padding-left: 13px;" class="img-responsive" src="img/verre.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">verre</span></div><br>verre<br>.</li>
		<li><div class="draggable-dechet unite"><img style="position: relative;padding-top: 12px;" class="img-responsive" src="img/dechet_alimentaire.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">dechet alimentaire</span></div><br>dechet<br>alimentaire</li>
		<li><div class="draggable-dechet unite"><img style="position: relative;" class="img-responsive" src="img/barquette_plastique.png" ALIGN="middle"> <span style="font-size: 1px;color: #FFFFFF;">barquette plastique</span></div><br>barquette<br>plastique</li>
		<li>
			<div class="draggable-dechet unite"><img style="position: relative;" class="img-responsive" src="img/dechet_ultime.png" ALIGN="middle"> 
				<span style="font-size: 1px;color: #FFFFFF;">dechet non recyclable</span>
			</div>
			<br>dechet non<br>recyclable
		</li>		
	</ul> 
 </div>
<div class="row">
	<div class="col-xs-12" align="center"> <br><br><span style="font-size:5em; color: #AAA; position: relative; padding-left: 0px; padding-top: 0px;" class="glyphicon glyphicon-hand-down"></span><br><br></div>
</div>

<div class="container-fluid" ALIGN="center">

<div class="row">
 <div class="col-xs-1"> 
	
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
	
		<li>
		<div id="global_jaune" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_jaune.png" ALIGN="middle"> 
			</div>
			<br>jaune
		</div>
		</li>		
   </ul>
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_bleu" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_bleu.png" ALIGN="middle"> 
			</div>
			<br>bleu
		</div>
		</li>		
   </ul>
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_blanc" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_blanc.png" ALIGN="middle"> 
			</div>
			<br>blanc
		</div>
		</li>		
   </ul>
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_rouge" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px;  padding-top: 12px;" class="img-responsive" src="img/global_rouge.png" ALIGN="middle"> 
			</div>
			<br>bordeaux
		</div>
		</li>		
   </ul>
 </div>
 
<div class="col-xs-2 col-sm-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_marron" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_marron.png" ALIGN="middle"> 
			</div>
			<br>marron
		</div>
		</li>		
   </ul>
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_vert" class="drop-here" style="float: left;">
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_vert.png" ALIGN="middle"> 
			</div>
			<br>vert
		</div>
		</li>		
   </ul>
 </div>
 <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_gris" class="drop-here" style="float: left;">
		
			<div id="Sac" class="draggable-conteneur sac" >
			<img style="position: relative;padding-left: 4px; padding-top: 12px;" class="img-responsive" src="img/global_gris.png" ALIGN="middle"> 
			</div>
			<br>gris
		</div>
		</li>		
   </ul>
 </div>
 
 
 
 
  <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1"> 
	<ul class="nav-stacked" id="token-list">
	
		<li>
		<div id="global_autre" class="drop-here" style="float: left;">	
		
			<div id="Sac_autre" class="draggable-conteneur sac">
			<img style="position: relative;padding-left: 4px; padding-top: 12px;  opacity: 0.90;" class="img-responsive" src="img/global_autre.png" ALIGN="middle"> 
			<button type="button"  class="btn btn-default btn-lg jscolor {styleElement:'Sac_autre',valueElement:null}" aria-label="Left Align" style="width:20px; height:25px; position: relative;padding-left: 4px;padding-top: 0px;align : center;">
					<span style="font-size:0.8em; position: relative; padding-left: 0px; padding-bottom: 15px;" class="glyphicon glyphicon-tint  jscolor {styleElement:'Conteneur_couleur_choix',valueElement:null,value:'F4F7EB'}" aria-hidden="true"></span>
				</button>
			</div>
			<br>autre<br> couleur
		</div>
		</li>		
		
   </ul> </div>
  <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
	<ul class="nav-stacked" id="token-list">
		<li>
		<div id="global_nsp" class="drop-here" style="float: left;">
		
			<div id="Sac" class="draggable-conteneur sac" >
			<span style="font-size:1.5em; color: #777; position: relative; padding-left: 0px; padding-top: 13px;" class="glyphicon glyphicon-question-sign"></span>
			</div>
			<br>je ne <br>sais pas
		</div>
		</li>		
   </ul>
 </div>
</div>
<div class="col-xs-1"> 
	
 </div>

<script>


$("#postalcode" ).autocomplete({
		delay: 1, 
 		minLength: 5,
		//appendTo: "#tags",
		source: function(request, response) { 
					$.getJSON("traitement_ville.php?", { 
 						codepostal: request.term, 
 					}, function(data) { 
 						// data is an array of objects and must be transformed for autocomplete to use 
 						var array = data.error ? [] : $.map(data, function(m) { 
 							return { 
								commune: m.nom_commune,
								value: m.code_INSEE,
								code_postal : m.code_postal,
								label: m.code_postal + "-" + m.nom_commune
 							}; 
 						}); 
						if(array.length==1) { 
							$("#INSEEcode" ).val(array[0]['value']);
							$('#postalcode').val(array[0]['code_postal']); 
							$('#communenom').val(array[0]['commune']); 
							$('#communenom_txt').text(array[0]['commune']);
							}
						else { response(array); 
						//$("#check-btn").focus(); 
						};
								
						
 						
 					}); 
 				}, 
		
		focus: function(event, ui) { 
 					// prevent autocomplete from updating the textbox 
 					event.preventDefault(); 
 				}, 
 		select: function(event, ui) { 	
 					$("#INSEEcode" ).val(ui.item.value);
					$('#postalcode').val(ui.item.code_postal); 
					$('#communenom').val(ui.item.commune); 
					$('#communenom_txt').text(ui.item.commune);
					return false;
 				} 
 			}); 

$(document).ready(function(e) {
	var nb_conteneur = 1;
	var currentTotal = 0;
	var ligne;
	var tableau = [];
		
	//Rendre les conteneurs "draggable"
	/*$(".draggable-conteneur").draggable({
		helper: 'clone',
		cursor: 'move',
	});*/
	
	//Rendre les déchets "draggable"
	$(".draggable-dechet").draggable({
		revert: 'invalid',
		helper: 'clone',
		cursor: 'move',
	});
		
	
	var drpOptions = {
  drop: function(event, ui) {
    $(this).append( ui.draggable.text() + "<br>" );
	ui.draggable.remove();
  }
};
var drpOptions_conteneur = 
{
		accept: '.draggable-dechet',
		//tolerance: 'fit',
		drop: function(event, ui) 
			{
				var target = event.target || event.srcElement;
				//$(ui.draggable).clone().appendTo($(target));
				
				nb_conteneur += 1;
				//ui.draggable.children('span').text();
				
				ligne = this.id+";"+ui.draggable.children('span').text();//[nb_conteneur, target.id, "Apple", "Mango"];
				
				//ui.draggable.children('span').text("");
				
				
				tableau.push(ligne);	
								
				$(this).append(ui.draggable.clone());
				ui.draggable.remove();

			}
			
};


//$( "#Sac" ).children().droppable( drpOptions );
$( "#global_vert" ).droppable( drpOptions_conteneur );
$( "#global_blanc" ).droppable( drpOptions_conteneur );
$( "#global_gris" ).droppable( drpOptions_conteneur );
$( "#global_noir" ).droppable( drpOptions_conteneur );
$( "#global_rouge" ).droppable( drpOptions_conteneur );
$( "#global_marron" ).droppable( drpOptions_conteneur );
$( "#global_bleu" ).droppable( drpOptions_conteneur );
$( "#global_jaune" ).droppable( drpOptions_conteneur );
$( "#global_autre" ).droppable( drpOptions_conteneur );
$( "#global_nsp" ).droppable( drpOptions_conteneur );



$( "#postalcode" ).click(function() {

  $("#INSEEcode" ).val('');
  $('#postalcode').val('');
  $('#communenom').val('');
  $('#communenom_txt').text('');
  $("#alert").remove();
  var div = $("#postalcode").closest("div");
  div.removeClass("has-error");
});

$( "#postalcode" ).focus(function() {

  $("#INSEEcode" ).val('');
  $('#postalcode').val('');
  $('#communenom').val('');
  $('#communenom_txt').text('');
  $("#alert").remove();
  var div = $("#postalcode").closest("div");
  div.removeClass("has-error");
});



$( "#postalcode" ).keydown(function(event) {
	 if (($("#INSEEcode" ).val()!='') && ( event.which != 13 )) {
	 	$("#INSEEcode" ).val('');
		$('#communenom').val('');
		$('#communenom_txt').text('');
		$("#alert").remove();
		var div = $("#postalcode").closest("div");
		div.removeClass("has-error");
	}
});

$("#check-btn").click(function() {
				

				 if($("#postalcode").val()== "" || $("#INSEEcode" ).val()== "")
								{
								var div = $("#postalcode").closest("div");
								div.removeClass("has-success");
								$("#glypcn_postalcode").remove();
								div.addClass("has-error has-feedback");
								div.append('<div id="alert" class="alert alert-danger" role="alert">La saisie d\'un code postal valide et la sélection de la ville associée sont obligatoires</div>');
								event.preventDefault();
								}
								else
									{
									//alert("bonjour");
									var div = $("#postalcode").closest("div");
									div.removeClass("has-error");
									div.addClass("has-success has-feedback");
									$("#glypcn_postalcode").remove();
									div.append('<span id="glycpn_postalcode" class="glyphicon glyphicon-ok form-control-feedback"></span>');
									//event.preventDefault();
									
									$.ajax({
									url: 'traitement.php',
									data: 'maVariable='+tableau+"&codepostal="+$('#postalcode').val()+"&codeINSEE="+$("#INSEEcode" ).val(),
									success: function(reponse) {
									var cible= 'feedback.php?id='+reponse;
									document.location.replace(cible);
									}
									});
									
								}
			
});
			
$('#myModal').on('shown.bs.modal', function () {
  $('#postalcode').focus()
})
			
			
			
			
});


</script>
<br><br><br>
<img style="position: relative;padding-top: 12px;height="4%" width="4%"" class="img-responsive" src="img/la_ruche_logo_lg.jpg" ALIGN="middle"> 
<span style="font-size: 12px;">Empowered by LaRuche</span>	<br>.
</body>
</html>
