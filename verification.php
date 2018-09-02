<?php
include_once("bd.php");

if (isset($_POST['submit'])){
    if(empty($_POST['login']))  {
    echo '<br><font color="red"><img border="0" src="error.gif" alt="������� �����"> ������� �����!</font>';
}
elseif (!preg_match("/^\w{3,}$/", $_POST['login'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="� ���� "�����" ������� ������������ �������!">� ���� "�����" ������� ������������ �������! ������ �����, ����� � �������������!</font>';
}
elseif(empty($_POST['password'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="������� ������ !">������� ������!</font>';
}
elseif (!preg_match("/\A(\w){6,20}\Z/", $_POST['password'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="������ ������� ��������!">������ ������� ��������! ������ ������ ���� �� ����� 6 ��������! </font>';
}
elseif(empty($_POST['password2'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="������� ������������� ������!">������� ������������� ������!</font>';
}
elseif($_POST['password'] != $_POST['password2']) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="��������� ������ �� ���������!">��������� ������ �� ���������!</font>';
}
elseif(empty($_POST['email'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="������� E-mail!">������� E-mail! </font>';
}
elseif (!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $_POST['email'])) {
echo '<br><font color="red"><img border="0" src="error.gif" alt="E-mail ����� ������������ ������!">E-mail ����� ������������ ������! ��������, name@gmail.com! </font>';
}

else{
$login = $_POST['login'];
$password = $_POST['password'];
$mdPassword = md5($password);
$password2 = $_POST['password2'];
$email = $_POST['email'];
$rdate = date("d-m-Y � H:i");
$name = $_POST['name'];
$lastname = $_POST['lastname'];

$query = ("SELECT id FROM users WHERE login='$login'");
$sql = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($sql) > 0) {
echo '<font color="red"><img border="0" src="error.gif" alt="������������ � ����� ������� �����������������!">������������ � ����� ������� ���������������!</font>';
}
else {
$query2 = ("SELECT id FROM users WHERE email='$email'");
$sql = mysql_query($query2) or die(mysql_error());
if (mysql_num_rows($sql) > 0){
echo '<font color="red"><img border="0" src="error.gif"  alt="������������ � ����� e-mail �����������������!">������������ � ����� e-mail ��� ���������������!</font>';
}
else{
$query = "INSERT INTO users (login, password, email, reg_date, name_user, lastname )
VALUES ('$login', '$mdPassword', '$email', '$rdate', '$name', '$lastname')";
$result = mysql_query($query) or die(mysql_error());;
echo '<font color="green"><img border="0" src="ok.gif"  alt="�� ������� ������������������!">�� ������� ������������������!</font><br><a href="index.php">�� �������</a>';
}
}
}
}
?>
