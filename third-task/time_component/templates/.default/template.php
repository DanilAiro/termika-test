<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->addExternalCss($this->GetFolder() . "/templates/.default/style.css");
$this->addExternalJs($this->GetFolder() . "/templates/.default/script.js");
?>
<div class="current-time" 
     data-interval="<?=htmlspecialcharsbx($arResult["UPDATE_INTERVAL"])?>" 
     data-format="<?=htmlspecialcharsbx($arResult["TIME_FORMAT"])?>">
    <span class="time-display"><?=htmlspecialcharsbx($arResult["CURRENT_TIME"])?></span>
</div>
