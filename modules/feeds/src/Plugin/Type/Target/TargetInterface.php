<?php

namespace Drupal\feeds\Plugin\Type\Target;

use Drupal\Core\Entity\EntityInterface;
use Drupal\feeds\FeedInterface;
use Drupal\feeds\FeedTypeInterface;
use Drupal\feeds\Plugin\DependentWithRemovalPluginInterface;

/**
 * Interface for Feed targets.
 */
interface TargetInterface extends DependentWithRemovalPluginInterface {

  /**
   * Returns the targets defined by this plugin.
   *
   * @param \Drupal\feeds\TargetDefinitionInterface[] $targets
   *   An array of targets.
   * @param \Drupal\feeds\FeedTypeInterface $feed_type
   *   The feed type object.
   * @param array $definition
   *   The plugin implementation definition.
   */
  public static function targets(array &$targets, FeedTypeInterface $feed_type, array $definition);

  /**
   * Sets the values on an object.
   *
   * @param \Drupal\feeds\FeedInterface $feed
   *   The feed object.
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The target object.
   * @param string $target
   *   The name of the target to set.
   * @param array $values
   *   A list of values to set on the target.
   */
  public function setTarget(FeedInterface $feed, EntityInterface $entity, $target, array $values);

}
