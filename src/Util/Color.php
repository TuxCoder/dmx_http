<?php
namespace DmxHttp\Util;


class Color
{
    public static function HSV2RGB($H, $S, $V)
    {
        //1
        $H *= 6;
        //2
        $I = floor($H);
        $F = $H - $I;
        //3
        $M = $V * (1 - $S);
        $N = $V * (1 - $S * $F);
        $K = $V * (1 - $S * (1 - $F));
        //4
        switch ($I) {
            case 0:
                list($R, $G, $B) = array($V, $K, $M);
                break;
            case 1:
                list($R, $G, $B) = array($N, $V, $M);
                break;
            case 2:
                list($R, $G, $B) = array($M, $V, $K);
                break;
            case 3:
                list($R, $G, $B) = array($M, $N, $V);
                break;
            case 4:
                list($R, $G, $B) = array($K, $M, $V);
                break;
            case 5:
            case 6: //for when $H=1 is given
                list($R, $G, $B) = array($V, $M, $N);
                break;
        }
        return array($R, $G, $B);
    }

    public static function RGB2HSV($R, $G, $B)
    {
        $HSL = array();

        $var_R = ($R / 255);
        $var_G = ($G / 255);
        $var_B = ($B / 255);

        $var_Min = min($var_R, $var_G, $var_B);
        $var_Max = max($var_R, $var_G, $var_B);
        $del_Max = $var_Max - $var_Min;

        $V = $var_Max;

        if ($del_Max == 0) {
            $H = 0;
            $S = 0;
        } else {
            $S = $del_Max / $var_Max;

            $del_R = ((($var_Max - $var_R) / 6) + ($del_Max / 2)) / $del_Max;
            $del_G = ((($var_Max - $var_G) / 6) + ($del_Max / 2)) / $del_Max;
            $del_B = ((($var_Max - $var_B) / 6) + ($del_Max / 2)) / $del_Max;

            if ($var_R == $var_Max) $H = $del_B - $del_G;
            else if ($var_G == $var_Max) $H = (1 / 3) + $del_R - $del_B;
            else if ($var_B == $var_Max) $H = (2 / 3) + $del_G - $del_R;

            if ($H < 0) $H++;
            if ($H > 1) $H--;
        }

        $HSL['H'] = $H;
        $HSL['S'] = $S;
        $HSL['V'] = $V;

        return $HSL;
    }
}