<?php 
require("connections/mysql.php"); 
include ("jpgraph-4.0.0/src/jpgraph.php");
include ("jpgraph-4.0.0/src/jpgraph_bar.php");
include ("jpgraph-4.0.0/src/jpgraph_line.php");
include ("jpgraph-4.0.0/src/jpgraph_utils.inc.php");
 
 //echo $t= strtotime('2016-07-05');
 
 //recup données
 
$sql = "select from_unixtime(`id_declarant`, '%Y-%m-%d-%H') as jour, `id_declarant`, count(distinct(`id_declarant`)) as nb 
		FROM couleur_dechet 
		WHERE id_declarant > ".strtotime('2016-07-06')."
		GROUP BY from_unixtime(`id_declarant`, '%Y-%m-%d-%H') 
		ORDER BY from_unixtime(`id_declarant`, '%Y-%m-%d-%H') " ;


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
        //print_r($row);
		//echo"<br>";
		
		/*
		if( strtotime($row['jour']) < strtotime('2016-07-06'))
		{
		$nb_sum += $row['nb'];
		$ydata[0] = $nb_sum;
		}
		else
		{		
		*/
		$xdata []= strtotime($row['jour']);
		//$nb_sum += $row['nb'];
		$ydata []= $row['nb'];
		
		/*
		}	
		*/
    };
//echo "<br><br><br>";
//print_r($xdata);
//echo "<br><br><br>";
//print_r($ydata);


// Get a dataset stored in $xdata and $ydata
//require_once ('dataset01.inc.php');
 
$dateUtils = new DateScaleUtils();
 
// Setup a basic graph
$width=600; $height=200;
$graph = new Graph($width, $height);
 
// We set the x-scale min/max values to avoid empty space
// on the side of the plot
$graph->SetScale('intlin',0,0,min($xdata),max($xdata));
$graph->SetMargin(60,40,40,80);
 
// Setup the titles
$graph->title->SetFont(FF_FONT2,FS_BOLD,12);
//$graph->title->Set('Nombre de contribution par heure');
$graph->subtitle->SetFont(FF_FONT1,FS_ITALIC,10);
$graph->subtitle->Set('Contributions/heure');
 
$graph->ygrid->Show(true,true);
$graph->xgrid->Show(true,true);
$graph->SetAxisStyle(AXSTYLE_YBOXIN); 
 
// Setup the labels to be correctly format on the X-axis
$graph->xaxis->SetFont(FF_FONT0,FS_NORMAL,6);
$graph->xaxis->SetLabelAngle(90);
 
// The second paramter set to 'true' will make the library interpret the
// format string as a date format. We use a Month + Year format
$graph->xaxis->SetLabelFormatString('Y.m.d',true);
 
// Get manual tick every second year
list($tickPos,$minTickPos) = $dateUtils->getTicks($xdata,DSUTILS_DAY1);
$graph->xaxis->SetTickPositions($tickPos,$minTickPos);
//$graph->xaxis->scale->SetTimeAlign( DAYADJ_1 );

// First add an area plot
$lp1 = new LinePlot($ydata,$xdata);
$lp1->SetLegend($lp1_lib_legende);
$lp1->SetWeight(0);
$lp1->SetStepStyle(); 
$lp1->SetFillColor('#f8a300@0.85');
$graph->Add($lp1);
$lp1->SetColor('#f8a300');
 
// And then add line. We use two plots in order to get a
// more distinct border on the graph
//$lp2 = new LinePlot($ydata,$xdata);
//$lp2->SetColor('blue');
//$graph->Add($lp2);
 
// And send back to the client
$graph->Stroke();



?>  


