<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * Script for receiving, validating and sending contact form.
 * Use $config variable below to define email address for incoming contact forms.
 */

// -----------------------------------------------------------------------------

// Configuration
$config = array
(
  'email' => 'markshahid@gmail.com' // Email address for incoming contact forms
);

// -----------------------------------------------------------------------------

/**
 * JSON Encode for PHP4
 *
 * @param mixed $data
 * @return string
 */
if ( ! function_exists('json_encode'))
{
  function json_encode($data)
  {
    $json = new Services_JSON();
    return $json->encode($data);
  }
}

// -----------------------------------------------------------------------------

/**
 * Return output
 *
 * @param boolean $result
 * @param string $message
 */
function output($result, $message)
{
  echo json_encode(array('result' => $result, 'message' => $message));
  exit;
}

// -----------------------------------------------------------------------------

// Parsing POST data
foreach (array('author', 'email', 'subject', 'message') as $field)
{
  ${$field} = isset($_POST[$field]) ? trim(strip_tags($_POST[$field])) : '';
}

// Data validation
if (empty($author))
{
  output(FALSE, 'Please enter your name.');
}
else if ( ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/i', $email))
{
  output(FALSE, 'Invalid email address.');
}
else if (strlen($message) < 3)
{
  output(FALSE, 'Please write your comment.');
}

// Data preparing
$subject = '[Stuff - template] '.trim(str_replace(array("\r", "\n"), ' ', $subject));
$message .= "\r\n\r\n---\r\n{$author}\r\n{$email}";

// Send mail
$result = @mail
(
  $config['email'],
  '=?UTF-8?B?'.base64_encode($subject).'?=',
  $message,
  "From: {$author} <{$config['email']}>\r\n".
  "Reply-to: {$email}\r\n".
  "MIME-Version: 1.0\r\n".
  "Content-type: text/plain; charset=UTF-8\r\n"
);
if ($result)
{
  output(TRUE, 'Message sent.');
}
else
{
  output(FALSE, 'Error occured. Message couldn\'t be sent.');
}