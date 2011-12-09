<?php

require_once('pw_dependency.php');

/**
 * An 'and' dependency.
 *
 * This dependency is a collection of several dependencies and will
 * only be satisfied when all of them is satisfied.  The logic is
 * short-circuit so that the evaluation stops as soon as the answer is
 * known, that is, as soon as one of the dependencies fail.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_dependency_and.php,v 1.1 2003/07/01 10:05:04 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_dependency_and extends pw_dependency {

  /**
   * Constructs a new 'and' dependency.
   *
   * @param  mixed  A variable number of other dependencies. This
   * dependency is satisfied if and only if all the dependencies
   * satisfied.
   */
  function pw_dependency_and() {
    $this->pw_dependency(func_get_args());
  }

  /**
   * Checks the dependency.
   *
   * All the dependencies that were used to create this dependency is
   * tested one after another.
   *
   * @return  boolean  Returns true if and only if all all the
   * dependencies are satisfied.
   */
  function check() {
    foreach ($this->dep as $d) {
      if (!$d->check()) return false;
    }
    return true;
  }
}
?>