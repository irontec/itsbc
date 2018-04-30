<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RoutingRegisters
 *
 * @ORM\Table(name="routing_registers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoutingRegistersRepository")
 */
class RoutingRegisters
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
     * @var int
     *
     * @ORM\Column(name="metrica", type="integer")
     */
    private $metrica;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((?:[-A-Za-z0-9]+\.)+[A-Za-z]{2,6}|((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4})$/",
     *     message="It is not domain valid format"
     * )
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="ipEntrada", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}$/",
     *     message="It is not IPv4 IP valid format"
     * )
     */
    private $ipEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="ipSalida", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}$/",
     *     message="It is not IPv4 IP valid format"
     * )
     */
    private $ipSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="protocoloEntrada", type="string", length=8)
     */
    private $protocoloEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="redOrigen", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}\/(((1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])($|\.)){4})$/",
     *     message="It is not Network valid format. For example: 10.10.10.0/255.255.255.0"
     * )
     */
    private $redOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="registrarServer", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^((^|\.)(1[0-9]{2}|[1-9][0-9]|[0-9]|2[0-4][0-9]|25[0-5])){4}$/",
     *     message="It is not IPv4 IP valid format"
     * )
     */
    private $registrarServer;

    /**
     * @var string
     *
     * @ORM\Column(name="registrarTransport", type="string", length=8)
     */
    private $registrarTransport;

    /**
     * @var int
     *
     * @ORM\Column(name="registrarPort", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $registrarPort;


    /**
     * @var int
     *
     * @ORM\Column(name="portEntrada", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $portEntrada;

    /**
     * @var int
     *
     * @ORM\Column(name="portSalida", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $portSalida;



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
     * Set metrica
     *
     * @param integer $metrica
     *
     * @return RoutingRegisters
     */
    public function setMetrica($metrica)
    {
        $this->metrica = $metrica;

        return $this;
    }

    /**
     * Get metrica
     *
     * @return int
     */
    public function getMetrica()
    {
        return $this->metrica;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return RoutingRegisters
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set ipEntrada
     *
     * @param string $ipEntrada
     *
     * @return RoutingRegisters
     */
    public function setIpEntrada($ipEntrada)
    {
        $this->ipEntrada = $ipEntrada;

        return $this;
    }

    /**
     * Get ipEntrada
     *
     * @return string
     */
    public function getIpEntrada()
    {
        return $this->ipEntrada;
    }

    /**
     * Set ipSalida
     *
     * @param string $ipSalida
     *
     * @return RoutingRegisters
     */
    public function setIpSalida($ipSalida)
    {
        $this->ipSalida = $ipSalida;

        return $this;
    }

    /**
     * Get ipSalida
     *
     * @return string
     */
    public function getIpSalida()
    {
        return $this->ipSalida;
    }

    /**
     * Set protocoloEntrada
     *
     * @param string $protocoloEntrada
     *
     * @return RoutingRegisters
     */
    public function setProtocoloEntrada($protocoloEntrada)
    {
        $this->protocoloEntrada = $protocoloEntrada;

        return $this;
    }

    /**
     * Get protocoloEntrada
     *
     * @return string
     */
    public function getProtocoloEntrada()
    {
        return $this->protocoloEntrada;
    }

    /**
     * Set redOrigen
     *
     * @param string $redOrigen
     *
     * @return RoutingRegisters
     */
    public function setRedOrigen($redOrigen)
    {
        $this->redOrigen = $redOrigen;

        return $this;
    }

    /**
     * Get redOrigen
     *
     * @return string
     */
    public function getRedOrigen()
    {
        return $this->redOrigen;
    }

    /**
     * Set registrarServer
     *
     * @param string $registrarServer
     *
     * @return RoutingRegisters
     */
    public function setRegistrarServer($registrarServer)
    {
        $this->registrarServer = $registrarServer;

        return $this;
    }

    /**
     * Get registrarServer
     *
     * @return string
     */
    public function getRegistrarServer()
    {
        return $this->registrarServer;
    }

    /**
     * Set registrarTransport
     *
     * @param string $registrarTransport
     *
     * @return RoutingRegisters
     */
    public function setRegistrarTransport($registrarTransport)
    {
        $this->registrarTransport = $registrarTransport;

        return $this;
    }

    /**
     * Get registrarTransport
     *
     * @return string
     */
    public function getRegistrarTransport()
    {
        return $this->registrarTransport;
    }

    /**
     * Set registrarPort
     *
     * @param integer $registrarPort
     *
     * @return RoutingRegisters
     */
    public function setRegistrarPort($registrarPort)
    {
        $this->registrarPort = $registrarPort;

        return $this;
    }

    /**
     * Get registrarPort
     *
     * @return int
     */
    public function getRegistrarPort()
    {
        return $this->registrarPort;
    }


    /**
     * Set portEntrada
     *
     * @param integer $portEntrada
     *
     * @return RoutingRegisters
     */
    public function setPortEntrada($portEntrada)
    {
        $this->portEntrada = $portEntrada;

        return $this;
    }

    /**
     * Get portEntrada
     *
     * @return int
     */
    public function getPortEntrada()
    {
        return $this->portEntrada;
    }


    /**
     * Set portSalida
     *
     * @param integer $portSalida
     *
     * @return RoutingRegisters
     */
    public function setPortSalida($portSalida)
    {
        $this->portSalida = $portSalida;

        return $this;
    }

    /**
     * Get portSalida
     *
     * @return int
     */
    public function getPortSalida()
    {
        return $this->portSalida;
    }


}
