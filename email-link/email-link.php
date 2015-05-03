<?php
/**
 * Plugin Name: Email Link
 * Plugin URI: http://www.charasan.com/
 * Description: Creates a more secure method of adding email links in a page
 * Version: 1.0
 * Author: Edward Fuller
 * Author URI: http://www.charasan.com/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class email_link {
	public function __construct() {
		add_shortcode( 'email-link', array( $this, 'addEmailLink' ) );
	}

  /**
   * You can add your id and class to the shortcode just like an HTML element,
   * this will pick up on them and use them in the created link
   * This shortcode is used in the following manner:
   * [email-link id="my-email" class="my-email" text="This is the text that becomes a link"]xyz@email.com[/email-link]
   */
  public function addEmailLink($atts, $content = null) {
    $ret = '';
    $attr = array();
    if(empty($content)) return $ret;
    $text = $content;

    foreach($atts as $key => $val)
    {
      if($key == 'text')
        $text = $atts['text'];
      else
        $attr[$key] = $val;
    }

    return self::encodeEmail($content, $text, $attr);
  }

  /**
   * This encodes and places an email in text, so as to protect it from spam bots and spiders
   * @param string $email
   * @param string $linkText
   * @param array $attr - pass id and/or class to the function
   * @return string
   **/
  private function encodeEmail($email = '', $linkText = '', $attr = array())
  {
    $email = str_replace('@', '&#64;', $email);
    $email = str_replace('.', '&#46;', $email);
    $email = str_split($email, 5);

    $linkText = str_replace('@', '&#64;', $linkText);
    $linkText = str_replace('.', '&#46;', $linkText);
    $linkText = str_split($linkText, 5);

    $part1 = '<a href="ma';
    $part2 = 'ilto&#58;';
    $part3 = '';

    foreach($attr as $key => $val)
    {
      if(empty($part3)) $part3 .= '"';
      
      $part3 .= ' '.$key.'="'. $val .'"';
    }
    $part3 .= " >";
    $part4 = '</a>';

    $encoded = '<script>'."\n";
    $encoded .= "document.write('$part1');";
    $encoded .= "document.write('$part2');";
    foreach($email as $e)
    {
        $encoded .= "document.write('$e');";
    }
    $encoded .= "document.write('$part3');";
    foreach($linkText as $l)
    {
        $encoded .= "document.write('$l');";
    }
    $encoded .= "document.write('$part4');";
    $encoded .= "\n".'</script>';

    return $encoded;
  }

}

$email_link = new email_link();
