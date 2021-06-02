<?php
// 変更①  クライアントのメールアドレスを入力
$to = 'genius2taketo@gmail.com';

if($_POST) {
  // 変更②  下記以外に入力要素がある場合は追加（また、不要なものは削除）
  $name = trim(stripslashes($_POST['name']));
  $email = trim(stripslashes($_POST['email']));
  $title = trim(stripslashes($_POST['subject']));
  $contact_message = trim(stripslashes($_POST['message']));
  $kinds = trim(stripslashes($_POST['kinds']));
  
  // 変更③  タイトルを状況に応じて変える
  $subject = "TakeChopiaからお問い合わせがありました";
 
  // 変更②  下記以外に入力要素がある場合は追加（また、不要なものは削除）
  // Set Message
  $message .= "お名前: " . $name . "<br />";
  $message .= "メールアドレス: " . $email . "<br />";
  $message .= "お問い合わせの種類: " . $kinds . "<br />";
  $message .= "タイトル: " . $title. "<br />";
  $message .= "メッセージ: <br />";
  $message .= nl2br($contact_message);
  
  // Set From: header
  $from =  "" . " <" . $email . ">";
  
  // Email Headers
  $headers = "From: " . $from . "\r\n";
  $headers .= "Reply-To: ". $email . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-2022-JP\r\n";
  
  ini_set("sendmail_from", $to); // for windows server
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  $mail = mb_send_mail($to, $subject, $message, $headers);
  
  if ($mail) { echo "OK"; }
  else { echo "ご記入内容に不備がございます。もう一度やり直してください。"; }
  
  header('Location: /');
  exit;
}

?>
