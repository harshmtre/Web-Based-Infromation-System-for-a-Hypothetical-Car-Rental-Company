<?php
echo'
		<div id="loginFormDiv" name="loginFormDiv" class="formdiv" style="width:90%; background-color: rgba(255, 255, 255, 0);margin:0 auto;">	
				<form id="loginForm" action="http://cs-server.usc.edu:9046/CSCI571HW/CodeIgniter_2.2.0/index.php/customerLogin_c" method="post" style="padding-top:2.5%;padding-bottom:2.5%">
				<span style="font-family:Calibri ,serif; font-size=0.6in">Username: <span style="font-family:Calibri ,serif; color: red">*</span><input type="text" id="username" name="username" class="tb">
				<span style="font-family:Calibri ,serif; font-size=0.6in">Password: <span style="font-family:Calibri ,serif; color: red">*</span></span><input type="password" id="password" name="password" class="tb"><br/>
				<input type="submit" data-theme="b" value="Login">
			</form>
		</div>
	</body>	
</html>';

?>