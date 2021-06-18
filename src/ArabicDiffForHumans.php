<?php

namespace Abdussalam\ArDiffForHumans;
class ArabicDiffForHumans
{
    /*
 __  __
/\ \/\ \
\ \ \_\ \      __   _ __          __   __  __      __     ____
 \ \  _  \   /'__`\/\`'__\      /'__`\/\ \/\ \   /'__`\  /',__\
  \ \ \ \ \ /\  __/\ \ \/      /\  __/\ \ \_\ \ /\  __/ /\__, `\
   \ \_\ \_\\ \____\\ \_\      \ \____\\/`____ \\ \____\\/\____/
    \/_/\/_/ \/____/ \/_/       \/____/ `/___/> \\/____/ \/___/
                                           /\___/
                                           \/__/
 __                     __                ___    ___       __     __
/\ \                   /\ \              /\_ \  /\_ \     /\ \__ /\ \
\ \ \___       __      \_\ \         __  \//\ \ \//\ \    \ \ ,_\\ \ \___       __
 \ \  _ `\   /'__`\    /'_` \      /'__`\  \ \ \  \ \ \    \ \ \/ \ \  _ `\   /'__`\
  \ \ \ \ \ /\ \L\.\_ /\ \L\ \    /\ \L\.\_ \_\ \_ \_\ \_   \ \ \_ \ \ \ \ \ /\  __/
   \ \_\ \_\\ \__/.\_\\ \___,_\   \ \__/.\_\/\____\/\____\   \ \__\ \ \_\ \_\\ \____\
    \/_/\/_/ \/__/\/_/ \/__,_ /    \/__/\/_/\/____/\/____/    \/__/  \/_/\/_/ \/____/
 __                                 __                            ___       ___
/\ \                               /\ \__                       /'___\     /\_ \
\ \ \____     __      __     __  __\ \ ,_\  __  __        ___  /\ \__/     \//\ \      ___    __  __     __
 \ \ '__`\  /'__`\  /'__`\  /\ \/\ \\ \ \/ /\ \/\ \      / __`\\ \ ,__\      \ \ \    / __`\ /\ \/\ \  /'__`\
  \ \ \L\ \/\  __/ /\ \L\.\_\ \ \_\ \\ \ \_\ \ \_\ \    /\ \L\ \\ \ \_/       \_\ \_ /\ \L\ \\ \ \_/ |/\  __/
   \ \_,__/\ \____\\ \__/.\_\\ \____/ \ \__\\/`____ \   \ \____/ \ \_\        /\____\\ \____/ \ \___/ \ \____\
    \/___/  \/____/ \/__/\/_/ \/___/   \/__/ `/___/> \   \/___/   \/_/        \/____/ \/___/   \/__/   \/____/
                                                /\___/
                                                \/__/
    */
    public static function getFromDateString($dateString)
    {
        $timeStamp = strtotime($dateString);
        return self::get($timeStamp);
    }
    public static function get($timeStamp)
    {
        $diff = self::getDifference($timeStamp);
        $unit = self::unit($diff);
        $valueOfDifference = floor(self::DiffValue($diff,$unit));

        $result = "";
        switch ($unit){
            case 1:
                $result = self::formatResult($valueOfDifference,"ثانية","ثانيتين","ثواني");
                break;
            case 2:
                $result = self::formatResult($valueOfDifference,"دقيقة","دقيقتين","دقائق");
                break;
            case 3:
                $result = self::formatResult($valueOfDifference,"ساعة","ساعتين","ساعات");
                break;
            case 4:
                $result = self::formatResult($valueOfDifference,"يوم","يومين","أيام");
                break;
            case 5:
                $result = self::formatResult($valueOfDifference,"شهر","شهرين","أشهر");
                break;
            case 6:
                $result = self::formatResult($valueOfDifference,"سنة","سنتين","سنين");
                break;

        }
        return $result;
    }
    private static function DiffValue($diff,$unit)
    {
        $diffValue = 0;
        switch ($unit)
        {
            case 1:
                $diffValue = $diff;
                break;
            case 2:
                $diffValue = self::getMinutes($diff);
                break;
            case 3:
                $diffValue = self::getHours($diff);
                break;
            case 4:
                $diffValue = self::getDays($diff);
                break;
            case 5:
                $diffValue = self::getMonths($diff);
                break;
            case 6:
                $diffValue = self::getYears($diff);
        }
        return $diffValue;
    }
    private static function getDifference($timestamp)
    {
        return abs(time()-$timestamp);
    }

    private static function unit($diff){
        if ($diff<60)
            return 1; // seconds
        else if ($diff<60*60)
            return 2; // minutes
        else if($diff<24*60*60)
            return 3; // hours
        else if($diff<24*60*60*30)
            return 4; //days
        else if($diff<24*60*60*365)
            return 5; // months
        else
            return 6; //years
    }

    private static function getMinutes($diff) {
        return  $diff/60;
    }
    private static function getHours($diff) {
        return $diff/(60*60);
    }
    private static function getDays($diff) {
        return $diff/(60*60*24);
    }
    private static function getMonths($diff) {
        return $diff/(60*60*24*30);
    }
    private static function getYears($diff) {
        return $diff/(365*24*60*60);
    }

    private static function formatResult($valueOfDifference,$single,$double,$plural)
    {
        if($valueOfDifference==1)
            return "منذ ".$single;
        if($valueOfDifference==2)
            return " منذ ".$double;
        if($valueOfDifference<=10)
            return "منذ ".$valueOfDifference." ".$plural;
        return "منذ ".$valueOfDifference." ".$single;
    }
}
