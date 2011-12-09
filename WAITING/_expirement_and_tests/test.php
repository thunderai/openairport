
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>


<style type="text/css">
.menu {
z-index:1000;
font-size:90%;
}

/* remove all the bullets, borders and padding from the default list styling */
.menu ul {
padding:0;
margin:0;
list-style-type:none;
width:150px;
}
/* hack for IE5.5 */
* html .menu ul {margin-left:-16px; ma\rgin-left:0;}
/* position relative so that you can position the sub levels */
.menu li {
position:relative;
background:#d4d8bd;
height:26px;
}

/* get rid of the table */
.menu table {position:absolute; border-collapse:collapse; top:0; left:0; z-index:100; font-size:1em;}

/* style the links */
.menu a, .menu a:visited {
display:block; 
text-decoration:none;
height:25px;
line-height:25px;
width:149px;
color:#000;
text-indent:5px;
border:1px solid #fff;
border-width:0 1px 1px 0;
}
/* hack for IE5.5 */
* html .menu a, * html .menu a:visited {background:#d4d8bd; width:150px; w\idth:149px;}
/* style the link hover */
* html .menu a:hover {color:#fff; background:#949e7c;}

.menu :hover > a {
color:#fff; 
background:#949e7c;
}

/* hide the sub levels and give them a positon absolute so that they take up no room */
.menu ul ul {
visibility:hidden;
position:absolute;
top:0;
left:150px; 
}
/* make the second level visible when hover on first level list OR link */
.menu ul :hover ul{
visibility:visible;
}
/* keep the third level hidden when you hover on first level list OR link */
.menu ul :hover ul ul{
visibility:hidden;
}
/* keep the fourth level hidden when you hover on second level list OR link */
.menu ul :hover ul :hover ul ul{
visibility:hidden;
}
/* make the third level visible when you hover over second level list OR link */
.menu ul :hover ul :hover ul{ 
visibility:visible;
}
/* make the fourth level visible when you hover over third level list OR link */
.menu ul :hover ul :hover ul :hover ul { 
visibility:visible;
}
</style>
<!--[if IE 7]>
<style type="text/css">
.menu li {float:left;}
</style>
<![endif]-->


</head>

<body>
<div id="wrapper">
<a href="#content" class="hiddenfromview" accesskey="X" title="skip to content">skip to content</a>

<div id="page_head">

<h1 id="logo"><a accesskey="1" href="../index.html" title="Home Page"><b>CSS</b>play</a></h1>
<h2 id="slogan">Experiments with Cascading Style Sheets</h2>



<ul id="main_menu">

<li><a class="mm1"  accesskey="D" href="../menu/index.html"><b>DEMOS</b></a></li><li><a accesskey="M" href="index.html" title="List"><em>MENUS</em></a></li><li><a class='mm3' accesskey="Y" href='../layouts/index.html'><b>LAYOUTS</b></a></li><li><a class="mm4" accesskey="B" href="../boxes/index.html"><b>BOXES</b></a></li><li><a class="mm5" accesskey="Z" href="../mozilla/index.html"><b>MOZILLA</b></a></li><li><a class="mm6" accesskey="E" href="../ie/index.html"><b>EXPLORER</b></a></li><li><a class="mm7" accesskey="O" href="../opacity/index.html"><b>OPACITY</b></a></li>
</ul>

<ul id="sub_menu">


<li class="home"><a href="../index.html"  accesskey="H" title="Home Page">Home</a></li>

<li class="first"><a href="index.html" accesskey="F" title="First - Section List">First</a></li><li class="previous"><a href="flyoutt.html" accesskey="P" title="Previous">Previous</a></li><li class="next"><a href="flyout4.html" accesskey="N" title="Next">Next</a></li><li class="last"><a href="vertical_slide.html" accesskey="L" title="Last">Last</a></li>
<li class="comments"><a href="http://www.cssplay.co.uk/comments/comments.php?comment_id=Revised%20flyout%20menu"  accesskey="C" title="Comments for this page">COMMENTS</a></li>

<li class="tutorial_off">&nbsp;</li></ul>

</div> <!-- end of page_head -->
<div id="info">

<h2>A revised and simplified flyout menu with THREE sub levels </h2>
<h3>28th July 2006</h3>


<div class="menu">
<ul>
<li><a href="../index.html">Item 1</a></li>
<li><a href="#nogo">Item 2</a></li>
<li class="sub"><a href="#nogo">Item 3 &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul>
	<li><a href="../index.html">Item 3a</a></li>
	<li class="sub"><a href="#nogo">Item 3b &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="../index.html">Item 3bi</a></li>
			<li><a href="#nogo">Item 3bii</a></li>
			<li class="sub"><a href="#nogo">Item 3biii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 3biii-1</a></li>
					<li><a href="#nogo">Item 3biii-2</a></li>
					<li><a href="#nogo">Item 3biii-3</a></li>
					<li><a href="#nogo">Item 3biii-4</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li><a href="#nogo">Item 3c</a></li>
	</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
<li><a href="#nogo">Item 4</a></li>
<li><a href="#nogo">Item 5</a></li>
<li><a href="#nogo">Item 6</a></li>

</ul>
</div>



</div> <!-- end of info -->