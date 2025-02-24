<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "GROUPS" => [
        "SETTINGS" => [
            "NAME" => "Настройки отображения",
            "SORT" => 100
        ]
    ],
    "PARAMETERS" => [
        "TIME_FORMAT" => [
            "PARENT" => "SETTINGS",
            "NAME" => "Формат времени",
            "TYPE" => "LIST",
            "VALUES" => [
                "H:i:s" => "Часы:Минуты:Секунды (24ч)",
                "h:i:s A" => "Часы:Минуты:Секунды (12ч с AM/PM)",
                "H:i" => "Часы:Минуты (24ч)"
            ],
            "DEFAULT" => "H:i:s",
            "SORT" => 100
        ],
        "UPDATE_INTERVAL" => [
            "PARENT" => "SETTINGS",
            "NAME" => "Интервал обновления (сек)",
            "TYPE" => "NUMBER",
            "DEFAULT" => "1",
            "SORT" => 200
        ]
    ]
];
