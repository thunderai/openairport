<?php

/**
 * This is the baseclass for all dependencies.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_dependency.php,v 1.4 2003/07/01 10:05:04 gimpster Exp
 * @package  PHP Weather Configurator
 * @abstract
 */
class pw_dependency {

  /**
   * Other dependencies that this dependency depends on.
   *
   * @var  mixed  Depending on the subclass, this can be an array of
   * other dependencies, a string to match or something else.
   */
  var $dep;
  
  /**
   * Constructs a new dependency.
   *
   * @param  string  $dep  Other dependencies.
   */
  function pw_dependency($dep) {
    $this->dep = $dep;
  }

  /**
   * Check the dependency.
   *
   * @return  boolean  Returns false because this is an abstract method.
   * @abstract
   */
  function check() {
    trigger_error('Abstract method', E_USER_ERROR);
  }
}
?>