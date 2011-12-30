<?php

/**
 * This is used by the logger for storing messages in memory
 * and displaying them later.
 */
final class HarvesterMessages
{



  public function __construct()
  {
    $this->messages = new Vector();
    $this->error = FALSE;
  }



  /**
   * This adds the given message to the internal list of messages. 
   * 
   * @param string $message May be NULL, then nothing is added.
   */
  public function addMessage( $message )
  {
    $this->messages->add( $message );
  }



  /**
   * This adds the message and stack trace of the given exception
   * to the internal list of messages, and sets the error flag to TRUE.
   * 
   * @param Exception $exception May be NULL, then nothing is added.
   */
  public function addException( Exception $exception )
  {
    if ( !is_null( $exception ) )
    {
      $this->messages->add( $exception->getMessage() );
      $this->messages->add( $exception->getTraceAsString() );
      $this->setError();
    }
  }



  /**
   * This returns TRUE, if there are no messages.
   */
  public function isEmpty()
  {
    return $this->messages->isEmpty();
  }



  /**
   * This sets the internal error flag to TRUE.
   */
  public function setError()
  {
    $current = $this->error;
    
    $this->error = TRUE;
    
    return $current;
  }



  /**
   * This returns the internal error flag.
   *
   *
   */
  public function isError()
  {
    return $this->error;
  }



  /**
   * This sets the internal error flag to FALSE.
   */
  public function clearError()
  {
    $current = $this->error;
    
    $this->error = FALSE;
    
    return $current;
  }



  /**
   * This returns the error messages as an unsorted HTML list.
   *
   */
  public function asHTML()
  {
    if ( $this->isError() )
    {
      echo "<h3><b><font color='#aa0000'>ERROR: Harvesting did not work.</font></b></h3>";
    }
    
    $len = $this->messages->size();
    if ( $len >= 1 )
    {
      echo '<ul>';
      for( $i = 0; $i < $len; $i++ )
      {
        $m = $this->messages->get( $i );
        
        $pos = strpos( $m, 'ERROR' );
        if ( !( $pos === FALSE ) )
        {
          $m = "<b><font color='#aa0000'>{$m}</font></b>";
        }
        
        $pos = strpos( $m, '=== ===' );
        if ( !( $pos === FALSE ) )
        {
          $m = "<i><font color='#999999'>{$m}</font></i>";
        }
        
        $pos = strpos( $m, '+++ +++' );
        if ( !( $pos === FALSE ) )
        {
          $m = "<i><font color='#999999'>{$m}</font></i>";
        }
        
        $pos = strpos( $m, '###' );
        if ( !( $pos === FALSE ) )
        {
          $m = "<font color='#0000aa'>{$m}</font>";
        }
        
        $pos = strpos( $m, '___' );
        if ( !( $pos === FALSE ) )
        {
          $m = "<font color='#0000aa'>{$m}</font>";
        }
        
        $pos = strpos( $m, 'sql =' );
        if ( !( $pos === FALSE ) )
        {
          $m = substr( $m, 0, $pos + 6 ) . "<span style='color: black; background-color: #ddffff;'>" . substr( $m, $pos + 6 ) . "</span>";
        }
        
        echo '<li>' . $m;
      }
      echo '</ul>';
    }
  }

  /**
   * The list of messages.
   * 
   * @var Vector
   */
  private $messages;

  /**
   * A flag which indicates, if there is at least one error message.
   * But this flag might also be set manually to show that an error happend during the harvesting process.
   * 
   * @var boolean
   */
  private $error;

}

?>