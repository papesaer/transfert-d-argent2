<?php

namespace App\Controller;

use App\Entity\Depots;
use App\Entity\Compte;
use App\Algorithm\Algorithm;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CompteController 
{
    public function __construct(RoleRepository $repo,TokenStorageInterface $tokenStorage,Algorithm $algo,UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->tokenStorage = $tokenStorage;
        $this->algo=$algo;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->repo=$repo;
    }
    public function __invoke(Compte $data,UserRepository $use,TokenStorageInterface $tokenStorage):Compte
    {
        
        //usercreator
        $userCreator=$this->tokenStorage->getToken()->getUser();
        //password du user partenaire
        $userPass=$data->getPartenaire()->getUsercreateur()->getPassword();
        //le user
        $user=$data->getPartenaire()->getUsercreateur();
        //id partenaire 
        $iduser=$data->getPartenaire()->getId();
        //montant depot
        $montant=($data->getDepots()[count($data->getDepots())-1]->getMontant());
        //date creation
        $date=date_format($data->getcreatedAt(),"Yms");
        $id=$use->getLast()[0]->getId()+1;
       if($iduser == null){
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $userPass));
        $user->setRole($this->repo->findByLibelle("ROLE_PARTENAIRE")[0]);
        
       }
        if($this->algo->validMontant($montantD)){
            ($this->algo->validMontant($montantD));
            $data->setmontantI($montantD);
            $data->setusercreateur($userCreator);
            $data->setNumero($date.$id);
            return $data;
        }else{
            throw new Exception("Le montant doit etre superieur ou égale à 500.000");
        }
            
        
      
    }
}