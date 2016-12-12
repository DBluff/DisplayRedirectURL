<?php

$soCol = drupal_get_path_alias($path = NULL);
$result = db_query("SELECT redirect.redirect, url_alias.source as node, redirect.source as vanity, url_alias.alias FROM redirect INNER JOIN url_alias ON redirect.redirect=url_alias.source WHERE url_alias.alias='$soCol'");

$record = $result->fetchAll();

if($record[0]->vanity != '' && preg_match_all('/([\/])/', $record[0]->vanity)<2 && preg_match_all('/([\-])/', $record[0]->vanity)<2) {
    print '<div class="VanURL"><strong>' . 'Vanity URL: </strong>' . '<a href="http://austincc.edu/' . ($record[0]->vanity) . '">' . 'austincc.edu/';
    print_r($record[0]->vanity);
    print '</a></div>';
}