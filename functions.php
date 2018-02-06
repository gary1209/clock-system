<?php

function get_ipaddress() {

    if (empty($REMOTE_ADDR)) {
        if (!empty($_SERVER) && isset($_SERVER['REMOTE_ADDR'])) {
            $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
        }
        else if (!empty($_ENV) && isset($_ENV['REMOTE_ADDR'])) {
            $REMOTE_ADDR = $_ENV['REMOTE_ADDR'];
        }
        else if (@getenv('REMOTE_ADDR')) {
            $REMOTE_ADDR = getenv('REMOTE_ADDR');
        }
    }
    if (empty($HTTP_X_FORWARDED_FOR)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED_FOR'])) {
            $HTTP_X_FORWARDED_FOR = $_ENV['HTTP_X_FORWARDED_FOR'];
        }
        else if (@getenv('HTTP_X_FORWARDED_FOR')) {
            $HTTP_X_FORWARDED_FOR = getenv('HTTP_X_FORWARDED_FOR');
        }
    }
    if (empty($HTTP_X_FORWARDED)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED'])) {
            $HTTP_X_FORWARDED = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED'])) {
            $HTTP_X_FORWARDED = $_ENV['HTTP_X_FORWARDED'];
        }
        else if (@getenv('HTTP_X_FORWARDED')) {
            $HTTP_X_FORWARDED = getenv('HTTP_X_FORWARDED');
        }
    }
    if (empty($HTTP_FORWARDED_FOR)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $HTTP_FORWARDED_FOR = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED_FOR'])) {
            $HTTP_FORWARDED_FOR = $_ENV['HTTP_FORWARDED_FOR'];
        }
        else if (@getenv('HTTP_FORWARDED_FOR')) {
            $HTTP_FORWARDED_FOR = getenv('HTTP_FORWARDED_FOR');
        }
    }
    if (empty($HTTP_FORWARDED)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED'])) {
            $HTTP_FORWARDED = $_SERVER['HTTP_FORWARDED'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED'])) {
            $HTTP_FORWARDED = $_ENV['HTTP_FORWARDED'];
        }
        else if (@getenv('HTTP_FORWARDED')) {
            $HTTP_FORWARDED = getenv('HTTP_FORWARDED');
        }
    }
    if (empty($HTTP_VIA)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_VIA'])) {
            $HTTP_VIA = $_SERVER['HTTP_VIA'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_VIA'])) {
            $HTTP_VIA = $_ENV['HTTP_VIA'];
        }
        else if (@getenv('HTTP_VIA')) {
            $HTTP_VIA = getenv('HTTP_VIA');
        }
    }
    if (empty($HTTP_X_COMING_FROM)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_COMING_FROM'])) {
            $HTTP_X_COMING_FROM = $_SERVER['HTTP_X_COMING_FROM'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_X_COMING_FROM'])) {
            $HTTP_X_COMING_FROM = $_ENV['HTTP_X_COMING_FROM'];
        }
        else if (@getenv('HTTP_X_COMING_FROM')) {
            $HTTP_X_COMING_FROM = getenv('HTTP_X_COMING_FROM');
        }
    }
    if (empty($HTTP_COMING_FROM)) {
        if (!empty($_SERVER) && isset($_SERVER['HTTP_COMING_FROM'])) {
            $HTTP_COMING_FROM = $_SERVER['HTTP_COMING_FROM'];
        }
        else if (!empty($_ENV) && isset($_ENV['HTTP_COMING_FROM'])) {
            $HTTP_COMING_FROM = $_ENV['HTTP_COMING_FROM'];
        }
        else if (@getenv('HTTP_COMING_FROM')) {
            $HTTP_COMING_FROM = getenv('HTTP_COMING_FROM');
        }
    }

    // Gets the default ip sent by the user //

    if (!empty($REMOTE_ADDR)) {
        $direct_ip = $REMOTE_ADDR;
    }

    // Gets the proxy ip sent by the user //

    $proxy_ip     = '';
    if (!empty($HTTP_X_FORWARDED_FOR)) {
        $proxy_ip = $HTTP_X_FORWARDED_FOR;
    } else if (!empty($HTTP_X_FORWARDED)) {
        $proxy_ip = $HTTP_X_FORWARDED;
    } else if (!empty($HTTP_FORWARDED_FOR)) {
        $proxy_ip = $HTTP_FORWARDED_FOR;
    } else if (!empty($HTTP_FORWARDED)) {
        $proxy_ip = $HTTP_FORWARDED;
    } else if (!empty($HTTP_VIA)) {
        $proxy_ip = $HTTP_VIA;
    } else if (!empty($HTTP_X_COMING_FROM)) {
        $proxy_ip = $HTTP_X_COMING_FROM;
    } else if (!empty($HTTP_COMING_FROM)) {
        $proxy_ip = $HTTP_COMING_FROM;
    }

    // Returns the true IP if it has been found, else FALSE //

    if (empty($proxy_ip)) {
        // True IP without proxy
        return $direct_ip;
    } else {
        $is_ip = preg_match('|^([0-9]{1,3}\.){3,3}[0-9]{1,3}|', $proxy_ip, $regs);
        if ($is_ip && (count($regs) > 0)) {
            // True IP behind a proxy
            return $regs[0];
        } else {
            // Can't define IP: there is a proxy but we don't have
            // information about the true IP
            return FALSE;
        }
    }
}

?>