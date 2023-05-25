<?php
$image_width = 120;
$image_height = 40;
$characters_on_image = 6;
$font = './monofont.ttf';
//The characters that can be used in the CAPTCHA code.
//avoid confusing characters (l 1 and i for example)
$possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
$random_dots = 0;
$random_lines = 20;
$captcha_text_color="0x142864";
$captcha_noise_color = "0x142864";

if(isset($_POST['submit']))
{
  if(empty($_SESSION['6_letters_code'] ) ||
    strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
  {
      //Note: the captcha code is compared case insensitively.
      //if you want case sensitive match, update the check above to
      // strcmp()
    $errors .= "
 The captcha code does not match!";
  }
  if(empty($errors))
  {
    //send the email
    $to = $your_email;
    $subject="New form submission";
    $from = $your_email;
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    $body = "A user  $name submitted the contact form:
".
    "Name: $name
".
    "Email: $visitor_email 
".
    "Message: 
 ".
    "$user_message
".
    "IP: $ip
";
    $headers = "From: $from 
";
    $headers .= "Reply-To: $visitor_email 
";
    mail($to, $subject, $body,$headers);
    header('Location: thank-you.html');
  }
}
?>