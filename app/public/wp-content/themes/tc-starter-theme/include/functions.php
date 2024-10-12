<?php

function tcCreatePlaceholder($w = 250, $h = 200, $alpha = 127, $b = array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 1))
{
    $tmp = tempnam(sys_get_temp_dir(), 'img');

    if (is_null($w) || is_null($h)) return '';
    $image = imagecreate($w, $h);
    imagecolorallocatealpha($image, $b['r'], $b['g'], $b['b'], $alpha);

    imagepng($image, $tmp);
    imagedestroy($image);

    $data = base64_encode(file_get_contents($tmp));
    @unlink($tmp);
    return 'data:image/png;base64,' . $data;
}

function tcRedirectAssets($search, $replace, $subject)
{
    return str_replace($search, $replace, $subject);
}

function tcDataUri($file, $mime)
{
    $contents = file_get_contents($file);
    $base64 = base64_encode($contents);
    return ('data:' . $mime . ';base64,' . $base64);
}

function tcDetectBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/OPR/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } elseif (preg_match('/Edge/i', $u_agent)) {
        $bname = 'Edge';
        $ub = "Edge";
    } elseif (preg_match('/Trident/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}

function tcGetImageMimeType($image_path)
{
    $mimes = array(
        IMAGETYPE_GIF => "image/gif",
        IMAGETYPE_JPEG => "image/jpg",
        IMAGETYPE_PNG => "image/png",
        IMAGETYPE_SWF => "image/swf",
        IMAGETYPE_PSD => "image/psd",
        IMAGETYPE_BMP => "image/bmp",
        IMAGETYPE_TIFF_II => "image/tiff",
        IMAGETYPE_TIFF_MM => "image/tiff",
        IMAGETYPE_JPC => "image/jpc",
        IMAGETYPE_JP2 => "image/jp2",
        IMAGETYPE_JPX => "image/jpx",
        IMAGETYPE_JB2 => "image/jb2",
        IMAGETYPE_SWC => "image/swc",
        IMAGETYPE_IFF => "image/iff",
        IMAGETYPE_WBMP => "image/wbmp",
        IMAGETYPE_XBM => "image/xbm",
        IMAGETYPE_ICO => "image/ico",
        IMAGETYPE_WEBP => 'image/webp'

    );

    if (($image_type = exif_imagetype($image_path))
        && (array_key_exists($image_type, $mimes))) {
        return $mimes[$image_type];
    } else {
        return false;
    }
}
remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
add_action( 'wpcf7_init', 'my_add_form_tag_submit', 10, 0 );

function my_add_form_tag_submit() {
    wpcf7_add_form_tag( 'submit', 'my_submit_form_tag_handler' );
}

function my_submit_form_tag_handler( $tag ) : string {
    return '<button class="btn btn-dark tc-btn-arrow-dark" type="submit">invia</button>';
}