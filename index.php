<?php
session_start();
include_once 'dbconnect.php';





?>
<!DOCTYPE html>
<html>
<head>
	<title>Početna | Sistem za upravljanje fajlovima</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Sistem za upravljanje fajlovima</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Prijavljen kao <?php echo $_SESSION['usr_name']; ?></p></li>
				<li><a href="logout.php">Odjavi se</a></li>
				<?php } else { ?>
				<li><a href="login.php">Uloguj se</a></li>
				<li><a href="register.php">Napravi nalog</a></li>
				<?php } ?>
			</ul>
                    
                    
                    
		</div>
	</div>
</nav>
    
   
    <?php if (isset($_SESSION['usr_id'])) { ?>
    <div class="panel panel-default">
  <div class="panel-heading">Izaberite fajl</div>
  <div class="panel-body">
    <form action="" method="post" enctype="multipart/form-data">
						  
						  <input type="file" name="file">
						  <input type="submit" value="upload">
						  
						  
						  
						  </form>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Snimljeni fajlovi</h3>
  </div>
  <div class="panel-body">
      
      
       <?php
       
 $curdir= getcwd();
         
 $imeFoldera=$_SESSION['usr_name'];
 $GLOBALS['a'] = $imeFoldera;

if(mkdir($curdir."/$imeFoldera",077)){
    echo 'folder kreiran';
}  else {
    echo 'folder nije kreiran';
}
       
       
        
	if(isset($_FILES['file'])){
		$file=$_FILES['file'];
		
                
                //svojstva fajla
                
                $file_name=$file['name'];
                $file_tmp=$file['tmp_name'];
                $file_size=$file['size'];
                $file_error = $file['error'];
                $imeKorisnikovogFoldera =  $GLOBALS['a'];
                //ekstenzije fajla
                
                $file_ext=explode('.',$file_name);
                
                $file_ext = strtolower(end($file_ext));
                
                $allowed = array('txt','jpg');
                
                if(in_array($file_ext, $allowed)){
                    if($file_error==0){
                            if($file_size <= 2097152){
                                
                                $file_name_new= uniqid('',true). '.' .$file_ext;
                                $file_destination = "$imeKorisnikovogFoldera/" .$file_name_new;
                                
                                if(move_uploaded_file($file_tmp,$file_destination )){
                                    echo $file_destination;
                                }
                            }
                    }
                    
                }
                
        }
	

        
        
        
        ?>
      
      
      
      
      
    
   
    
      
      
      
  </div>
</div>
   
  <?php } else { ?>
    
    <h1>Pocetna stranica</h1>
    
    
    <?php } ?>
    
  

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

