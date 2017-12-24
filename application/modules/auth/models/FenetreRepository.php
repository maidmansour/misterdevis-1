<?php


use Doctrine\ORM\EntityRepository;


/**
 * Class Auth_Model_FenetreRepository
 *
 * @author  Youssef Erratbi <yerratbi@gmail.com>
 * @date    23/12/17
 */
class Auth_Model_FenetreRepository extends EntityRepository {

  public function getList() {

    $qb = $this->_em->createQueryBuilder();

    return $qb->from($this->_entityName, 'ch')
      ->select('d.id_demande, d.titre_demande, d.publier_en_ligne, p.nom_particulier, p.prenom_particulier,' .
        'd.date_creation, d.date_publication, c.ville, c.adresse, c.code_postal, u.firstname_user, u.lastname_user,' .
        'a.libelle as categorie, d.prix_mise_en_ligne')
      ->leftJoin('ch.id_demande', 'd')
      ->leftJoin('d.id_particulier', 'p')
      ->leftJoin('d.id_chantier', 'c')
      ->leftJoin('d.id_user', 'u')
      ->leftJoin('d.id_activite', 'a')
      ->where('d.titre_demande IS NOT NULL and d.titre_demande != \'\'')
      ->orderBy('d.date_creation', 'DESC')
      ->getQuery()
      ->getResult();
  }


  public function getNotifications($justCount = false) {

    $select = $justCount
      ? 'count(d.id_demande)'
      : 'd.id_demande,p.nom_particulier,p.prenom_particulier,d.date_creation';

    $query = $this->_em->createQueryBuilder()
      ->from('Auth_Model_Demandedevis', 'd')
      ->select($select)
      ->leftJoin('d.id_particulier', 'p')
      ->leftJoin('d.id_activite', 'a')
      ->where('a.libelle = :activite')
      ->andWhere('(d.titre_demande IS NULL or d.titre_demande = \'\')')
      ->setParameter('activite', 'FENETRE')
      ->orderBy('d.date_creation', 'DESC')
      ->getQuery();

    return $justCount ? $query->getSingleScalarResult() : $query->getResult();

  }


  public function save($id_demande, $data) {

    // Grabing the demande and returning if there is not


    $demande = $this->_em->getRepository('Auth_Model_Demandedevis')->find($id_demande);
    if (!$demande) return false;

    // Populating the demande user
    $user = $this->_em->getRepository('Auth_Model_User')->find($data['ID_USER']);
    $demande->setId_user($user);

    // Creating a fresh qualification if there isn't any
    $qualification = $this->_em->getRepository($this->_entityName)->findOneBy(['id_demande' => $id_demande]);
    if (!$qualification) $qualification = new Auth_Model_Fenetre();

    $qualification->setType_fenetre($data['TYPE_FENETRE']);
    $qualification->setDepose_fenetre_existant($data['DEPOSE_FENETRE_EXISTANT']);
    $qualification->setNbre_fenetre($data['NBRE_FENETRE']);
    $qualification->setType_travaux($data['TYPE_TRAVAUX']);


    // Demande data update

    $demande->setTitre_demande($data['TITRE_DEMANDE']);
    $demande->setDelai_souhaite($data['DELAI_SOUHAITE']);
    $demande->setDescription($data['DESCRIPTION']);
    $demande->setType_demandeur($data['TYPE_DEMANDEUR']);
    $demande->setType_propriete($data['TYPE_PROPRIETE']);
    $demande->setType_batiment($data['TYPE_BATIMENT']);
    $demande->setBudget_approximatif($data['BUDGET_APPROXIMATIF']);
    $demande->setFinancement_projet($data['FINANCEMENT_PROJET']);
    $demande->setObjectif_demande($data['OBJECTIF_DEMANDE']);
    $demande->setPrestation_souhaite($data['PRESTATION_SOUHAITE']);
    $demande->setIndication_complementaire($data['INDICATION_COMPLEMENTAIRE']);
    $demande->setQualification($data['QUALIFICATION']);
    $demande->setPrix_mise_en_ligne($data['PRIX_MISE_EN_LIGNE']);
    $demande->setPrix_promo($data['PRIX_PROMO']);
    $demande->setPublier_en_ligne($data['PUBLIER_EN_LIGNE']);
    $demande->setDate_publication(date('Y-m-d H:i:s'));


    // Particulier data update

    $demande->getId_particulier()->setCivilite($data['CIVILITE']);
    $demande->getId_particulier()->setPrenom_particulier($data['PRENOM_PARTICULIER']);
    $demande->getId_particulier()->setNom_particulier($data['NOM_PARTICULIER']);
    $demande->getId_particulier()->setTelephone_portable($data['TELEPHONE_PORTABLE']);
    $demande->getId_particulier()->setTelephone_fixe($data['TELEPHONE_FIXE']);
    $demande->getId_particulier()->setHorairerdv($data['HORAIRERDV']);
    $demande->getId_particulier()->setEmail($data['EMAIL']);

    // Chantier data update
    $zone = $this->_em->getRepository('Auth_Model_Zone')->find($data['ID_ZONE']);

    $chantier = $demande->getId_Chantier();
    if (!$chantier) $chantier = new Auth_Model_Chantier();

    $chantier->setVille($data['VILLE']);
    $chantier->setAdresse($data['ADRESSE']);
    $chantier->setAdresse2($data['ADRESSE2']);
    $chantier->setCode_postal($data['CODE_POSTAL']);
    $chantier->setId_Zone($zone);


    $this->_em->persist($chantier);
    $this->_em->flush();

    $demande->setId_chantier($chantier);


    // Attaching the qualification to the demande
    $qualification->setId_demande($demande);


    $this->_em->persist($qualification);
    $this->_em->flush();

    return true;
  }

}
