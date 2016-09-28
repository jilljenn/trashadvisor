<?php 
require("connections/mysql.php"); 
include ("jpgraph-4.0.0/src/jpgraph.php");
include ("jpgraph-4.0.0/src/jpgraph_bar.php");
include ("jpgraph-4.0.0/src/jpgraph_line.php");
include ("jpgraph-4.0.0/src/jpgraph_utils.inc.php");
 
 
 
 //recup données
 
$sql = "select from_unixtime(`id_declarant`, '%Y-%m-%d') as jour, `id_declarant`, 
		count(distinct(`id_declarant`)) as nb, 
		count(distinct(`code_INSEE`)) as nb_commune 
		FROM couleur_dechet 
		GROUP BY from_unixtime(`id_declarant`, '%Y-%m-%d') 
		ORDER BY from_unixtime(`id_declarant`, '%Y-%m-%d') " ;


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
		$xdata []= strtotime($row['jour']);//		
		$nb_sum += $row['nb'];
		$ydata []= $nb_sum;
    };


// recup donnée nb de nouvelles communes par jour
$sql2 = "SELECT from_unixtime(b.`stamp`, '%Y-%m-%d') as jour, b.`stamp`, COUNT(DISTINCT b.`code_COMMUNE`) as nb_commune
FROM 
(
   SELECT 
    	MIN(a.id_declarant) as `stamp`, a.code_INSEE as `code_COMMUNE`
   FROM
  `couleur_dechet` as a 
   GROUP BY a.`code_INSEE`
) as b
GROUP BY from_unixtime(b.`stamp`, '%Y-%m-%d') 
ORDER BY from_unixtime(b.`stamp`, '%Y-%m-%d')";
$res2 = $mysqli->query($sql2);
$row2 = $res2->fetch_assoc();
$res2->data_seek(0);

$xdata2 = [];
$ydata2 = [];
//$xdata[0] = strtotime('2016-07-05');
//$ydata[0] = 0;
$nb_sum = 0;

while ($row2 = $res2->fetch_assoc()) 	
    {		
		$xdata2 []= strtotime($row2['jour']);//
		$nb_sum += $row2['nb_commune'];
		$ydata2 []= $nb_sum ;
    };



// Get a dataset stored in $xdata and $ydata
//require_once ('dataset01.inc.php');
 
$dateUtils = new DateScaleUtils();
 
// Setup a basic graph
$width=600; $height=200;
$graph = new Graph($width, $height);
 
// We set the x-scale min/max values to avoid empty space
// on the side of the plot
$max_date = date('Y-m-d',strtotime(max($xdata))+3600);
//echo max($xdata);
//echo min($xdata);
$graph->SetScale('intlin',0,0,min($xdata),max($xdata)+3600*24);
$graph->SetMargin(60,40,40,60);
//$graph->SetScale('textint');
 
// Setup the titles
$graph->title->SetFont(FF_FONT2,FS_BOLD,12);
//$graph->title->Set('Nombre de contributions par jour');
$graph->subtitle->SetFont(FF_FONT1,FS_ITALIC,10);
$graph->subtitle->Set('Contributions cumulées');

$graph->legend->SetPos(0.11,0.22,'left','top'); 
 
$graph->ygrid->Show(true,true);
$graph->xgrid->Show(true,false);

 
// Setup the labels to be correctly format on the X-axis
$graph->xaxis->SetFont(FF_FONT0,FS_NORMAL,6);
$graph->xaxis->SetLabelAngle(90);
$graph->yaxis->SetFont(FF_FONT0,FS_NORMAL,6);
$graph->SetAxisStyle(AXSTYLE_YBOXIN); 
// The second paramter set to 'true' will make the library interpret the
// format string as a date format. We use a Month + Year format
$graph->xaxis->SetLabelFormatString('Y.m.d',true);

 
// Get manual tick every second year
list($tickPos,$minTickPos) = $dateUtils->getTicks($xdata,DSUTILS_DAY1);
$graph->xaxis->SetTickPositions($tickPos,$minTickPos);
// Setup titles and X-axis labels
///$graph->xaxis->title->Set('(date)');
///$graph->xaxis->SetTickLabels($xdata);

 
// First add an area plot
$lp1 = new LinePlot($ydata,$xdata);
$lp1_lib_legende = "nb contributions (".max($ydata).")";
$lp1->SetLegend($lp1_lib_legende);
$lp1->SetWeight(0);
$lp1->SetStepStyle(); 
$lp1->SetFillColor('#f8a300@0.85');
$graph->Add($lp1);
$lp1->SetColor('#f8a300');

 
// Second add an area plot
$lp2 = new LinePlot($ydata2,$xdata2);
$lp2_lib_legende = "nb communes couvertes (".max($ydata2).")";
$lp2->SetLegend($lp2_lib_legende);
$lp2->SetStepStyle(); 
$lp2->SetWeight(0);

$lp2->SetFillColor('#457725@0.7');
$graph->Add($lp2);
$lp2->SetColor('#457725');
 
// And send back to the client
$graph->Stroke();



?>  


