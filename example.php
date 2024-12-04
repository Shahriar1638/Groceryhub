
<?php
// Generate a unique transition ID
$transitionID = bin2hex(random_bytes(10));

// Display the generated transition ID
echo $transitionID;
?>
