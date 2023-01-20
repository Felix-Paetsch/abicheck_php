<?php 
	include_once '../Import/php/restrict-access.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<title>Testing</title>
</head>
<body>
</body>
</html>

<!--


INSERT INTO `rechner` (`rechner_id`, `rechner_name`, `article_name`, `import_filesJsCss_AndMeta`, `rechner_input`, `rechner_output`, `ref_link`, `JSscript`, `import_filesPHP`) VALUES (NULL, '', '', '', '', '', '', '', '');
UPDATE `rechner` SET 
		`rechner_name` = 'Nullstellen Linearer Funktionen', `article_name` = 'Lineare Funktionen', `import_filesJsCss_AndMeta` = '', `rechner_input` = '<p class=\"was-du-eingeben-sollst-p\">Gib die Funktion ein, deren Nullstelle du bestimmen möchtest: </p>\r\n 		<div class=\"rechner_input_text\">\r\n 			\\(f(x) =\\)<span id=\"text\">m\\cdot x+n</span>\r\n			<input type=\"button\" name=\"submit\" id=\"button\" value=\"Los\">\r\n		</div>',  `rechner_output` = 'Die Nullstelle der Funktion ist: <span id=\"nullstellen-span\"></span>\r\n		<div class=\"stylelinie\"></div>\r\n		<div class=\"funktionsgraph\">\r\n			<div id=\"funktions-name\"></div>\r\n			<div class=\"slidercontainer\" id = \"slidercontainer\"></div>\r\n			<div class=\"canvas-outer-wrapper canvas-big canvas-box3\">\r\n				<div class=\"canvas-inner-wrapper canvas-inner-box3\">\r\n		        	<canvas id=\"canvas\" width=\"1100px\" height=\"450px\"></canvas>\r\n		    	</div>\r\n			</div>\r\n		</div>', `ref_link` = 'Wie du die Nullstellen einer Linearen Funktion berechnen kannst, erfährst du <a href=\"#\">hier.</a>\r\n', `JSscript` = 'var mathFieldSpan = document.getElementById(\'text\');\r\nvar textfield_latex_input;\r\nvar mathField = MQ.MathField(mathFieldSpan, {\r\n   spaceBehavesLikeTab: true,\r\n   handlers: {\r\n     edit: function() {\r\n         textfield_latex_input = mathField.latex().replace(/,/, \".\");\r\n		 textfield_latex_input = mathField.latex();\r\n	    }\r\n	}\r\n});\r\n\r\n textfield_latex_input = mathField.latex().replace(/,/, \".\");\r\n textfield_latex_input = mathField.latex();\r\n document.getElementById(\"button\").addEventListener(\"click\", function(){\r\n	 insertLatexSolInSpan(textfield_latex_input, \"nullstellen-span\");\r\n	 removeClass(\".ergebnis\", \"disnone\");\r\n	 document.getElementById(\"funktions-name\").innerHTML = \"\\\\(f(x)=\" + textfield_latex_input + \"\\\\)\";\r\n	 setupRechnerCanvas();\r\n     MathJax.typeset();\r\n });\r\n\r\n var KnownValues = {};\r\n var NerdamerUserFunction;\r\n\r\n function handlefunctions(){\r\n	 NerdamerUserFunction = getNerdamerCodeFromLatex(textfield_latex_input);\r\n	 relateSliderToFunction(getVariables(textfield_latex_input), Canvas);\r\n	 Canvas.createFunctions([UserFunction, \"rgba(20,160,152,1)\"]);\r\n}\r\n\r\n function UpdateOnSliderDrag(){\r\n	 relateSliderToFunction(getVariables(textfield_latex_input), Canvas);\r\n	 Canvas.update();\r\n}\r\n\r\n function insertLatexSolInSpan(LatexInput, ElementId){\r\n 	try {\r\n		 var Nullstellen = createEqnSolutionArray(LatexInput, \"0\");\r\n		 var Nullstellenhtml = NullstellenArrayToHtml(Nullstellen);\r\n		 if(Nullstellen.length === 0){\r\n			 insertKeineLösungen(ElementId);\r\n			 return;\r\n		}\r\n		document.getElementById(ElementId).innerHTML = Nullstellenhtml;\r\n	}\r\n	catch (e) {\r\n		insertKeineLösungen(ElementId);\r\n	}\r\n}\r\n\r\n function insertKeineLösungen(ElementId){\r\n 	document.getElementById(ElementId).innerHTML = \"Die Funktion hat keine Nullstellen\";}\r\n\r\n function setupRechnerCanvas(){\r\n	 Canvas = new FunctionGraphObject(\"canvas\");\r\n	 Canvas.updateOrigin(5, 5);\r\n	 Canvas.grid.createArrows();\r\n	 createUserSlider();\r\n	 handlefunctions();\r\n	 Canvas.update();\r\n }\r\n\r\n function getVariables(text){\r\n	 var variables = nerdamer.convertFromLaTeX(text).variables();\r\n	 var VariablesWithoutX = [];\r\n	 for (var i in variables){\r\n	 	if (variables[i] != \"x\") VariablesWithoutX.push(variables[i]);\r\n	 }\r\n	 return VariablesWithoutX;\r\n}\r\n\r\n function createUserSlider(){\r\n	 ToCreateSliderArray = [];\r\n	 getVariables(textfield_latex_input).forEach(element => ToCreateSliderArray.push([element, [-5, 5]]));\r\n	 document.getElementById(\"slidercontainer\").innerHTML = \"\";\r\n	 Canvas.createSlidersFromArray(\"slidercontainer\", ToCreateSliderArray);\r\n}\r\n\r\nfunction relateSliderToFunction(variables, FGO){\r\n	 KnownValues = {};\r\n	 for (var i = 0; i < variables.length; i++){\r\n	 	KnownValues[variables[i]] = FGO.sliderValues[i];\r\n	 }\r\n	 nerdamer.setFunction(\'f\', [\'x\'], nerdamer(NerdamerUserFunction, KnownValues));\r\n}\r\n\r\n function UserFunction(x){\r\n 	return +nerdamer(\"f(\".concat(x, \")\")).text();\r\n }', `import_filesPHP` = '../Import/php/rechner-gleichungen-package.php' WHERE rechner_id = 1;
