<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();

class CurrentTimeComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult["TIME_FORMAT"] = $this->arParams["TIME_FORMAT"] ?: "H:i:s";
        $this->arResult["UPDATE_INTERVAL"] = (int)$this->arParams["UPDATE_INTERVAL"] ?: 1;
        $this->arResult["CURRENT_TIME"] = date($this->arResult["TIME_FORMAT"]);
        
        $this->includeComponentTemplate();
    }
}

if (method_exists($this, "executeComponent")) {
    $this->executeComponent();
}
