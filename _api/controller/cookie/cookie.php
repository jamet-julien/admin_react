<?php

$iTimeExpire = time()+60*60*24*30;// 30 jours
setcookie("accepted", "accepted", $iTimeExpire);