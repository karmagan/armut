<?php
include('connect.php');

$phone = $_POST['phone'];
$message = "[Al-Azhar]" . stripslashes($_POST['smstext']);
$subject = "ala6:service::$myemail";

foreach ($phone as $to2) {
    $recipients = $recipients . "{" . $to2 . '}';
    $to = str_replace(" ", "", $to2) . "@sms.axxess.co.za";
    mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null);
}
echo $recipients;
$sql = "insert into sms (Teacher, Message, Date, Recipients) values ('$teacher', '$message', NOW(), '$recipients')";
mysql_query($sql);
echo '<h2>The following SMS sent successfully </h2>';

echo "SMS will be replied to:$myemail<br>message:$message";

?>
<br /><button onclick="opener.show('smsEnter','mainBody');self.close()">Go Back</button>