<?php
include_once "index_top.php";
?>

<div class="jumbotron">
	<h1>Knižnica</h1> 
	<p>Knižnica je organizovaná zbierka kníh, určená na priame používanie čitateľom, alebo kultúrna inštitúcia, ktorá organizuje spoločenské využívanie tlačených a rukopisných materiálov i ostatných hmotných zdrojov/nositeľov poznatkov a informácií.</p> 
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
<?php
echo showBox('Ukážka: <b><a href="https://www.uiam.sk/~cirka/wt2/library" target="_blank">www.uiam.sk/~cirka/wt2/library</a></b>', 'info', 0);
?>
	</div>
</div>

<p>
	<img src="img/ER-diagram.png" alt="ER diagram" class="img-responsive" style="margin: auto;">
</p>

<?php
include_once "index_bottom.php";