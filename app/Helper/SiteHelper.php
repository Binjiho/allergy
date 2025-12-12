<?php

// check Url
if (!function_exists('checkUrl')) {
    function checkUrl(): string
    {
        $uri = str_replace('://www.', '://', request()->getUri());

        if (strpos($uri, config('site.app.api.url')) !== false) {
            return 'api';
        }

        if (strpos($uri, config('site.app.admin.url')) !== false) {
            return 'admin';
        }

        if (strpos($uri, config('site.app.eng.url')) !== false) {
            return 'eng';
        }

        return 'web';
    }
}

// global auth
if (!function_exists('thisAuth')) {
    function thisAuth()
    {
        if (checkUrl() == 'admin') {
            return auth('admin');
        }

        return auth('web');
    }
}

// get App Name
if (!function_exists('getAppName')) {
    function getAppName(): string
    {
        return config('site.app.' . checkUrl() . '.app_name');
    }
}

// get default url
if (!function_exists('getDefaultUrl')) {
    function getDefaultUrl($auth = false): string
    {
        if ($auth) {
            if (checkUrl() == 'admin') {
                return thisAuth()->check()
                    ? getDefaultUrl()
                    : env('APP_URL') . '/auth/login';
            }

            return thisAuth()->check()
                ? getDefaultUrl()
                : route('login');
        }

        return route('main');
    }
}

// thisLevel
if (!function_exists('thisLevel')) {
    function thisLevel(): string
    {
        return thisUser()->level ?? '';
    }
}

// isAdmin
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return ((thisUser()->is_admin ?? '') === 'Y');
    }
}

if (!function_exists('maskEvenStr')) {
    function maskEvenStr($string)
    {
        $length = mb_strlen($string);
        $maskedId = '';

        for ($i = 0; $i < $length; $i++) {
            // 0-based index이므로 1-based 기준 짝수 번째 문자는 $i가 홀수일 때 변경
            if ($i % 2 == 1) {
                $maskedId .= '*';
            } else {
                $maskedId .= mb_substr($string, $i, 1);
            }
        }
        return $maskedId;
    }
}

if (!function_exists('wiseuConnection')) {
    function wiseuConnection()
    {
        $host = env('DB_HOST_WISEU');
        $port = env('DB_PORT_WISEU', '1433');
        $dbname = env('DB_DATABASE_WISEU');
        $username = env('DB_USERNAME_WISEU');
        $password = env('DB_PASSWORD_WISEU');

        try {
            $conn = new \PDO(
                "dblib:host={$host}:{$port};dbname={$dbname};TrustServerCertificate=True",
                $username,
                $password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::SQLSRV_ATTR_ENCODING => \PDO::SQLSRV_ENCODING_UTF8
                ]
            );

            return $conn;
        } catch (\PDOException $e) {
            // Log or handle the connection error
            throw $e;
        }
    }
}

// 금액 표기
if (!function_exists('priceKo')) {
    function priceKo($price = 0)
    {
        $price = unComma($price);

        if ($price <= 0 || $price >= 1000000000) {
            return $price;
        }

        $numKo  = ['', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구'];
        $unitKo = ['', '십', '백', '천'];
        $manKo  = ['', '만', '억'];

        $result = '';
        $strPrice = str_pad((string)$price, ceil(strlen($price) / 4) * 4, '0', STR_PAD_LEFT);
        $len = strlen($strPrice);
        $blockCount = $len / 4;

        for ($i = 0; $i < $blockCount; $i++) {
            $block = substr($strPrice, $i * 4, 4);
            $blockResult = '';

            for ($j = 0; $j < 4; $j++) {
                $digit = (int)$block[$j];
                if ($digit > 0) {
                    // 1이면 '일십' 대신 '십'
                    if ($digit == 1 && $j != 3) {
                        $blockResult .= $unitKo[3 - $j];
                    } else {
                        $blockResult .= $numKo[$digit] . $unitKo[3 - $j];
                    }
                }
            }

            if ($blockResult !== '') {
                $blockResult .= $manKo[$blockCount - $i - 1];
            }

            $result .= $blockResult;
        }

        return $result;
    }
}

// check Timestamp
if (!function_exists('isValidTimestamp')) {
    function isValidTimestamp($timestamp)
    {
        try {
            $date = new DateTime($timestamp);
            return $date && $date->format('Y-m-d') !== '-0001-11-30';
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('formatKoreanDate')) {
    function formatKoreanDate($dateString) {
        $date = \Carbon\Carbon::parse($dateString);
        $weekdays = ['일','월','화','수','목','금','토'];
        return '(' . $weekdays[$date->dayOfWeek] . ')';
    }
}