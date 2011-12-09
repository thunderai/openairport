<?php

require_once('pw_dependency.php');

/**
 * An 'not' dependency.
 *
 * This dependency negates another dependency and is satisfied if and
 * only if the other dependency fails.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_dependency_not.php,v 1.1 2003/07/01 10:05:04 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_dependency_not extends pw_dependency {

  /**
   * Constructs a new 'not' dependency.
   *
   * @param  object  $dependency  The dependency that should be negated.
   */
  function pw_dependency_not($dependency) {
    $this->pw_dependency($dependency);
  }

  /**
   * Checks the dependency.
   *
   * @return  boolean  Returns true if and only if the dependency wasn't
   * satisfied.
   */
  function check() {
    return !$this->dep->check();
  }
}
?>