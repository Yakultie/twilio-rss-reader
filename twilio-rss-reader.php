<?php
/********************************/

  // CONFIGURATION
  
  // RSS feed url
  $feed = "http://feeds.bbci.co.uk/news/rss.xml?edition=uk";
  
  // Voice options (docs: https://www.twilio.com/docs/api/twiml/say#attributes-voice)
  $voice = "Alice";
  $language = "en-gb";

  // Messages
  $greeting = "Welcome to Bernard's personal news hotline. Here is the latest news from BBC. ";
  $no_choice_made = "Sorry, I didn't get that. ";
    
  // The URL of this script
  $url = 'http://' . dirname($_SERVER["SERVER_NAME"] .  $_SERVER['PHP_SELF']) . '/' . basename(__FILE__);

/********************************/
  
  $rss = simplexml_load_string(file_get_contents($feed));
  
  $say_params = 'voice="' . $voice . '" language="' . $language . '"';
  
  // Set up XML output
  header('Content-Type: text/xml');
  echo '<?xml version="1.0" encoding="UTF-8" ?>';
  
?>

<Response>
  <?php
  
  if( isset($_GET['Digits']) ) {
    // If a key was pressed, read a story
  	$story = $_GET['Digits'];
  	echo '<Say ' . $say_params . '>'; 
  	echo html_entity_decode( strip_tags( $rss->channel->item[intVal($story-1)]->description ) );
  	echo "</Say>\n";
  } else {
    // Otherwise, read a greeting    
    echo '<Say ' . $say_params . '>' . $greeting . "</Say>\n";
  }
  
  // Create a menu item for each article
  echo '<Gather action="' . $url . '" method="GET" numDigits="1">' . "\n";
    $i = 1;
    foreach($rss->channel->item as $item) { 
      echo '<Say ' . $say_params . '>Press "' . $i .'" for ' . $item->title . "</Say>\n";
      $i++;
      if($i > 9) break;
    }
  echo "</Gather>\n";
  
  // If no key pressed, loop back around
  echo '<Say ' . $say_params . '>' . $no_choice_made . "</Say>\n";
  echo '<Redirect>' . $url . '</Redirect>';
  
  ?>	
</Response>
