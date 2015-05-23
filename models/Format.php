<?php

/*
 * Formatting functions.
 * Author: 	Alastair Netterfield
 * Revised: 19/02/2015
 */
class Format {

  /* Text
  /****************************************************************************/

  public static function paragraph($value, $fallback=0) {
    return "<p>" . Cast::to_s($value) . "</p>";
  }

  /* Numbers
  /****************************************************************************/

  public static function currency($val, $currency_symbol='$') {
    return $currency_symbol . number_format(Cast::to_f($val), 2, '.', ',');
  }

  /* Inputs
  /****************************************************************************/

  public static function option($key, $value, $selected=false) {
    if ($selected) {
      return "<option value='" . Cast::to_s($key) . "' selected='selected'>" . Cast::to_s($value) . "</option>";
    } else {
      return "<option value='" . Cast::to_s($key) . "'>" . Cast::to_s($value) . "</option>";
    }
  }

  /* Tables
  /****************************************************************************/

  public static function td($value) {
    return "<td>" . Cast::to_s($value) . "</td>";
  }

  public static function th($value) {
    return "<th>" . Cast::to_s($value) . "</th>";
  }

  public static function thead($attributes=[]) {
    $cells = [];
    foreach ($attributes as $attribute) {
      $cells[] = self::th(Cast::titleize($attribute));
    }
    return "<thead><tr>" . implode('', $cells) . "</tr></thead>";
  }

  public static function tr($id, $attributes=[], $values=[], $classes=[]) {
    $cells = [];
    foreach ($attributes as $attribute) {
      $attribute = Cast::to_sym($attribute);
      if (array_key_exists($attribute, $values)) {
        $cells[] = self::td($values[$attribute]);
      } else {
        $cells[] = self::td('');
      }
    }
    return "<tr id='" . Cast::to_id($id) . "' class='" . implode(', ', Cast::to_a($classes)) . "'>" . implode('', $cells) . "</tr>";
  }

}
