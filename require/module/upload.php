<?PHP
//file uploader and directory maker 
function UPLOAD_FILES($dir, $checkfile = false, $pre, $ref, $NewFile, array $allowedfiles = null)
{

 $pre = str_replace(" ", "_", $pre);
 $ref = str_replace(" ", "_", $ref);

 //check if directory exists
 if ($checkfile == true) {
  if (file_exists("$dir/$checkfile")) {
   unlink("$dir/$checkfile");
  }
 }

 //check if directory exists
 if (!file_exists("$dir/")) {
  mkdir("$dir/", 0777, true);
 }

 //files allowed by default
 $Folder = "$dir/";
 $temp = explode(".", $_FILES["$NewFile"]["name"]);
 $Uploadedfile = $_FILES["$NewFile"]["name"];
 $UploadFileType = pathinfo($Uploadedfile, PATHINFO_EXTENSION);

 //check files allowed for upload
 if ($allowedfiles == null) {

  //files allowed by default
  $allowedfiles = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar', 'gz', 'tar', '7z');

  //check files allowed for upload
  if (!in_array($UploadFileType, $allowedfiles)) {
   return false;

   //files allowed by default
  } else {
   $newfilename = "$pre" . "_" . $ref . "_" . date("d_M_Y_h_m_s_") . rand(0, 99999999999) . '_' . '.' . end($temp);
   move_uploaded_file($_FILES["$NewFile"]['tmp_name'], $Folder . $newfilename);
   return $newfilename;
  }

  //files allowed by user
 } else {

  //check files allowed for upload
  if (!in_array($UploadFileType, $allowedfiles)) {
   return false;

   //files allowed by default
  } else {
   $newfilename = "$pre" . "_" . $ref . "_" . date("d_M_Y_h_m_s_") . rand(0, 99999999999) . '_' . '.' . end($temp);
   move_uploaded_file($_FILES["$NewFile"]['tmp_name'], $Folder . $newfilename);
   return $newfilename;
  }
 }
}

//upload multiple files
function UPLOAD_MULTIPLE_FILES($path, $prename, $refname, $postfilename)
{
 for ($i = 0; $i < count($_FILES["$postfilename"]['name']); $i++) {

  $pre = $prename;
  $ref = $refname;
  $path = $path;
  $ext = explode('.', basename($_FILES["$postfilename"]['name'][$i]));
  $path = $path .  md5(uniqid()) . "." . $ext[count($ext) - 1];
  $temp = explode(".", $_FILES["$postfilename"]['tmp_name'][$i]);
  $newfilename = "$pre" . "_" . $ref . "_" . date("d_M_Y_h_m_s_") . rand(0, 99999999999) . '_' . '.' . end($temp);
  $filestatus = move_uploaded_file($_FILES["$postfilename"]['tmp_name'][$i], $path);

  if ($filestatus == true) {
   die($newfilename);
   return $newfilename;
  } else {
   return false;
  }
 }
}
