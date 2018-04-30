<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SipListeners
 *
 * @ORM\Table(name="sip_listeners")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SipListenersRepository")
 */
class SipListeners
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
     * @ORM\Column(name="protocolo", type="string", length=8)
     */
    private $protocolo;

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
     * @var int
     *
     * @ORM\Column(name="puerto", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $puerto;

    /**
     * @var int
     *
     * @ORM\Column(name="advertisedPort", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $advertisedPort;



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
     * Set protocolo
     *
     * @param string $protocolo
     *
     * @return SipListeners
     */
    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get protocolo
     *
     * @return string
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return SipListeners
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
     * @return SipListeners
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
     * Set puerto
     *
     * @param integer $puerto
     *
     * @return SipListeners
     */
    public function setPuerto($puerto)
    {
        $this->puerto = $puerto;

        return $this;
    }

    /**
     * Get puerto
     *
     * @return int
     */
    public function getPuerto()
    {
        return $this->puerto;
    }

    /**
     * Set advertisedPort
     *
     * @param integer $advertisedPort
     *
     * @return SipListeners
     */
    public function setAdvertisedPort($advertisedPort)
    {
        $this->advertisedPort = $advertisedPort;

        return $this;
    }

    /**
     * Get advertisedPort
     *
     * @return int
     */
    public function getAdvertisedPort()
    {
        return $this->advertisedPort;
    }

}

