<?php

function makeLabel($column){
    return ucwords(str_replace('_', ' ', $column));
}
