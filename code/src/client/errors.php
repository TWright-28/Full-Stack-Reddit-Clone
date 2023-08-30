<?php  if (count($errors) > 0) : 
  echo '<div class="error">';
  	foreach ($errors as $error) :
  	  echo'<p>' . $error . '</p>';
	endforeach; 
  echo '</div>';
endif; ?>