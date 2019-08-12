<?php
/**
 * Created by PhpStorm.
 * User: reynier.delarosa
 * Date: 30/04/2018
 * Time: 13:06
 */

namespace ImdbScraper\Helper;


class Cleaner
{
    public static function clearText(string $value): string
    {
        return str_replace("> ", ">",
            str_replace(" <", "<",
                str_replace("> <", "><",
                    preg_replace('/\s+/', ' ',
                        str_replace(["\r\n", "\n\r", "\n", "\r"], "", html_entity_decode($value))
                    )
                )
            )
        );
    }
}