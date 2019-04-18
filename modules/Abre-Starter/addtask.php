<?

session_start();

$newtask = $_POST['newtask'];

echo $newtask;

header('location:home.php');
?>