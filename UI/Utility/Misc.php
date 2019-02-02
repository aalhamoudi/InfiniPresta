<?php

function FieldValue(string $field) {
    return Tools::getValue($field, Configuration::get($field));
}