<?php
// Isticmaalka shaqada updateUsername
require_once 'function.php'; // Waxaa la hubiyaa in koodhkan loo yeero

$oldUsername = "username_old";
$newUsername = "username_new";

// Iskuday inaad cusboonaysiiso username-ka
if  (updatePasswordAndUsername($conn, $username, $hashed_password)) {
    echo "Username-ka waa la cusbooneysiiyay!";
} else {
    echo "Cusboonaysiinta username-ka waa ay fashilantay.";
}
?>
