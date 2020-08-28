<?php

function showNavbar($activeSite)
{
    if ($activeSite == "index") {
        echo "
        <div class=\"topnav\">
		  <a class=\"active\" href=\"index.php\">Home</a> <a href=\"login.php\">Anmelden</a>
		  <a href=\"register.php\">Registrieren</a>
        </div>";
    }
    elseif ($activeSite == "login") {
        echo "
        <div class=\"topnav\">
		  <a href=\"index.php\">Home</a> <a class=\"active\" href=\"login.php\">Anmelden</a>
		  <a href=\"register.php\">Registrieren</a>
        </div>";
    }
    elseif ($activeSite == "register") {
        echo "
        <div class=\"topnav\">
		  <a href=\"index.php\">Home</a> <a href=\"login.php\">Anmelden</a>
		  <a class=\"active\" href=\"register.php\">Registrieren</a>
        </div>";
    }
}

?>