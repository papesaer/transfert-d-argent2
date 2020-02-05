<?php
namespace App\Algorithm;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Algorithm{

   
    public function isAuthorised($userRoles,$usersModi){
        if($userRoles=="ROLE_SUPADMIN"){
            if($usersModi ==  "ROLE_SUPADMIN"){
                return false;
    
            }else{
                return true;
            }
        }
        if($userRoles=="ROLE_ADMIN")
        {  
            if($usersModi ==  "ROLE_SUPADMIN" || $usersModi ==  "ROLE_ADMIN" ){
                return false;

            }else{
                return true;
            }
        }
        if($userRoles=="ROLE_PARTENAIRE"){
            if($usersModi ==  "ROLE_ADMIN_SYST" || $usersModi ==  "ROLE_ADMIN" || $usersModi ==
            "ROLE_PARTENAIRE"){
                return false;

            }else{
                return true;
            }

        }
    }


    public function validMontant($m){
        
        if($m>=500000){
            return true;
        }else{
            return false;
        }
    }
    public function isImage($file)
    {
        $extension=$file->guessExtension();
        if( ($extension === "png") ||( $extension === "jpeg") || ($extension === "pjpeg")  || ( $extension === "jpg") )
        {
            return true;
        }else{
            return false;
        }
    }
    public function genereNum($date,$id){
        return   date_format($date,"Ymd").$id;

    }
}