<?php 
	include_once '../Import/php/restrict-access.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
	<title>Rechner Prototype</title>
	<link rel="stylesheet" type="text/css" href="../Import/css/rechner.css">
	
	<!-- start hier | import js and css meta -->



	<!--end hier -->

</head>
<body>
	<?php 
		include_once '../Import/php/header.php'; 


		/*include_once import_filesPHP; (do so below)*/
		include_once '../Import/php/rechner-gleichungen-package.php';
	?>

	<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="../">Startseite</a>
		<div class="fixed-head fixed-head-b">Themengebiete</div>
		<div class="fixed-ul">
			<a href="../Grundlagen/">Grundlagen</a>
			<a href="../Geometrie/">Geometrie</a>
			<a href="../Analysis/">Analysis</a>
			<a href="../Stochastik/">Stochastik</a>
		</div>
	</div>
</div>

<div id="main-wrapper">
	<div class="main-content">
		<h3 class="title">Nullstellen Linearer Funktionen</h3>
		

		<!-- start hier | rechner input -->


		<p class="was-du-eingeben-sollst-p">Gib die Funktion ein, deren Nullstelle du bestimmen möchtest: </p>
 		<div class="rechner_input_text">
 			\(f(x) =\)<span id="text">m\cdot x+n</span>
			<input type="button" name="submit" id="button" value="Los">
		</div>


		<!-- end hier -->


		<div class="ergebnis disnone">
		

		<!-- start hier | rechner output -->


		Die Nullstelle der Funktion ist: <span id="nullstellen-span"></span>
		<div class="stylelinie"></div>
		<div class="funktionsgraph">
			<div id="funktions-name"></div>
			<div class="slidercontainer" id = "slidercontainer"></div>
			<div class="canvas-outer-wrapper canvas-big canvas-box3">
				<div class="canvas-inner-wrapper canvas-inner-box3">
		        	<canvas id="canvas" width="1100px" height="450px"></canvas>
		    	</div>
			</div>
		</div>


		<!-- end hier -->

		
		</div>
		<div class="stylelinie2"></div>
		<div class="expl-link">
		

		<!-- start hier | ref link -->


		Wie du die Nullstellen einer Linearen Funktion berechnen kannst, erfährst du <a href="#">hier.</a>


		<!-- end hier -->

		
		</div>
	</div>
</div>

<script type="text/javascript">
	

	/* start hier | javascript */


var mathFieldSpan = document.getElementById('text');
var textfield_latex_input;
var mathField = MQ.MathField(mathFieldSpan, {
   spaceBehavesLikeTab: true,
   handlers: {
     edit: function() {
         textfield_latex_input = mathField.latex().replace(/,/, ".");
		 textfield_latex_input = mathField.latex();
	    }
	}
});

 textfield_latex_input = mathField.latex().replace(/,/, ".");
 textfield_latex_input = mathField.latex();
 document.getElementById("button").addEventListener("click", function(){
	 insertLatexSolInSpan(textfield_latex_input, "nullstellen-span");
	 removeClass(".ergebnis", "disnone");
	 document.getElementById("funktions-name").innerHTML = "\\(f(x)=" + textfield_latex_input + "\\)";
	 setupRechnerCanvas();
     MathJax.typeset();
 });

 var KnownValues = {};
 var NerdamerUserFunction;

 function handlefunctions(){
	 NerdamerUserFunction = getNerdamerCodeFromLatex(textfield_latex_input);
	 relateSliderToFunction(getVariables(textfield_latex_input), Canvas);
	 Canvas.createFunctions([UserFunction, "rgba(20,160,152,1)"]);
}

 function UpdateOnSliderDrag(){
	 relateSliderToFunction(getVariables(textfield_latex_input), Canvas);
	 Canvas.update();
}

 function insertLatexSolInSpan(LatexInput, ElementId){
 	try {
		 var Nullstellen = createEqnSolutionArray(LatexInput, "0");
		 var Nullstellenhtml = NullstellenArrayToHtml(Nullstellen);
		 if(Nullstellen.length === 0){
			 insertKeineLösungen(ElementId);
			 return;
		}
		document.getElementById(ElementId).innerHTML = Nullstellenhtml;
	}
	catch (e) {
		insertKeineLösungen(ElementId);
	}
}

 function insertKeineLösungen(ElementId){
 	document.getElementById(ElementId).innerHTML = "Die Funktion hat keine Nullstellen";}

 function setupRechnerCanvas(){
	 Canvas = new FunctionGraphObject("canvas");
	 Canvas.updateOrigin(5, 5);
	 Canvas.grid.createArrows();
	 createUserSlider();
	 handlefunctions();
	 Canvas.update();
 }

 function getVariables(text){
	 var variables = nerdamer.convertFromLaTeX(text).variables();
	 var VariablesWithoutX = [];
	 for (var i in variables){
	 	if (variables[i] != "x") VariablesWithoutX.push(variables[i]);
	 }
	 return VariablesWithoutX;
}

 function createUserSlider(){
	 ToCreateSliderArray = [];
	 getVariables(textfield_latex_input).forEach(element => ToCreateSliderArray.push([element, [-5, 5]]));
	 document.getElementById("slidercontainer").innerHTML = "";
	 Canvas.createSlidersFromArray("slidercontainer", ToCreateSliderArray);
}

function relateSliderToFunction(variables, FGO){
	 KnownValues = {};
	 for (var i = 0; i < variables.length; i++){
	 	KnownValues[variables[i]] = FGO.sliderValues[i];
	 }
	 nerdamer.setFunction('f', ['x'], nerdamer(NerdamerUserFunction, KnownValues));
}

 function UserFunction(x){
 	return +nerdamer("f(".concat(x, ")")).text();
 }


	/* end hier */

		
</script>

<?php 
	include_once '../Import/php/feedback.php';
	include_once '../Import/php/footer.php'; 
?>
</body>
</html>