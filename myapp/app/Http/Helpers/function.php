<?php 
function getPaymentType() {
    $bank = sprintf('Bank Deposit (&#x20A6;)');
    return array(
        'bank' => html_entity_decode($bank),
        'bitcoin' => 'Bitcoin Payment ($)',
    );
}
function getExcerpt($str, $maxLength=100) {
    //filter of images
    $str = strip_tags($str,"<b><i><a><br><p></p><img>");

    if(strlen($str) > $maxLength) {
        $excerpt   = substr($str, 0, $maxLength-3);
        $lastSpace = strrpos($excerpt, ' ');
        $excerpt   = substr($excerpt, 0, $lastSpace);
        $excerpt  .= '...';
    } else {
        $excerpt = $str;
    }
    
    return $excerpt;

}
function sortDateFunction($a, $b) {
    $res = (strtotime($a['date']) < strtotime($b['date'])) ? 1 : -1;
    return $res;
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}
function get_ip_address() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                // trim for safety measures
                $ip = trim($ip);
                // attempt to validate IP
                if (validate_ip($ip)) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

?>