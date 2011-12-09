<?php

require_once('pw_dependency.php');

/**
 * Depends on an option being ready and having a particular value.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_dependency_equal.php,v 1.1 2003/07/01 10:05:04 gimpster Exp
 * @package  PHP Weather Configurator
 * @abstract
 */
class pw_dependency_equal extends pw_dependency {

  /**
   * The name of an option.
   *
   * @var  string  The name of the option that should be checked.
   */
  var $option;

  /**
   * Constructs a new dependency.
   *
   * @param  string  $option The name of the option that must satisfy
   * the dependency.
   * @param  string  $dep The required value of the option.
   *
   */
  function pw_dependency_equal($option, $dep) {
    $this->option = $option;
    $this->pw_dependency($dep);
  }

  /**
   * Check the dependency.
   *
   * The dependency is tested using value equality (==) and not the
   * more restrictive type and value equality (===). Additionally the
   * option must be ready to be displayed.
   *
   * @return  boolean  Returns true if the dependency is satisfied,
   * false otherwise.
   */
  function check() {
    global $HTTP_SESSION_VARS;
    return ($HTTP_SESSION_VARS[$this->option]->is_ready() &&
            $HTTP_SESSION_VARS[$this->option]->get_value() == $this->dep);
  }

}
?>