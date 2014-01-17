<?php
/**
 * Különféle függvények vannak összecsomagolva amelyek jól jöhetnek
 */
class Util
{
  /**
   * Egy igazán remek függvény amely byte bemenetből emberi olvasásra alkalmas mértékegységre vált
   *
   * @param  int     $size  byte-ok száma
   * @param  boolean $print írja-e ki az eredményt
   *
   * @return string Az érték a legérthetőbb mértékegységben
   */
  public static function convert($size)
  {
    $unit   = array('b','kb','mb','gb','tb','pb');
    $return = round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];

    return $return;
  }

  public static function getFileInfo($filePath)
  {
    $return = array();

    if (!file_exists($filePath)) {
      throw new Extension(__FILE__.':'.__LINE__.' a megadott fájl (' . $filePath . ') nem létezik!');
    }

    $finfo = finfo_open();
    $file = $filePath;

    // mime description -- PHP script text
    $return['mime_description'] = finfo_file($finfo, $file);

    // mime type -- text/x-php
    $return['mime_type'] = finfo_file($finfo, $file, FILEINFO_MIME_TYPE);

    // mime -- text/x-php; charset=us-ascii
    $return['mime'] = finfo_file($finfo, $file, FILEINFO_MIME);

    // mime encoding -- us-ascii
    $return['mime_encoding'] = finfo_file($finfo, $file, FILEINFO_MIME_ENCODING);

    return $return;
  }

  /**
   * Print array
   *
   * @param  array  $array   array to print
   * @param  string $prefix  prefix
   * @param  string $postfix postfix
   *
   * @return void
   */
  public static function pr($array, $prefix = '<pre>', $postfix = '</pre>')
  {
    if (!is_array($array)) {
      $trace = debug_backtrace();
      throw new Exception($trace[0]['file'] .':' . $trace[0]['line'] . ' parameter is not array!');
    } elseif (defined('APP_DEBUG') && APP_DEBUG) {
      echo $prefix . var_export($array, 1) . $postfix;
    }

    return $prefix . var_export($array, 1) . $postfix;
  }

  public static function debug($string, $prefix = '<pre>', $postfix = '</pre>')
  {
    if (is_array($string)) {
      self::pr($string);
    } elseif (defined('APP_DEBUG') && APP_DEBUG) {
      echo $prefix . var_export($string, 1) . PHP_EOL . $postfix;
    }

    return $prefix . var_export($string, 1) . PHP_EOL . $postfix;
  }
}
