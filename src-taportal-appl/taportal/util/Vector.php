<?php

/**
 * Simple helper class for a dynamic array.
 */
class Vector
{



  public function __construct()
  {
  }



  /**
   * This adds the given element to the Vector, if it is not NULL and not yet in the Vector.
   * Returns TRUE, if element was added.
   */
  public final function add( $x )
  {
    if ( is_null( $x ) or $this->contains( $x ) )
    {
      return FALSE;
    }
    
    $this->data[] = $x;
    
    return TRUE;
  }



  /**
   * This removes the given element from the Vector and then returns TRUE.
   * If the given element is NULL or not in the Vector, then FALSE is returned.
   */
  public final function remove( $x )
  {
    if ( is_null( $x ) )
    {
      return FALSE;
    }
    
    for( $i = 0; $i < count( $this->data ); $i++ )
    {
      if ( isset( $this->data[ $i ] ) and $this->data[ $i ] === $x )
      {
        unset( $this->data[ $i ] );
        $this->data = array_values( $this->data );
        return TRUE;
      }
    }
    
    return FALSE;
  }



  /**
   * This returns the element from the Vector at the given index.
   * If the index is invalid, NULL is returned.
   */
  public final function get( $index )
  {
    
    if ( $index < 0 or $index >= count( $this->data ) )
    {
      return NULL;
    }
    
    return $this->data[ $index ];
  }



  /**
   * This removes all elements from the Vector.
   */
  public final function clear()
  {
    
    $this->data = array();
  }



  /**
   * This returns the current number of elements in the Vector.
   */
  public final function size()
  {
    
    return count( $this->data );
  }



  /**
   * This returns TRUE, if the Vector contains at least one element.
   * Enter description here ...
   */
  public final function areThere()
  {
    
    return $this->size() >= 1;
  }



  /**
   * This returns TRUE, if the Vector contains no elements.
   */
  public final function isEmpty()
  {
    return $this->size() == 0;
  }



  /**
   * This returns TRUE, if the given element is not NULL and is
   * contained in the Vector.
   */
  public final function contains( $x )
  {
    if ( is_null( $x ) )
    {
      return FALSE;
    }
    
    foreach ( $this->data as $element )
    {
      if ( $x === $element )
      {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * This is the array for storing the elements of the Vector.
   */
  private $data = array();

}
?>