<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RoutingRequests
 *
 * @ORM\Table(name="routing_requests")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoutingRequestsRepository")
 */
class RoutingRequests
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
     * @ORM\Column(name="nextHop", type="string", length=255)
     */
    private $nextHop;

    /**
     * @var string
     *
     * @ORM\Column(name="nextHopTransport", type="string", length=8)
     */
    private $nextHopTransport;

    /**
     * @var int
     *
     * @ORM\Column(name="nextHopPort", type="integer")
     * @Assert\Regex(
     *     pattern="/^(?:[0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|[1-5][0-9][0-9][0-9][0-9]|6[0-4][0-9][0-9][0-9]|65[0-4][0-9][0-9]|655[0-2][0-9]|6553[0-5])$/",
     *     message="It is not valid port number. Port range: 0-65535"
     * )
     */
    private $nextHopPort;

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
     * @var bool
     *
     * @ORM\Column(name="handleRtp", type="boolean")
     */
    private $handleRtp;

    /**
     * @var MediaIps 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MediaIps")
     * @ORM\JoinColumn(name="incomingRtpInterface_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $incomingRtpInterface;

    /**
     * @var MediaIps 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MediaIps")
     * @ORM\JoinColumn(name="outgoingRtpInterface_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $outgoingRtpInterface;

    /**
     * @var string
     *
     * @ORM\Column(name="rtpEngineRawOptions", type="string", length=255, nullable=true)
     */
    private $rtpEngineRawOptions;

    /**
     * @var string
     *
     * @ORM\Column(name="protocoloEntrada", type="string", length=8)
     */
    private $protocoloEntrada;


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
     * @return RoutingRequests
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
     * @return RoutingRequests
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
     * @return RoutingRequests
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
     * Set redOrigen
     *
     * @param string $redOrigen
     *
     * @return RoutingRequests
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
     * Set nextHop
     *
     * @param string $nextHop
     *
     * @return RoutingRequests
     */
    public function setNextHop($nextHop)
    {
        $this->nextHop = $nextHop;

        return $this;
    }

    /**
     * Get nextHop
     *
     * @return string
     */
    public function getNextHop()
    {
        return $this->nextHop;
    }

    /**
     * Set nextHopTransport
     *
     * @param string $nextHopTransport
     *
     * @return RoutingRequests
     */
    public function setNextHopTransport($nextHopTransport)
    {
        $this->nextHopTransport = $nextHopTransport;

        return $this;
    }

    /**
     * Get nextHopTransport
     *
     * @return string
     */
    public function getNextHopTransport()
    {
        return $this->nextHopTransport;
    }

    /**
     * Set nextHopPort
     *
     * @param integer $nextHopPort
     *
     * @return RoutingRequests
     */
    public function setNextHopPort($nextHopPort)
    {
        $this->nextHopPort = $nextHopPort;

        return $this;
    }

    /**
     * Get nextHopPort
     *
     * @return int
     */
    public function getNextHopPort()
    {
        return $this->nextHopPort;
    }

    /**
     * Set ipSalida
     *
     * @param string $ipSalida
     *
     * @return RoutingRequests
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
     * Set portEntrada
     *
     * @param integer $portEntrada
     *
     * @return RoutingRequests
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
     * @return RoutingRequests
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


   /**
     * Set handleRtp
     *
     * @param boolean $handleRtp
     *
     * @return RoutingRequests
     */
    public function setHandleRtp($handleRtp)
    {
        $this->handleRtp = $handleRtp;

        return $this;
    }

    /**
     * Get handleRtp
     *
     * @return bool
     */
    public function getHandleRtp()
    {
        return $this->handleRtp;
    }


    /**
     * Set incomingRtpInterface
     *
     * @param string $mediaIps
     *
     * @return RoutingRequests
     */
    public function setIncomingRtpInterface($incomingRtpInterface)
    {
        $this->incomingRtpInterface = $incomingRtpInterface;

        return $this;
    }

    /**
     * Get mediaIps
     *
     * @return string
     */
    public function getIncomingRtpInterface()
    {
        return $this->incomingRtpInterface;
    }


    /**
     * Set outgoingRtpInterface
     *
     * @param string $mediaIps
     *
     * @return RoutingRequests
     */
    public function setOutgoingRtpInterface($outgoingRtpInterface)
    {
        $this->outgoingRtpInterface = $outgoingRtpInterface;

        return $this;
    }

    /**
     * Get mediaIps
     *
     * @return string
     */
    public function getOutgoingRtpInterface()
    {
        return $this->outgoingRtpInterface;
    }


    /**
     * Set rtpEngineRawOptions
     *
     * @param string $rtpEngineRawOptions
     *
     * @return RoutingRequests
     */
    public function setRtpEngineRawOptions($rtpEngineRawOptions)
    {
        $this->rtpEngineRawOptions = $rtpEngineRawOptions;

        return $this;
    }

    /**
     * Get rtpEngineRawOptions
     *
     * @return string
     */
    public function getRtpEngineRawOptions()
    {
        return $this->rtpEngineRawOptions;
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

}

