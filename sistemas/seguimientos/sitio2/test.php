<?php 

$uploaddir = "/";  //set this to where your files should be uploaded.  Make sure to chmod to 777. 

if ($_FILES['file']) { 

    $command = ""; 
     
    foreach($_FILES['file']['type'] as $key => $value) { 
     
    $ispdf = end(explode(".",$_FILES['file']['name'][$key]));  //make sure it's a PDF file     
    $ispdf = strtolower($ispdf); 

        if ($value && $ispdf=='pdf') { 
            //upload each file to the server 
            $filename = $_FILES['file']['name'][$key]; 
            $filename = str_replace(" ","",$filename); //remove spaces from file name 
            $uploadfile = $uploaddir . $filename; 
            move_uploaded_file($_FILES['file']['tmp_name'][$key], $uploadfile); 
            // 
             
            //build an array for the command being sent to output the merged PDF using pdftk 
            $command = $command." files/".$filename; 
            // 
        } 

    } 
    $command = base64_encode($command); //encode and then decode the command string 
    $command = base64_decode($command); 

    $output = "merged-pdf".time().".pdf"; //set name of output file 
    $command = "pdftk $command output $output"; 

    passthru($command); //run the command 

    header(sprintf('Location: %s', $output)); //open the merged pdf file in the browser 

} 


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Merge Multiple PDF Files Using PHP and pdftk</title> 
<style type="text/css"> 
<!-- 
body { 
    font-family: Georgia, "Times New Roman", Times, serif; 
    font-size: 12px; 
    color: #333333; 
    width: 500px; 
    margin: 50px auto 0px auto; 
} 
.style1 {font-size: 24px} 
--> 
</style> 
</head> 

<body> 
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  <span class="style1">Merge Multiple PDF Files Using PHP </span><br /> 
  <br /> 
  Upload your PDF files below: <br /> 
  <br /> 
  <input name="file[]" type="file" id="file[]" /> 
  <br /> 
  <input name="file[]" type="file" id="file[]" /> 
  <br /> 
  <input name="file[]" type="file" id="file[]" /> 
  <br /> 
  <input name="file[]" type="file" id="file[]" /> 
  <br /> 
  <br /> 
  <input type="submit" name="Submit" value="Merge!" /> 
  <br /> 
  <br /> 
  <a href="http://www.johnboy.com/about-us/news/merge-multiple-pdf-files-with-php">Back to article  
  </a> 
</form> 
</body> 
</html> 