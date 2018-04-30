<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaIps
 *
 * @ORM\Table(name="media_ips")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaIpsRepository")
 */
class MediaIps
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}$/",
     *     message="It is not IPv4 IP valid format"
     * )
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="advertisedIp", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}$/",
     *     message="It is not IPv4 IP valid format"
     * )
     */
    private $advertisedIp;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MediaIps
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return MediaIps
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set advertisedIp
     *
     * @param string $advertisedIp
     *
     * @return MediaIps
     */
    public function setAdvertisedIp($advertisedIp)
    {
        $this->advertisedIp = $advertisedIp;

        return $this;
    }

    /**
     * Get advertisedIp
     *
     * @return string
     */
    public function getAdvertisedIp()
    {
        return $this->advertisedIp;
    }

    /**
     * @var string
     *
    */
    public function __toString()
    {
        return $this->nombre ;

    }


}

