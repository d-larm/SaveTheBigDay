<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = '../img/vendors/';
echo $_POST["name"];
if(!file_exists($uploaddir)){
    mkdir($uploaddir, 0777, true);
}
$uploadfile = $uploaddir . basename($_FILES['vendorfiles']['name']);
echo "<script>console.log({$_FILES['vendorfiles']['name']})</script>";
echo '<pre>';

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>