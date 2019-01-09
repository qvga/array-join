<?php

class ArrayJoin
{

    public static function inner($left, $right, $on)
    {

        $indexedRight = [];
        $out = [];

        $isObjects = is_object($left[0] ?? []);

        foreach ($right as $i) {
            $i = (array)$i;
            $indexedRight[$i[$on]] = $i;
        }

        foreach ($left as $i) {
            $i = (array)$i;
            $o = array_intersect_key($i, $indexedRight[$i[$on] ?? []]);
            $out[] = $isObjects ? (object)$o : $o;
        }

        return $out;

    }


    public static function left($left, $right, $on)
    {

        $indexedRight = [];
        $out = [];

        $isObjects = is_object($left[0] ?? []);

        foreach ($right as $i) {
            $i = (array)$i;
            $indexedRight[$i[$on]] = $i;
        }

        foreach ($left as $i) {
            $i = (array)$i;
            $o = $i + $indexedRight[$i[$on] ?? []];
            $out[] = $isObjects ? (object)$o : $o;
        }

        return $out;

    }

    public static function right($left, $right, $on)
    {

        return self::left($right, $left, $on);

    }


}
