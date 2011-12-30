<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * Super class for all entities like Institute, Publication, Expert, Project.
 */
class EntityBase {

  /**
   * This method checks if a field value has only a maximum number of characters.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param int $maximumLength The maximum allowed number of characters
   * @throws InvalidArgumentException If check was not successfull
   */
  public function checkMaximumLength( $stringValue, $maximumLength, $fieldName ) {

    if ( is_null( $stringValue ) or $maximumLength <= 0 or is_null( $fieldName ) or strlen( $fieldName ) == 0 ) {
      return;
    }
    
    if ( strlen( $stringValue ) > $maximumLength ) {
      throw new InvalidArgumentException( $fieldName . ' must not have more than ' . $maximumLength . ' characters.' );
    }
  }

  /**
   * This checks if a field value has a certain number of characters.
   * 
   * @param string $stringValue The field value
   * @param int $exactLength The number of characters
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  public function checkExactLength( $stringValue, $fieldName, $exactLength ) {

    if ( is_null( $fieldName ) or strlen( $fieldName ) == 0 or $exactLength <= 0 ) {
      return;
    }
    
    if ( is_null( $stringValue ) or strlen( $stringValue ) != $exactLength ) {
      throw new InvalidArgumentException( $fieldName . ' must have exactly ' . $exactLength . ' characters.' );
    }
  }

  /**
   * This checks if a field value has one of a certain number of characters.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param array of int $exactLengths all valid lengths
   * @throws InvalidArgumentException If check was not successfull
   */
  public function checkExactLengths( $stringValue, $fieldName, $exactLengths ) {

    if ( count( $exactLengths ) == 0 or is_null( $fieldName ) or strlen( $fieldName ) == 0 ) {
      return;
    }
    
    if ( is_null( $stringValue ) ) {
      throw new InvalidArgumentException( $fieldName . ' has wrong number of characters, i. e it is the NULL reference.' );
    }
    
    $foundLength = -1;
    foreach ( $exactLengths as $len ) {
      if ( $len >= 1 and strlen( $stringValue ) == $len ) {
        $foundLength = $len;
        break;
      }
    }
    if ( $foundLength === -1 ) {
      throw new InvalidArgumentException( $fieldName . ' has wrong number of characters.' );
    }
  }

  /**
   * This returns TRUE if the given string value is NULL or has length 0.
   */
  protected function isEmpty( $stringValue ) {

    return is_null( $stringValue ) or strlen( $stringValue ) === 0;
  }

