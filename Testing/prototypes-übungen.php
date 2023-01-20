<?php 
	include_once '../Import/php/restrict-access.php';
?>
<!DOCTYPE html>

<html>
<head>
	<meta name="robots" content="noindex">
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">

	<title>Übungen Prototype</title>

	<!-- this specific -->
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
	<script type="text/javascript" src="../Import/js/slider.js"></script>

	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/übungen.css">

	<style>
		/*style */
	</style>
</head>

<body>
<?php include_once '../Import/php/header.php'; ?>
<div id="left-fixed" class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="../Analysis">Übersicht</a>
		<div class="fixed-head fixed-head-b">Funktionstypen</div>
		<div class="fixed-ul">
			<a href="?Funktionstypen/Exponentialfunktionen">Exponentialfunktionen</a>
			<a href="?Funktionstypen/Lineare Funktionen">Lineare Funktionen</a>
		</div>
	</div>
</div>

<div id="main-wrapper">
	<div class="main-content">
		<h3 class="title">
			<a>Artikel Name</a> <br><span>Übungen</span>
		</h3>

	<div class="aufgaben-bar">
		<div id="label-1" class="label active" onclick="
				removeClass('.label', 'active');
				addClass('#label-1', 'active');
				addClass('.aufgabe', 'disnone');
				removeClass('#aufgabe1', 'disnone');
			">1</div>
		<div id="label-2" class="label " onclick="
				removeClass('.label', 'active');
				addClass('#label-2', 'active');
				addClass('.aufgabe', 'disnone');
				removeClass('#aufgabe2', 'disnone');
			">2</div>
		<div id="label-3" class="label " onclick="
				removeClass('.label', 'active');
				addClass('#label-3', 'active');
				addClass('.aufgabe', 'disnone');
				removeClass('#aufgabe3', 'disnone');
			">3</div>
		<div id="label-4" class="label " onclick="
				removeClass('.label', 'active');
				addClass('#label-4', 'active');
				addClass('.aufgabe', 'disnone');
				removeClass('#aufgabe4', 'disnone');
			">4</div>
		<div id="label-5" class="label " onclick="
				removeClass('.label', 'active');
				addClass('#label-5', 'active');
				addClass('.aufgabe', 'disnone');
				removeClass('#aufgabe5', 'disnone');
			">5</div>
	</div>


<div class="aufgabe" id="aufgabe1">
		<div class="aufgabe-top">







			<!-- von Hier -->

<script type="text/javascript" src="../Import/js/canvas3/all.js"></script>
<script type="text/javascript" src="../Import/js/canvas2.js"></script>



<div class="aufgabenstellung"><span style="text-decoration-line: underline;">Aufgabe 6:</span> Bakterienkultur</div>
<p>Eine Bakterienkultur verdoppelt sich alle zwei Stunden. Am Anfang sind 1000 Bakterien vorhanden.</p>
<ol class="aufgaben-ol">
	<li>
		Finde zwei Funktionsgleichungen, die diesen Vorgang beschreiben. Die erste soll die Form \(f(Zeit)=Anzahl\) und die zweite die Form \(g(Anzahl)=Zeit\) haben. Wie kommt man von einer Funktion zur anderen?
	</li>
	<li>
		Nach welcher Zeitspanne gibt es 2000, 3000, 10000 Bakterien?
	</li>
	<li>
		Zeichne die Graphen beider Funktionen (z.B. mit Hilfe einer Wertetabelle). Die Startpopulation ist jeweils \(100\% = 1\). Wie hängen die beiden Graphen zusammen?
	</li>
</ol>



			<!-- bis hier -->







		</div>
		<div class="exp-head" onclick="toggleClass('#arrowbox1', 'exp-active'); toggleClass('#sol1', 'disnone'); toggleClass('#einblendenA1', 'disnone'); toggleClass('#ausblendenA1', 'disnone')">
			<span id="einblendenA1">Lösungen einblenden</span>
			<span class="disnone" id="ausblendenA1">Lösungen ausblenden</span>
			<div id="arrowbox1" class="arrowbox">
				<div class="exp-arrow"></div>
				<div class="exp-arrow exp-arrow2"></div>
			</div>
		</div>
		<div class="solution disnone" id="sol1">
			<span class="lösungentitle">Lösungen:</span>




			<!-- von hier -->



