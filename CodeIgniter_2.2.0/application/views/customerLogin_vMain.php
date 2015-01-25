<?php
echo'
		<div id="loginFormDiv" name="loginFormDiv" class="formdiv" style="width:80%;background:#ffffff;margin:0 auto;">	
				<form id="loginForm" action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerLogin_c" method="post" style="padding-left:10%;padding-top:2.5%;padding-bottom:2.5%">
				<label>Username: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="text" id="username" name="username" class="tb"><br/><br/>
				<label>Password: <span style="font-family:Calibri ,serif; color: red">*</span></label><input type="password" id="password" name="password" class="tb"><br/><br/>
				<input type="submit" class="button" style="align:center; display: block; margin: 0 auto;">
			</form>
		</div>
	</body>	
</html>';

?>