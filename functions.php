<?php
function link_url(string $uri): string
{
    $url  = BASE_URL . $uri;
    return $url;
}
function fetch_posts(string $file_path, int $situation_assoc = 0)
{
    $file_read = file_get_contents(BASE_PATH . $file_path);
    $posts = json_decode($file_read,  $situation_assoc);
    return $posts;
}
function add_posts($file_name, array $new_posts): bool
{
    $file_array = json_decode(file_get_contents(BASE_PATH . $file_name), 1);
    $file_array[] = $new_posts;
    $result = file_put_contents(BASE_PATH . $file_name, json_encode($file_array));
    return true;
}

function user_log(){
    $log = $_SERVER['REMOTE_ADDR'] . ' | ' ;
    $log .= $_SERVER['PHP_SELF'] . ' | ' ;
    $log .= isset( $_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'direct-search' ;
    $log .= ' | ' ;
    $log .= date('Y-m-d H:i:s') . ' | ';
    $log .=  get_user_sys_info($_SERVER['HTTP_USER_AGENT']);
    $log .= PHP_EOL ;
    file_put_contents(BASE_PATH . 'db/log.txt' ,$log , FILE_APPEND) ;

}

function get_user_sys_info($value){
    $result = null ;
    if(strpos( $value , 'Edge')){
        $result = 'Edge' ;
    }else if( strpos($value, 'Firefox')){
        $result = 'Firefox';
    }else if( strpos($value, 'Chrome')){
        $result = 'Chrome';
    }else{
        $result = 'unKnown Browser';
    }
    return $result ;
}

function get_view_log()
{

    $read_file = file_get_contents(BASE_PATH . 'db/log.txt');
    $content_to_array = explode(PHP_EOL, $read_file);
    array_pop($content_to_array);
    $temp = null;
    foreach ( $content_to_array as $key => $item) {
        
        list(
            $temp[$key]['ip'],
            $temp[$key]['location'],
            $temp[$key]['referer'],
            $temp[$key]['date_time'],
            $temp[$key]['browser'],
        ) = explode('|', $item);
    }
    return $temp ;
}

function pagination($items , $page , &$total_page)
{
    $count_items = count($items) ;
    $total_page = ceil( $count_items /  VIEW_PER_PAGE) ;
    $total_item = ( $page - 1) * VIEW_PER_PAGE ;
    $view  = array_splice( $items , $total_item  ,  VIEW_PER_PAGE) ;
    return $view ;
}