<ol>
	<li><span>\(f(Zeit)=Anzahl\):</span>
		<span>Bei \(f(x)\) handelt es sich um eine Exponentialfunktion: $$f(x)=1000\times 2^{x/2}$$</span>
		<span style="margin-top:10px; margin-bottom: 5px;">\(g(Anzahl)=Zeit\):</span>
		<span>Mit der Funktion f(x) kann man die Anzahl berechnen, indem man mit der Zeit x eine Rechnung durchführt. Um zur Zeit zu gelangen muss man diese Rechnung umkehren:</span>
		<span>$$\begin{eqnarray} f(x)&=&1000\times 2^{x/2} &|& :1000\nonumber \\
			\frac{f(x)}{1000} &=& 2^{x/2} &|& log \nonumber \\[5pt]
			\frac x2 &=& log_2\left(\frac {f(x)}{1000}\right) &|& \times 2 \nonumber \\[5pt]
			x &=& 2\times log_2\left(\frac {f(x)}{1000}\right)
		\end{eqnarray}$$</span>
		<span>\(f(x)\) ist die dabei die Zeit und x die Anzahl. Also ist das eine Gleichung, mit der man die Zeit in Abhängigkeit von der Anzahl angeben kann:</span>
		<span>$$g(n) = 2\times log_2\left(\frac n{1000}\right)$$</span>
		<span>Man kommt also von einer Funktionsgleichung zur anderen, indem man zum Argument umstellt.</span>
	</li>
	<li><span>Nach welcher Zeitspanne gibt es 2000, 3000, 10000 Bakterien?</span>
		<span>Setzt man in g(n) ein, erhält man:</span>
		<span>$$\begin{eqnarray}g(2000)&&=2\nonumber \\ g(3000)&&\approx3,17\nonumber \\ g(10000)&&\approx6,64\end{eqnarray}$$</span>
		<span>Es gibt also 2000, 3000 bzw. 10000 Bakterien nach rund 2 bzw. 3,17 bzw. 6,64 Stunden.</span>
	</li>
	<li>
		<span>Zeichne die Graphen beider Funktionen. Die Startpopulation ist jeweils \(100\% = 1\). Wie hängen die beiden Graphen zusammen?</span>
		<span style="margin-top: 10px;">
			<div class="canvas-outer-wrapper canvas-big canvas-box5">
				<div class="canvas-inner-wrapper canvas-inner-box5" id="canvasI4">
					<canvas id="canvas9" width="2000px" height="1000px"></canvas>
				</div>
			</div>
<script type="text/javascript">
Canvas9 = new FunctionGraphObject("canvas9");
Canvas9.updateOrigin(6, 6);
Canvas9.updateunitWidth(40);
Canvas9.grid.createArrows();
Canvas9.createFunctions(
[(x) => {return Math.pow(2,x/2);}, "rgb(66,44,255)"],
[(x) => {return 2*Math.log(x)/Math.log(2);}, "rgb(11,153,11)"],
[(x) => {return x;}, "rgb(200,200,200)"]

);
Canvas9.pointradius = 0;
Canvas9.createPoints("rgb(66,44,255)", ["\\(f(x)=2^x\\)", -3, 2]);
Canvas9.createPoints("rgb(11,153,11)", ["\\(g(x)=log_2(x)\\)", 1, -2]);
Canvas9.createPoints("rgb(200,200,200)", ["\\(h(x)\\)", 3.5, 2.5]);
Canvas9.update();
</script>
		</span>
		<span style="margin-top: 10px;">
			Spiegelt man \(f(x)\) an der Geraden \(h(x)=x\), erhält man g(x). Das liegt daran, dass die beiden Funktionen den Funktionswert mit dem Argument tauschen. Das heißt, ist \(f(x)=y\), dann gilt \(g(y)=x\). Diesen Zusammenhang kann man auch beschreiben mit \(f\left(g(x)\right)=g\left(f(x)\right)=x.\) Man sagt, \(f(x)\) ist die Umkehrfunktion zu \(g(x)\). 
		</span>
	</li>
</ol>



			<!-- bis hier -->




		</div>
</div>




	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>


<?php 
	include_once '../Import/php/feedback.php';
	include_once '../Import/php/footer.php'; 
?>

</body>
</html>