<?php


class Auth_ApiController extends Zend_Controller_Action {
  
  public function demandesAction() {
    
    $em = $this->getRequest()->_em;
    
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender( true );
    
    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );
    
    $email = urldecode( $this->getRequest()->getPost( 'email' ) );
    
    $artisan = $em->getRepository( 'Auth_Model_Artisan' )->findOneBy( [ 'email_artisan' => $email ] );
    
    
    if ( ! $artisan ) {
      echo json_encode( [] );
    } else {
      $specialities = $em->getRepository( 'Auth_Model_Artisan' )->getSpecialities( $artisan->id_artisan );
      $demandes     = $em->getRepository( 'Auth_Model_Demandedevis' )->findAllBy( [
        'type'    => $specialities,
        'limit'   => 5,
        'online'  => 1,
        'artisan' => $artisan->id_artisan,
        'zone'    => $artisan->chantier->id_zone,
      ] );
      
      
      $resp = array_map( function ( $demande ) {
        
        return [
          'id'          => $demande->getId_demande(),
          'titre'       => $demande->getTitre_demande(),
          'libelle'     => "$demande->titre_demande {$demande->getRef()}",
          'type'        => ucfirst( strtolower( $demande->getId_activite()->getLibelle() ) ),
          'prix'        => $demande->getPrix_mise_en_ligne(),
          'ref'         => $demande->getRef(),
          'ville'       => $demande->getId_chantier()->getZone()->getVille(),
          'code_postal' => $demande->getId_chantier()->getZone()->getCode(),
        
        ];
        
      }, $demandes );
      
      echo json_encode( $resp );
    }
  }
  
  
  public function demandeAction() {
    
    $em = $this->getRequest()->_em;
    
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender( true );
    
    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );
    
    $id = $this->getRequest()->getParam( 'id' );
    if ( ! $id ) {
      echo json_encode( [] );
      
      return;
    }
    
    $demande = $em->getRepository( 'Auth_Model_Demandedevis' )->find( $id );
    
    if ( ! $demande ) {
      echo json_encode( [] );
    } else {
      echo json_encode( [
        'id'                  => $demande->id_demande,
        'titre'               => $demande->titre_demande,
        'ref'                 => $demande->getRef(),
        'libelle'             => "$demande->titre_demande {$demande->getRef()}",
        'prix'                => $demande->getPrix_mise_en_ligne(),
        'ville'               => $demande->getId_chantier()->getZone()->getVille(),
        'code_postal'         => $demande->getId_chantier()->getZone()->getCode(),
        'type_demandeur'      => $demande->getType_demandeur(),
        'type_propriete'      => $demande->getType_propriete(),
        'type_batiment'       => $demande->getType_batiment(),
        'delai_souhaite'      => $demande->getDelai_souhaite(),
        'budget_approximatif' => $demande->getBudget_approximatif(),
        'financement_projet'  => $demande->getFinancement_projet(),
        'objectif_demande'    => $demande->getObjectif_demande(),
        'description'         => $demande->getDescription(),
      ] );
    }
  }
  
  public function chekoutAction() {
    
    $em = $this->getRequest()->_em;
    
    $this->_helper->layout()->disableLayout();
    $this->_helper->viewRenderer->setNoRender( true );
    
    $this->getResponse()->setHeader( 'Content-Type', 'application/json' );
    
    $id = $this->getRequest()->getParam( 'id' );
    if ( ! $id ) {
      echo json_encode( [] );
      
      return;
    }
    
    $email = $this->getRequest()->getParam( 'email' );
    
    $artisan = $em->getRepository( 'Auth_Model_Artisan' )->findOneBy( [ 'email_artisan' => $email ] );
    
    $demande = $em->getRepository( 'Auth_Model_Demandedevis' )->find( $id );
    
    if ( ! $demande ) {
      echo json_encode( [] );
    } else {
      echo json_encode( [
        'id'                 => $demande->id_demande,
        'titre'              => $demande->titre_demande,
        'ref'                => $demande->getRef(),
        'libelle'            => "$demande->titre_demande {$demande->getRef()}",
        'nom_artisan'        => $artisan->getNom_artisan(),
        'prenom_artisan'     => $artisan->getPrenom_artisan(),
        'email_artisan'      => $artisan->getEmail_artisan(),
        'raison_sociale'     => $artisan->getRaison_sociale(),
        'telephone_portable' => $artisan->getTelephone_portable(),
        'adresse'            => $artisan->getChantier()->getAdresse(),
        'prix'               => $demande->getPrix_mise_en_ligne(),
        'tva'                => ( (float) $demande->getPrix_mise_en_ligne() ) * 0.2,
        'prixttc'            => ( (float) $demande->getPrix_mise_en_ligne() ) * 1.2,
      ] );
    }
  }
  
  public function updateAction() {
    
    $em = $this->getRequest()->_em;
    
    $this->_helper->layout()->disableLayout();
    
    $this->_helper->viewRenderer->setNoRender( true );
    
    $id = $this->getRequest()->getParam( 'id' );
    
    $email = $this->getRequest()->getParam( 'email' );
    
    $artisan = $em->getRepository( 'Auth_Model_Artisan' )->findOneBy( [ 'email_artisan' => $email ] );
    
    $demande = $em->getRepository( 'Auth_Model_Demandedevis' )->find( $id );
    
    $em->getRepository( 'Auth_Model_Acheter' )->saveAchat( $artisan, $demande, 'CARTE BANCAIRE' );
    
    $vendu = $demande->getVendu();
    
    $vendu += 1;
    
    $em->getRepository( 'Auth_Model_Demandedevis' )->saveVendu( $id, $vendu );
    
    //Envoi des emails
    
  }
}