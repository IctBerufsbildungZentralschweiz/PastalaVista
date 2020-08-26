<?php
echo password_hash("admin1234!", PASSWORD_DEFAULT, ['cost' => 15]);
?>