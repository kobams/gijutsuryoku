<?php

session_start();
session_regenerate_id(true);

$kenmei = isset($_SESSION['kenmei']) ? $_SESSION['kenmei'] : NULL;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : NULL;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
$tel = isset($_SESSION['tel']) ? $_SESSION['tel'] : NULL;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : NULL;

$error['name'] = isset($_SESSION['error']['name']) ? $_SESSION['error']['name'] : FALSE;
$error['email'] = isset($_SESSION['error']['email']) ? $_SESSION['error']['email'] : FALSE;
$error['tel'] = isset($_SESSION['error']['tel']) ? $_SESSION['error']['tel'] : FALSE;
$error['message'] = isset($_SESSION['error']['message']) ? $_SESSION['error']['message'] : FALSE;

require './header.php';

?>

<h2>お問い合わせ</h2>
<form action="confirm.php" method="post">
    <div>
        <label for="kenmei">件名(必須)</label>
        <div class="selectwrapper">
            <select id="kenmei" name="kenmei">
                <option value="ご意見" <?php if(strcmp($kenmei, 'ご意見') == 0) echo 'selected'; ?>>ご意見</option>
                <option value="ご感想" <?php if(strcmp($kenmei, 'ご感想') == 0) echo 'selected'; ?>>ご感想</option>
                <option value="その他" <?php if(strcmp($kenmei, 'その他') == 0) echo 'selected'; ?>>その他</option>
            </select>
        </div>
    </div>

    <div>
        <label for="name">お名前(必須)</label>
        <?php if($error['name']) echo '<label for="name" class="error">　*入力エラーがあります</label>'; ?>
        <input type="text" id="name" name="name" <?php echo 'value=', $name; ?>>
    </div>

    <div>
        <label for="email">メールアドレス(必須)</label>
        <?php if($error['email']) echo '<label for="email" class="error">　*入力エラーがあります</label>'; ?>
        <input type="email" id="email" name="email" <?php echo 'value=', $email; ?>>
    </div>

    <div>
        <label for="tel">電話番号(数字のみ)(必須)</label>
        <?php if($error['tel']) echo '<label for="tel" class="error">　*入力エラーがあります</label>'; ?>
        <input type="tel" id="tel" name="tel" <?php echo 'value=', $tel; ?>>
    </div>

    <div>
        <label for="message">お問い合わせ内容(300文字以内)(必須)</label>
        <?php if($error['message']) echo '<label for="message" class="error">　*入力エラーがあります</label>'; ?>
        <textarea id="message" name="message"><?php echo $message; ?></textarea>
    </div>

    <input type="submit" value="確認">
</form>

<?php require './footer.php';