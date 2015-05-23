<?php

/*
 * Casting functions.
 * Author: 	Alastair Netterfield
 * Revised: 05/02/2015
 */
class Cast {

  private static $test_data = [
    [20150117000000,23.1],
    [20150117003000,22.6],
    [20150117010000,22.2],
    [20150117013000,22.3],
    [20150117020000,21.7],
    [20150117023000,21.3],
    [20150117030000,20.9],
    [20150117033000,20.1]
  ];

  /* Arrays
  /****************************************************************************/

  public static function to_a($value, $fallback=[]) {
    if (isset($value)) {
      if (is_array($value)) {
        return $value;
      } else {
        return [$value];
      }
    } else {
      return $fallback;
    }
  }

  /* Numbers
  /****************************************************************************/

  public static function to_i($value, $fallback=0) {
    if (isset($value)) {
      if (is_int($value)) {
        return $value;
      } else {
        if (is_numeric($value)) {
          return (int) $value;
        } else {
          return $fallback;
        }
      }
    } else {
      return $fallback;
    }
  }

  public static function to_f($value, $fallback=0.0) {
    if (isset($value)) {
      if (is_float($value)) {
        return $value;
      } else {
        if (is_numeric($value)) {
          return (float) $value;
        } else {
          return $fallback;
        }
      }
    } else {
      return $fallback;
    }
  }

  /* Strings
  /****************************************************************************/

  public static function to_s($value, $fallback='') {
    if (isset($value)) {
      if (is_string($value)) {
        return $value;
      } else {
        return (string) $value;
      }
    } else {
      return $fallback;
    }
  }

  public static function to_sym($value) {
    $value = self::to_s($value);
    $value = preg_replace('/[.\s]+/', '_', $value);
    $value = preg_replace('/[@()]+/', '', $value);
    return $value;
  }

  public static function titleize($value) {
    $value = self::to_s($value);
    $value = preg_replace('/[^a-z0-9.]+/i', '', $value);
    $value = str_replace('.', ' ', $value);
    $value = ucwords(strtolower($value));
    return $value;
  }

  public static function to_id($value) {
    $value = self::to_s($value);
    $value = str_replace(':', '_', $value);
    $value = str_replace('#', '', $value);
    return $value;
  }

  public static function to_rid($value) {
    $value = self::to_s($value);
    $value = str_replace('_', ':', $value);
    return '#' . $value;
  }

  /* Dates
  /****************************************************************************/

  public static function to_date($value, $format=null) {
    if (isset($format)) {
      return date_parse_from_format($format, $value);
    } else {
      $full_date_array = date_parse($value);
      $date = array_slice($full_date_array, 0, 3);
      $time = array_slice($full_date_array, 3, 3);
      $date_string = implode("-", $date) . " " . implode(":", $time);
      return $date_string;
    }
  }

}
