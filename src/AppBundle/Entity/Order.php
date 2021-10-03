<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(type="integer")
   */
  public $address_id;

  public $date;

  /**
   * @ORM\Column(type="float")
   */
  public $net;

  /**
   * @ORM\Column(type="float")
   */
  public $vat;

  /**
   * @ORM\Column(type="float")
   */
  public $gross;
}