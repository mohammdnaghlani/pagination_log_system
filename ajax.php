<?php
require_once('init.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page_number = intval($_POST['page_num']);
    $view_log = pagination(get_view_log(), $page_number, $total_page);
    $out_put = null ;
    foreach($view_log as $key =>  $val){
        $out_put .= '<tr>' . PHP_EOL ;
        $out_put .= '<th>'.$val['ip'] .'</th>'. PHP_EOL ;
        $out_put .= '<th>'.$val['location'] .'</th>'. PHP_EOL ;
        $out_put .= '<th>'.$val['referer'] .'</th>'. PHP_EOL ;
        $out_put .= '<th>'.$val['date_time'] .'</th>'. PHP_EOL ;
        $out_put .= '<th>'.$val['browser'] .'</th>'. PHP_EOL ;
        $out_put .= '</tr>' . PHP_EOL ;
    }
    echo $out_put ;

}