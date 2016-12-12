<?php

//Call Current Page - get_permalink()
$soCol = get_permalink();

//Query Foreign Database
$mydb = new wpdb('root','root','sitecopy','localhost');

//Get Requisite Information
$row = $mydb->get_results("SELECT redirect.redirect, url_alias.source as node, redirect.source as vanity, url_alias.alias FROM redirect INNER JOIN url_alias ON redirect.redirect=url_alias.source WHERE url_alias.alias='$soCol'");
//Filter to Vanity URL
$vanURL = array_map(create_function('$o', 'return $o->vanity;'), $row);

//Filter Out Bad Vanity URLS (computer generated)
if($vanURL[0] != '' && preg_match_all('/([\/])/', $vanURL[0])<2 && preg_match_all('/([\-])/', $vanURL[0])<2) {
    print '<div class="VanURL"><strong>' . 'Vanity URL: </strong>' . '<a href="http://austincc.edu/' . $vanURL[0] . '">' . 'austincc.edu/';
    echo($vanURL[0]);
    print '</a></div>';
}

?>