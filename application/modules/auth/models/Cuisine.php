<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @Table(name="qualif_cuisine")
 * @Entity(repositoryClass="Auth_Model_CuisineRepository")
 */
class Auth_Model_Cuisine
{
    /**
     * @var integer $id_qualif_cuisine
     *
     * @Column(name="ID_QUALIF_CUISINE", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id_qualif_cuisine;

    /**
     * @var string $depose_ancienne_cuisine
     *
     * @Column(name="DEPOSE_ANCIENNE_CUISINE", type="string", length=50, nullable=false)
     */
    private $depose_ancienne_cuisine;
	
	/**
     * @var string $hauteur_sous_plafond
     *
     * @Column(name="HAUTEUR_SOUS_PLAFOND", type="string", length=50, nullable=false)
     */
    private $hauteur_sous_plafond;
	
	/**
     * @var string $niveau_gamme
     *
     * @Column(name="NIVEAU_GAMME", type="string", length=50, nullable=false)
     */
    private $niveau_gamme;
	
	/**
     * @var string $futur_style
     *
     * @Column(name="FUTUR_STYLE", type="string", length=50, nullable=false)
     */
    private $futur_style;


    /**
     * @var string $surface_au_sol
     *
     * @Column(name="SURFACE_AU_SOL", type="string", length=200, nullable=false)
     */
    private $surface_au_sol;
	
	/**
     * @var string $travaux_plomberie
     *
     * @Column(name="TRAVAUX_PLOMBERIE", type="string", length=200, nullable=false)
     */
    private $travaux_plomberie;
	
	/**
     * @var string $travaux_peinture
     *
     * @Column(name="TRAVAUX_PEINTURE", type="string", length=200, nullable=false)
     */
    private $travaux_peinture;
	
	/**
     * @var string $travaux_revetement
     *
     * @Column(name="TRAVAUX_REVETEMENT", type="string", length=200, nullable=false)
     */
    private $travaux_revetement;
	
	/**
     * @var string $travaux_electricite
     *
     * @Column(name="TRAVAUX_ELECTRICITE", type="string", length=200, nullable=false)
     */
    private $travaux_electricite;
	
	/**
     * @var string $equipement
     *
     * @Column(name="EQUIPEMENT", type="string", length=200, nullable=false)
     */
    private $equipement;
	
	/**
     * @var string $type_travaux
     *
     * @Column(name="TYPE_TRAVAUX", type="string", length=200, nullable=false)
     */
    private $type_travaux;

    /**
     * @var Demandedevis
     *
     * @ManyToOne(targetEntity="Auth_Model_Demandedevis")
     * @JoinColumns({
     *   @JoinColumn(name="ID_DEMANDE", referencedColumnName="ID_DEMANDE")
     * })
     */
    private $id_demande;
    
    
	 /**
	 * @return the attribute
	 */
    public function __set($attr, $val)
    {
    	$this->$attr = $val;
    }
    
    /**
	 * @param the attribute
	 */
    public function __get($attr)
    {
    	return $this->$attr;
    }
        
    /**
	 * @return toArray
	 */
 	public function toArray() {
        return get_object_vars($this);
    }
    
	/**
	 * @return the $id_qualif_cuisine
	 */
	public function getId_qualif_cuisine() {
		return $this->id_qualif_cuisine;
	}

	/**
	 * @return the $depose_ancienne_cuisine
	 */
	public function getDepose_ancienne_cuisine() {
		return $this->depose_ancienne_cuisine;
	}
	
	/**
	 * @return the $hauteur_sous_plafond
	 */
	public function getHauteur_sous_plafond() {
		return $this->hauteur_sous_plafond;
	}
	
	/**
	 * @return the $niveau_gamme
	 */
	public function getNiveau_gamme() {
		return $this->niveau_gamme;
	}
	
	/**
	 * @return the $futur_style
	 */
	public function getFutur_style() {
		return $this->futur_style;
	}
	
	/**
	 * @return the $surface_au_sol
	 */
	public function getSurface_au_sol() {
		return $this->surface_au_sol;
	}
	
	/**
	 * @return the $travaux_plomberie
	 */
	public function getTravaux_plomberie() {
		return $this->travaux_plomberie;
	}
	
	/**
	 * @return the $travaux_peinture
	 */
	public function getTravaux_peinture() {
		return $this->travaux_peinture;
	}
	
	/**
	 * @return the $travaux_revetement
	 */
	public function getTravaux_revetement() {
		return $this->travaux_revetement;
	}
	
	/**
	 * @return the $travaux_electricite
	 */
	public function getTravaux_electricite() {
		return $this->travaux_electricite;
	}
	
	/**
	 * @return the $equipement
	 */
	public function getEquipement() {
		return $this->equipement;
	}
	
	/**
	 * @return the $type_travaux
	 */
	public function getType_travaux() {
		return $this->type_travaux;
	}

	/**
	 * @return the $id_demande
	 */
	public function getId_demande() {
		return $this->id_demande;
	}

	/**
	 * @param integer $id_qualif_cuisine
	 */
	public function setId_qualif_cuisine($id_qualif_cuisine) {
		$this->id_qualif_cuisine = $id_qualif_cuisine;
	}

	/**
	 * @param string $depose_ancienne_cuisine
	 */
	public function setDepose_ancienne_cuisine($depose_ancienne_cuisine) {
		$this->depose_ancienne_cuisine = $depose_ancienne_cuisine;
	}
	
	/**
	 * @param string $hauteur_sous_plafond
	 */
	public function setHauteur_sous_plafond($hauteur_sous_plafond) {
		$this->hauteur_sous_plafond = $hauteur_sous_plafond;
	}
	
	/**
	 * @param string $niveau_gamme
	 */
	public function setNiveau_gamme($niveau_gamme) {
		$this->niveau_gamme = $niveau_gamme;
	}
	
	/**
	 * @param string $futur_style
	 */
	public function setFutur_style($futur_style) {
		$this->futur_style = $futur_style;
	}
	
	/**
	 * @param string $surface_au_sol
	 */
	public function setSurface_au_sol($surface_au_sol) {
		$this->surface_au_sol = $surface_au_sol;
	}
	
	/**
	 * @param string $travaux_plomberie
	 */
	public function setTravaux_plomberie($travaux_plomberie) {
		$this->travaux_plomberie = $travaux_plomberie;
	}
	
	/**
	 * @param string $travaux_peinture
	 */
	public function setTravaux_peinture($travaux_peinture) {
		$this->travaux_peinture = $travaux_peinture;
	}
	
	/**
	 * @param string $travaux_revetement
	 */
	public function setTravaux_revetement($travaux_revetement) {
		$this->travaux_revetement = $travaux_revetement;
	}
	
	/**
	 * @param string $travaux_electricite
	 */
	public function setTravaux_electricite($travaux_electricite) {
		$this->travaux_electricite = $travaux_electricite;
	}
	
	/**
	 * @param string $equipement
	 */
	public function setEquipement($equipement) {
		$this->equipement = $equipement;
	}

	/**
	 * @param string $type_travaux
	 */
	public function setType_travaux($type_travaux) {
		$this->type_travaux = $type_travaux;
	}

	/**
	 * @param Demandedevis $id_demande
	 */
	public function setId_demande($id_demande) {
		$this->id_demande = $id_demande;
	}
	

}