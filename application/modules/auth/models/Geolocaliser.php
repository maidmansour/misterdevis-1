<?php

/**
 * Geolocaliser
 *
 * @Table(name="geolocaliser")
 * @Entity(repositoryClass="Auth_Model_GeolocaliserRepository")
 */
class Auth_Model_Geolocaliser
{
    /**
     * @var integer $id_artisan
     *
     * @Column(name="ID_ARTISAN", type="integer", nullable=false)
     * @Id
     */
    private $id_artisan;

    /**
     * @var integer $id_zone
     *
     * @Column(name="ID_ZONE", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="NONE")
     */
    private $id_zone;
    
    /**
     * @var entity Artisan
     *
     * @ManyToOne(targetEntity="Auth_Model_Artisan")
     * @JoinColumns({
     *   @JoinColumn(name="ID_ARTISAN", referencedColumnName="ID_ARTISAN")
     * })
     */
    private $artisan;
    
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
	 * @return the $id_artisan
	 */
	public function getId_artisan() {
		return $this->id_artisan;
	}

	/**
	 * @return the $id_zone
	 */
	public function getId_zone() {
		return $this->id_zone;
	}

	/**
	 * @param integer $id_artisan
	 */
	public function setId_artisan($id_artisan) {
		$this->id_artisan = $id_artisan;
	}

	/**
	 * @param integer $id_zone
	 */
	public function setId_zone($id_zone) {
		$this->id_zone = $id_zone;
	}



}