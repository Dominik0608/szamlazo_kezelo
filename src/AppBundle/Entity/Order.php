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
  public $id;

  /**
   * @ORM\Column(type="integer")
   * @Assert\NotBlank(message="A típus megadása kötelező!")
   */
  public $type;

  /**
   * @ORM\Column(type="string", length=255)
   * @Assert\NotBlank(message="A név megadása kötelező!")
   */
  public $name;

  /**
   * @ORM\Column(type="string", length=20)
   */
  public $phone;

  /**
   * @ORM\Column(type="string", length=13, name="tax_number")
   * @Assert\NotBlank(message="Az adószám megadása kötelező!")
   */
  public $taxNumber;

  /**
   * @ORM\Column(type="string", length=64)
   * @Assert\NotBlank(message="Az ország megadása kötelező!")
   */
  public $country;

  /**
   * @ORM\Column(type="string", length=10, name="post_code")
   * @Assert\NotBlank(message="Az irányítószám megadása kötelező!")
   */
  public $postCode;

  /**
   * @ORM\Column(type="string", length=64)
   * @Assert\NotBlank(message="A város megadása kötelező!")
   */
  public $city;

  /**
   * @ORM\Column(type="string", length=128)
   * @Assert\NotBlank(message="Az utca és házszám megadása kötelező!")
   */
  public $street;

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