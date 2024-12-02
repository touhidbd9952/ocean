<!DOCTYPE html>
<html>
  <head>
   <base href="<?php echo base_url();?>">
	<title> My | Reset Configuration</title>
	<meta name="author" content="My Network">
	<meta name="copyright" content="Copyright &copy; 2009" />
	<meta name="rating" content="general" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
	<div id="wrap">

	<div class="container">
    
		<div>

<?php $query=$this->db->query("Select * from t_admin  WHERE id='1'");
	if ($query->num_rows()==1){
	$sAdmin=$query->row();
	} ?>
			  <form action="<?php echo '_reSet_01840176665/settings'?>" method="post"  style="width:300px;background:#fff;padding:0px;">
			   <h4 style="margin-top:30px;color:blue">Simple Way Admin Settings:</h4>
			    <div class="form-group">
				<label class="control-label" for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control input-sm" value="<?php echo $sAdmin->username ?>">
			  </div>
			  <div class="form-group">
				<label class="control-label" for="password">Password</label>
				<input type="text" name="password" id="password" class="form-control input-sm" value="<?php echo $newpass?>">
			  </div>
			 
			  
			 <div class="form-group">
			 <label for="inputpin">Verification Key</label>
			<input type="password" class="form-control input-sm" id="inputpin" name="inputpin" placeholder="Enter a verification key to continue" style="width:300px;"><br/>
			 </div>
			  <input type="submit" class="btn btn-primary btn-sm"  value="Submit">
			  
			</form>
		</div>
        
        
        
	<div id="footer" style="margin-top:30px;">
	<p>Powered By Simple Way Networks</p>
	</div>
    
    
	</div>

	</div><!--/end Wrap-->

  </body>
</html>