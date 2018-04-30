<?php

namespace AppBundle\EventListener;

use Symfony\Component\Process\Process;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use AppBundle\Entity\MediaIps;
use AppBundle\Entity\SipListeners;

class OpensipsService {

    private $binary = "/bin/systemctl";
    private $serviceName = "opensips";

    public function __construct( $entityManager, $path, \Twig_Environment $twig, Filesystem $filesystem){
        $this->em = $entityManager;
        $this->path = $path;
        $this->twig = $twig;
        $this->filesystem = $filesystem;
    }

    public function restart(){

        // Rtpengine configuration
        $mediaIps = $this->em->getRepository("AppBundle:MediaIps")->findAll();
        $config = $this->twig->render('config/rtpengine/interfaces.twig', [
            'mediaIps' => $mediaIps,
        ]);
        try{
            $this->filesystem->dumpFile($this->path."/../config/rtpengine/interfaces", $config);
        }catch(IOExceptionInterface $exception){
            return array("success"=>false, "msg"=> $exception->getMessage());
        }
       

        // Opensips configuration
        $sipListeners = $this->em->getRepository("AppBundle:SipListeners")->findAll();
        $config = $this->twig->render('config/opensips/opensips_custom_listeners.cfg.twig', [
            'sipListeners' => $sipListeners,
        ]);
        try{
            $this->filesystem->dumpFile($this->path."/../config/opensips/opensips_custom_listeners.cfg", $config);
        }catch(IOExceptionInterface $exception){
            return array("success"=>false, "msg"=> $exception->getMessage());
        } 


        return array("success"=>true);
    }

    public function restart_service(){

        $cmd = $this->binary ." restart ".$this->serviceName;
        $process = new Process($cmd);
        $process->run();
        if ($process->isSuccessful()) {
            return array("success"=> true);
        }
        else {
            return array("success"=>false, "msg"=> $process->getErrorOutput());

        }
    }
}