  /**
   * This checks if the given string value consists only of digits, e. g. '1230'.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDigitsOnly( $stringValue, $fieldName ) {

    if ( !( is_null( $stringValue ) or strlen( $stringValue ) === 0 or ctype_digit( $stringValue ) ) ) {
      throw new InvalidArgumentException( $fieldName . ' does not consist of digits only; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if two characters are the same.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param string $stringValueToCheck The part of $stringValue which is checked against $char.
   * @param string $char The character which is checked against $stringValueToCheck
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function check1char( $stringValue, $fieldName, $stringValueToCheck, $char ) {

    if ( is_null( $stringValueToCheck ) or strlen( $stringValueToCheck ) != 1 or $char != $stringValueToCheck ) {
      throw new InvalidArgumentException( $fieldName . ' does not contain the character ' . $char . '; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a value is between 1000 and 3000, which can be used as a check if a year is valid.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param string $value The value which is checcked, i. e. which contains the year, e. g. '1500'
   * @throws InvalidArgumentException If check was not successfull
   */
  private function checkYear( $stringValue, $fieldName, $value ) {

    if ( $value < 1000 ) {
      throw new InvalidArgumentException( $fieldName . ' must contain a year after 999, not ' . $value . '; the value is: ' . $stringValue );
    }
    if ( $value > 3000 ) {
      throw new InvalidArgumentException( $fieldName . ' must contain a year before 3001, not ' . $value . '; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a value is between 1 and 12, which can be used as a check if a month is valid.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param string $value The value which is checcked, i. e. which contains the month, e. g. '03'
   * @throws InvalidArgumentException If check was not successfull
   */
  private function checkMonth( $stringValue, $fieldName, $value ) {

    if ( $value <= 0 or $value >= 13 ) {
      throw new InvalidArgumentException( $fieldName . ' must contain a month between 01 and 12, not ' . $value . '; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a value is between 1 and 31, which can be used as a check if a day is valid.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param string $value The value which is checcked, i. e. which contains the day, e. g. '03'
   * @throws InvalidArgumentException If check was not successfull
   */
  private function checkDay( $stringValue, $fieldName, $value ) {

    if ( $value <= 0 or $value >= 32 ) {
      throw new InvalidArgumentException( $fieldName . ' must contain a mday between 01 and 31, not ' . $value . '; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a given value is either a valid year (YYYY) or a valid year with month (YYYY-MM).
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDate4or7( $stringValue, $fieldName ) {

    $previous = NULL;
    
    try {
      $this->checkDate4( $stringValue, $fieldName );
    }
    catch ( InvalidArgumentException $x ) {
      $previous = $x;
    }
    
    try {
      $this->checkDate7( $stringValue, $fieldName );
    }
    catch ( InvalidArgumentException $x ) {
      if ( is_null( $previous ) ) {
        return;
      }
      throw new InvalidArgumentException( $fieldName . ' does not have the format YYYY-mm or YYYY; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a given value is either a valid year (YYYY) or a valid year with month and day (YYYY-MM-DD).
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDate4or10( $stringValue, $fieldName ) {

    $previous = NULL;
    
    try {
      $this->checkDate4( $stringValue, $fieldName );
    }
    catch ( InvalidArgumentException $x ) {
      $previous = $x;
    }
    
    try {
      $this->checkDate10( $stringValue, $fieldName );
    }
    catch ( InvalidArgumentException $x ) {
      if ( is_null( $previous ) ) {
        return;
      }
      throw new InvalidArgumentException( $fieldName . ' does not have the format YYYY-MM-DD or YYYY; the value is: ' . $stringValue );
    }
  }

  /**
   * This checks if a given value is a valid year (YYYY).
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDate4( $stringValue, $fieldName ) {

    $exactLength = 4;
    $this->checkExactLength( $stringValue, $fieldName, $exactLength );
    $this->checkDigitsOnly( $stringValue, $fieldName );
    $this->checkYear( $stringValue, $fieldName, $stringValue );
    $this->checkValidDate( $stringValue, $fieldName, substr( $stringValue, 0, 4 ), 1, 1 );
  }

  /**
   * This checks if a given value is a valid year with month (YYYY-MM).
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDate7( $stringValue, $fieldName ) {

    $exactLength = 7;
    $separator = '-';
    $this->checkExactLength( $stringValue, $fieldName, $exactLength );
    $this->checkDigitsOnly( substr( $stringValue, 0, 4 ), $fieldName );
    $this->checkDigitsOnly( substr( $stringValue, 5, 2 ), $fieldName );
    $this->checkYear( $stringValue, $fieldName, substr( $stringValue, 0, 4 ) );
    $this->checkMonth( $stringValue, $fieldName, substr( $stringValue, 5, 2 ) );
    $this->check1char( $stringValue, $fieldName, substr( $stringValue, 4, 1 ), $separator );
    $this->checkValidDate( $stringValue, $fieldName, substr( $stringValue, 0, 4 ), substr( $stringValue, 5, 2 ), 1 );
  }

  /**
   * This checks if a given value is a valid year with month and day (YYYY-MM-DD).
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @throws InvalidArgumentException If check was not successfull
   */
  protected function checkDate10( $stringValue, $fieldName ) {

    $exactLength = 10;
    $separator = '-';
    $this->checkExactLength( $stringValue, $fieldName, $exactLength );
    $this->checkDigitsOnly( substr( $stringValue, 0, 4 ), $fieldName );
    $this->checkDigitsOnly( substr( $stringValue, 5, 2 ), $fieldName );
    $this->checkDigitsOnly( substr( $stringValue, 8, 2 ), $fieldName );
    $this->checkYear( $stringValue, $fieldName, substr( $stringValue, 0, 4 ) );
    $this->checkMonth( $stringValue, $fieldName, substr( $stringValue, 5, 2 ) );
    $this->checkDay( $stringValue, $fieldName, substr( $stringValue, 8, 2 ) );
    $this->check1char( $stringValue, $fieldName, substr( $stringValue, 4, 1 ), $separator );
    $this->check1char( $stringValue, $fieldName, substr( $stringValue, 7, 1 ), $separator );
    $this->checkValidDate( $stringValue, $fieldName, substr( $stringValue, 0, 4 ), substr( $stringValue, 5, 2 ), substr( $stringValue, 8, 2 ) );
  }

  /**
   * This checks if a date with the given year, month, and day is valid.
   * 
   * @param string $stringValue The field value
   * @param string $fieldName The name of the field the value of which is checked
   * @param int $year The year of the date
   * @param int $month The month of the date
   * @param int $day The day of the date
   * @throws InvalidArgumentException If check was not successfull
   */
  private function checkValidDate( $stringValue, $fieldName, $year, $month = 1, $day = 1 ) {

    if ( !checkdate( $month, $day, $year ) ) {
      throw new InvalidArgumentException( $fieldName . ' does not contain a valid date; the value is: ' . $stringValue );
    }
  }

}

?>