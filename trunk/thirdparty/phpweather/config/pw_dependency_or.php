<?php

require_once('pw_dependency.php');

/**
 * An 'or' dependency.
 *
 * This dependency is a collection of several dependencies, but it
 * will be satisfied as long at least one of them is satisfied.  The
 * logic is short-circuit so that the evaluation stops as soon as the
 * answer is known, that is, as soon as one of the dependencies is
 * satisfied.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_dependency_or.php,v 1.4 2003/07/01 10:05:04 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_dependency_or extends pw_dependency {

  /**
   * Constructs a new 'and' dependency.
   *
   * @param  mixed  A variable number of other dependencies. This
   * dependency is satisfied if at least one of the dependencies
   * satisfied.
   */
  function pw_dependency_or() {
    $this->pw_dependency(func_get_args());
  }

  /**
   * Checks the dependency.
   *
   * All the dependencies that were used to create this dependency is
   * tested one after another until one of them is satisfied.
   *
   * @return  boolean  Returns true if at least one of the
   * dependencies are satisfied.
   */
  function check() {
    foreach ($this->dep as $d) {
      if ($d->check()) return true;
    }
    return false;
  }

}

?>