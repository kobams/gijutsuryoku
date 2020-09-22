<?php

session_start();
session_regenerate_id(true);

$kenmei = $_SESSION['kenmei'] = $_REQUEST['kenmei'];
$name = $_SESSION['name'] = $_REQUEST['name'];
$email = $_SESSION['email'] = $_REQUEST['email'];
$tel = $_SESSION['tel'] = $_REQUEST['tel'];
$message = $_SESSION['message'] = $_REQUEST['message'];

$error['name'] = ((strlen($name) > 0) && is_string($name)) ? FALSE : TRUE;
$error['email'] = preg_match('/^.+@.+$/', $email) ? FALSE : TRUE;
$error['tel'] = is_numeric($tel) ? FALSE : TRUE;
$error['message'] = ((strlen($message) > 0) && is_string($message)) ? FALSE : TRUE;

$_SESSION['error'] = $error;

$check = TRUE;
foreach($error as $key => $value) {
    if($value) $check = FALSE;
}

if(!$check) {
    $dirname = dirname( $_SERVER[ 'SCRIPT_NAME' ] );
    $dirname = $dirname == DIRECTORY_SEPARATOR ? '' : $dirname;
    $url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . $dirname . '/index.php';
    header( 'HTTP/1.1 303 See Other' );
    header( 'location: ' . $url );
    exit();
}

require './header.php';

?>

<h2>ご入力内容確認</h2>
<table>
    <tr>
        <th>件名</th>
        <td><?php echo $kenmei; ?></td>
    </tr>

    <tr>
        <th>お名前</th>
        <td><?php echo $name; ?></td>
    </tr>

    <tr>
        <th>メールアドレス</th>
        <td><?php echo $email; ?></td>
    </tr>

    <tr>
        <th>電話番号</th>
        <td><?php echo $tel; ?></td>
    </tr>

    <tr>
        <th>お問い合わせ内容</th>
        <td><?php echo $message; ?></td>
    </tr>

</table>

<form action="form.php" method="post">
    <input type="submit" value="修正">
</form>

<form action="complete.php" method="post">
    <input type="submit" value="送信">
</form>

<?php require './footer.php';