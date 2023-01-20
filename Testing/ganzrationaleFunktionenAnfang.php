<?php 
	include_once '../Import/php/restrict-access.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">

	<title>Artikel Prototype</title>

	<!-- this specific -->
	<script type="text/javascript" src="../Import/js/canvas2.js"></script>
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
	<script type="text/javascript" src="../Import/js/slider.js"></script>

	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<style type="text/css">
			



/* start hier*/

.important4 .range-slider{
	display: inline-block;
	width: initial;
	min-width: 70%;
}

.important4 li > span{
	display: inline-block !important;
	width: 25%;
	max-width: 160px;
}

.canvas-inner-wrapper{
	height: 280px;
}


/*end hier*/




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
		<h3 class="title">Artikel Name</h3>
		<div class="box inhalt">
			<div class="topic">Inhalt</div>
			<div class="topic-ul">
				<a href="#Binomische-Formeln">1. Die Funktionsgleichung</a>
				<a href="#Die-Parabel">2. Verlauf und Symmetrie</a>
				<a href="#Scheitelpunktform">3. Nullstellen</a>
				<a href="#Allgemeine-Form">4. Polynomdivision</a>
				<a href="#Zusammenfassung">5. Zusammenfassung</a>		
			</div>
		</div>



<!-- article TODO 
	- article meta

-->



		<div class="box content-box">
			<div class="anchor" id="Proportionalität"></div>
			<h3 class="topic">1. Allgemeine Form</h3>

			

			<!-- von Hier -->


<script type="text/javascript" src="../Import/js/canvas3/all.js"></script>
<script type="text/javascript" src="../Import/js/canvas2.js"></script>


<div class="important">
	<li>Eine ganzrationale Funktion ist eine Funktion der Form:
			$$f(x) = a_nx^n+a_{n-1}x^{n-1}+...+a_1x^1+a_0x^0$$
	</li>
</div>
<p>Ganzrationale Funktionen, oder auch Polynomfunktionen, bestehen aus mehreren Summanden \(a_kx^k\). Dabei wird \(a_k\) als Koeffizient vor der Potenz \(x^k\) bezeichnet.</p>
<div class="example">
	<li>$$f(x)=4x^3+-2x^2+\frac 12 x + 2$$ </li>
	<li>Die Zahlen \(4,~-2,~\frac 12~\text{ und } 2\) sind die Koeffizienten <br>und \(x^3,~x^2,~x^1=x\text{ bzw.}~x^0=1\) sind die Potenzen.</li>
</div>
<p>
	Bei der ganzrationalen Funktion kann ein Koeffizient jede beliebige reelle Zahl sein. Insbesondere kann ein Koeffizient auch gleich 0 sein. Zu den ganzrationalen Funktionen gehören auch konstante, lineare und quadratische Funktionen sowie die Potenzfunktionen:
</p>
<div class="example example1">
	<li>$$f(x)=3x^0=3$$</li>
	<div class="expl-hr"></div>
	<li>$$\begin{eqnarray}g(x)&=&4x^1+\sqrt 2\times x^0\nonumber \\&=&4x+\sqrt 2\end{eqnarray}$$</li>
	<div class="expl-hr"></div>
	<li>$$\begin{eqnarray}h(x)&=&-2,5 x^2 + 0 x^1 + 2x^0 \nonumber \\&=&-2,5x^2+2\end{eqnarray}$$</li>
	<div class="expl-hr"></div>
	<li>$$\begin{eqnarray}k(x)&=&x^5+0x^4+0x^3+0x^2+0x^1+0x^0 \nonumber \\&=&x^5\end{eqnarray}$$</li>
</div>
<div class="important"><li>Eine Funktion \(f(x)=a_nx^n+a_{n-1}x^{n-1}+...+a_0x^0\) wird auch als ganzrationale Funktion n-ten Gerades bezeichnet. Dabei ist n der höchste Exponent der Funktion.</li></div>
<div class="example">
	<li>\(f(x)=3x^5+2x\) hat den Grad 5.</li>
	<li>\(g(x)=-x\) hat den Grad 1.</li>
	<li>\(h(x)=x^2+2x+1\) hat den Grad 2.</li>
</div>





			<!-- bis Hier -->





	</div>





	<div class="box content-box">
			<div class="anchor" id="Die-Parabel"></div>
			<h3 class="topic">2. Verlauf und Symmetrie</h3>
<div class="example">
	<li>Ganzrationale Funktionen sehen wie folgt aus:</li>
	<div class="expl-hr"></div>
	<li>
		$$\begin{eqnarray}
			f(x)&=&3x^5+2x^4-3x  \nonumber \\ g(x)&=& \frac 12 x^4 + 2x^2 +x \nonumber \\
			h(x)&=& x^6-2x^3-x+1
		\end{eqnarray}$$
	</li>
	<li>
		<div class="canvas-outer-wrapper canvas-box1">
			<div class="canvas-inner-wrapper canvas-inner-box1">
				<canvas id="canvas1" width="2000px" height="1000"></canvas>
			</div>
			<script type="text/javascript">
				setvar(50,4,3,[
					[function (x){return(3*Math.pow(x,5)+2*Math.pow(x,4)-3*x)},"rgb(11,153,11)",1], 
					[function (x){return(.5*Math.pow(x,4)+2*Math.pow(x,2)+x)},"rgb(66,44,255)",1],
					[function (x){return(Math.pow(x,6)-2*Math.pow(x,3)-x+1)},"rgb(204,37,41)",1]
					],"canvas1",10,15,5,"x","y",0,0);

				setpoints(50,4,3,"rgb(11,153,11)",0,16,[[-2 , 1,"f(x)", 0,0],], "canvas1");
				setpoints(50,4,3,"rgb(66,44,255)",0,16,[[-2.5 ,2 ,"g(x)", 0,0],], "canvas1");
				setpoints(50,4,3,"rgb(204,37,41)",0,16,[[2 , 2,"h(x)", 0,0],], "canvas1");
			</script>
		</div>
	</li>
</div>
<p>Man kann sie nach oben und unten <b>entlang der y-Achse verschieben</b>, indem man zu jedem Funktionswert einen festen Wert c addiert. Da c für jedes Argument gleich ist, wird es auch als <b>konstantes Glied</b> bezeichnet.</p>
<div class="important important3">
	
</div>
<p>
	Der Funktionsgraph kann auch <b>entlang der x-Achse verschoben werden</b>, indem man statt x immer mit dem Wert <b>d Schritte weiter links bzw. rechts</b> von x rechnet. Man ersetzt also x mit (x + d). Dabei wird der Graph <b>um -d Einheiten verschoben</b>, da derselbe Funktionswert immer schon d Einheiten früher erreicht wird. 
</p>
<div class="important important4">
	
</div>
<p>
	Parabeln können auch <b>gestreckt, gestaucht und an der x-Achse gespiegelt werden</b>. Dazu multipliziert man \(x^2\) mit dem Faktor a. <br>Für \(\lvert{a}\rvert > 1\) wird der Graph gestreckt und für \(\lvert{a}\rvert < 1\) gestaucht. Für ein negatives a wird der Graph zusätzlich nach unten gespiegelt und ist dann nach unten geöffnet.
</p>
<div class="important important4">
	
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