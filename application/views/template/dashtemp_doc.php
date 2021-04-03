<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head lang="en">
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>PHP Dashboard Documentation</title>
	<!-- Framework CSS -->
	<link rel="stylesheet" href="<?= base_url("assets/doc") ?>/blueprint-css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?= base_url("assets/doc") ?>/blueprint-css/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="<?= base_url("assets/doc") ?>/blueprint-css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<link rel="stylesheet" href="<?= base_url("assets/doc") ?>/blueprint-css/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
	<style type="text/css" media="screen">
		p, table, hr, .box { margin-bottom:25px; }
		.box p { margin-bottom:10px; }
	</style>
</head>


<body>
	<div class="container">
	
		<h3 class="center alt">&ldquo;PHP Dashboard&rdquo; Documentation by &ldquo;CiptaWeb&rdquo; v1.0</h3>
		
		<hr>
		
		<h1 class="center">&ldquo;PHP Dashboard&rdquo;</h1>
		
		<div class="borderTop">
			<div class="span-6 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
					Created: 04/04/2017<br>
					By: CiptaWeb<br>
					Email: <a href="mailto:ysfbryn@gmail.com">ysfbryn@gmail.com</a>
					</strong>
				</p>
			</div><!-- end div .span-6 -->		
	
			<div class="span-12 last">
				<p class="prepend-top append-0">Thank you for purchasing my application. If you have any questions that are beyond the scope of this help file, please feel free to email via my user page contact form <a href="http://codecanyon.net/user/ciptaweb">here</a>. Thanks so much!</p>
			</div>
		</div><!-- end div .borderTop -->
		
		<hr>
		
		<h2 id="toc" class="alt">Table of Contents</h2>
		<ol class="alpha">	
			<li><a href="#codeIgniterModel">CodeIgniter Model Structure</a></li>	
			<li><a href="#codeIgniterView">CodeIgniter View Structure</a></li>	
			<li><a href="#codeIgniterController">CodeIgniter Controller Structure</a></li>		
			<li><a href="#sourceAndCredits">Sources and Credits</a></li>
		</ol>
		
		<hr>

		<h3 id="codeIgniterModel"><strong>A) CodeIgniter Model Structure</strong> - <a href="#toc">top</a></h3>
		
		<p>This model use five methods, there are "getByQuery", "insert", "insertRet", "update" and  "delete". Here is the explanation</p>
		
		<ol>
			<li><strong>getByQuery.</strong> to select the data.</li>
			<li><strong>insert.</strong> to insert the data.</li>
			<li><strong>insertRet.</strong> to insert the data and return the id.</li>
			<li><strong>update.</strong> to update the data.</li>
			<li><strong>delete.</strong> to delete the data.</li>
		</ol>
		
		<span style="font-weight:bold">Dataaccess_mdl.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_model.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>
		
		<hr>
		
		<h3 id="codeIgniterView"><strong>B) CodeIgniter View Structure</strong> - <a href="#toc">top</a></h3>
		<p>
			This application is a fixed layout with header, menu and main. All of the information within the main content area is in folder "view/pages" and user template in folder "view/template" and the file is "table_incld.php". The menu content is in folder "view/template" and the file is "menu_incld.php". The header content is in folder "view/template" and the file is "header_incld.php". Here is the printscreen.
		</p>
		
		<span style="font-weight:bold">table_incld.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_header_view.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>
		
		<span style="font-weight:bold">menu_incld.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_menu_view.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>
		
		<span style="font-weight:bold">main_incld.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_main_view.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>

		<hr>

		<h3 id="codeIgniterController"><strong>C) CodeIgniter Controller Structure</strong> - <a href="#toc">top</a></h3>

		<p>We created the contoller with standarization and the code adheres to PSR standards. Every contoller user our method standarization, there are "index", "gridview", "generateId", "form", "save", "view" and "delete". Here is the explanation</p>

		<ol>	
			<li><strong>index.</strong> in this method you should provide the data for the main page.</li>	
			<li><strong>gridview.</strong> to show into the table, you should retrieve data from database and declare it in this method.</li>	
			<li><strong>generateId.</strong> this method is a function to generate id or unique id.</li>	
			<li><strong>form.</strong> to show data and form that you can insert and update.</li>	
			<li><strong>save.</strong> this method will save the data to the database.</li>	
			<li><strong>view.</strong> to show data.</li>	
			<li><strong>delete.</strong> this method will delete the data.</li>	
		</ol> 
		
		<span style="font-weight:bold">class.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_contoller.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>

		<hr>
		
		<h3 id="codeIgniterModel"><strong>A) CodeIgniter Model Structure</strong> - <a href="#toc">top</a></h3>
		
		<p>This model use five methods, there are "getByQuery", "insert", "insertRet", "update" and  "delete". Here is the explanation</p>
		
		<ol>
			<li><strong>getByQuery.</strong> to select the data.</li>
			<li><strong>insert.</strong> to insert the data.</li>
			<li><strong>insertRet.</strong> to insert the data and return the id.</li>
			<li><strong>update.</strong> to update the data.</li>
			<li><strong>delete.</strong> to delete the data.</li>
		</ol>
		
		<span style="font-weight:bold">Dataaccess_mdl.php</span><br>
		<img src="<?= base_url("assets/doc") ?>/images/hrm_model.png" alt="CodeIgniter View Structure" style="width:789px" /><br><br><br>
		
		<hr>
		
		<h3 id="sourceAndCredits"><strong>E) Sources and Credits</strong> - <a href="#toc">top</a></h3>
		
		<p>I've used the following framework and theme as listed.
		
		<ul>
			<li>Codeigniter Framework from EllisLab</li>
			<li>AdminLTE Theme from Almsaeed Studio</li>
			<li>Highcharts Javascript from Highcharts</li>
		</ul>
		
		<hr>
		
		<p>Once again, thank you so much for purchasing this application. As I said at the beginning, I'd be glad to help you if you have any questions relating to this application. No guarantees, but I'll do my best to assist. If you have a more general question relating to the themes on CodeCanyon, you might consider visiting the forums and asking your question in the "Item Discussion" section.</p> 
		
		<p class="append-bottom alt large"><strong>CiptaWeb</strong></p>
		<p><a href="#toc">Go To Table of Contents</a></p>
		
		<hr class="space">
	</div><!-- end div .container -->
</body>
</html>