#1596384927     02/08/2020  16:15:27
INSERT INTO `themengebiete` (`tg_id`, `tg_name`, `tg_introduction`, `link_blue`, `rechner`) VALUES 
            (NULL, 'Analysis', 'Analysis beschäftigt sich mit Funktionen und ihren Eigenschaften. Du findest hier eine Übersicht über alle wichtigen Funktionen, ihre Eigenschaften und wie man mit ihnen rechnet.</p>\r\n <p>Wenn du dir weitere Artikel wünschst oder eine Erklärung nicht ganz verstanden hast, kannst du uns gerne Feedback dazu geben.', '<a href=\"../Tests/q=Analysis\"><h4>Tests</h4></a> <div id=\"feedback-btn\" onclick=\"feedbackClicked()\"><h4>Feedback</h4></div>', '<a href=\"#\">Taschenrechner</a> <a href=\"#\">Nullstellen finden</a> <a href=\"#\">Gleichungen umstellen</a> <a href=\"#\">Ableiten</a> <a href=\"#\">Integrieren</a>');
#1596385116     02/08/2020  16:18:36
INSERT INTO `subgebiete` (`sub_id`, `sub_name`, `tg_name`) VALUES (NULL, 'Funktionstypentryout', 'Analysis');
#1596385159     02/08/2020  16:19:19
INSERT INTO `articles` (`article_id`, `article_name`, `sub_name`, `article_style`, `übungen_style`, `reihenfolge`, `article_meta`) VALUES 
							(NULL, Addition, Funktionstypen?tryout, ???fah, asdhhh, 1, feeaaaaaaaaa);
#1596385247     02/08/2020  16:20:47
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;
#1596385477     02/08/2020  16:24:37
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;
#1596385496     02/08/2020  16:24:56
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;
#1596385522     02/08/2020  16:25:22
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;
#1596385562     02/08/2020  16:26:02
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;
#1596385605     02/08/2020  16:26:45
UPDATE `articles` SET article_style =  WHERE `articles`.`article_name` = Addition ;