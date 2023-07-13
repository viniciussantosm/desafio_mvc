<?php

use App\Model\Session;
?>
<div class="flash-message-container">
    <div class="flash-message <?=Session::getMessage()["type"]?>">
        <p><?php
            echo Session::getMessage()["content"];
            Session::unsetMessage();
        ?></p>
    </div>
</div>