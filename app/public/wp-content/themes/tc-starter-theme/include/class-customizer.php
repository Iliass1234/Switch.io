<?php

add_action( 'customize_register', [ 'tcCustomizer', 'init' ] ); // Pannellello personalizzazione

class tcCustomizer
{
	const PANEL = 'tc-customizer';

	protected static $instance = null;

	protected $customizer;

	/**
	 * tcCustomizer constructor.
	 *
	 * @param $customizer
	 */
	public function __construct( $customizer )
	{
		$this->customizer = $customizer;
		$this->aggiungi_sezioni();
	}

	/**
	 *
	 */
	public function aggiungi_sezioni()
	{
		$this->customizer->add_panel( self::PANEL, [
			'title'      => __( 'Impostazioni tema', 'tc-starter-theme' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options'
		] );

		$this->contatti();
		$this->social();
		$this->logo();
	}

	public function contatti()
	{
		$section = 'contatti';

		$this->customizer->add_section( $section, [
			'title'       => __( 'Contatti', 'tc-starter-theme' ),
			'description' => __( 'Permette l\'inserimento rapido delle informazioni di contatto.', 'tc-starter-theme' ),
			'panel'       => self::PANEL
		] );

		$this->customizer->add_setting( 'nome_sito' );
 		$this->customizer->add_setting( 'indirizzo' );
		$this->customizer->add_setting( 'citta' );
		$this->customizer->add_setting( 'provincia' );
		$this->customizer->add_setting( 'cap' );
		$this->customizer->add_setting( 'telefono' );
		$this->customizer->add_setting( 'fax' );
		$this->customizer->add_setting( 'mail' );
		$this->customizer->add_setting( 'mail_noreply' );
		$this->customizer->add_setting( 'iva' );

        $this->customizer->add_control( 'nome_sito', [
            'label'   => 'Nome Sito',
            'section' => $section,
            'type'    => 'text'
        ] );

		$this->customizer->add_control( 'indirizzo', [
			'label'   => 'Indirizzo',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'citta', [
			'label'   => 'Citt&agrave;',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'provincia', [
			'label'       => 'Provincia',
			'description' => 'Inserire sigla.',
			'section'     => $section,
			'type'        => 'text'
		] );

		$this->customizer->add_control( 'cap', [
			'label'   => 'CAP',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'telefono', [
			'label'   => 'Numero di telefono',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'fax', [
			'label'   => 'Fax',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'mail', [
			'label'   => 'Email',
			'section' => $section,
			'type'    => 'text'
		] );
		$this->customizer->add_control( 'mail_noreply', [
			'label'   => 'Email No-reply',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'iva', [
			'label'   => 'Partita IVA',
			'section' => $section,
			'type'    => 'text'
		] );



	}

	/**
	 *
	 */
	public function social()
	{
		$section = 'social';

		$this->customizer->add_section( $section, array(
			'title'       => 'Social',
			'description' => 'Permette di inserire semplicemente gli url dei social più utilizzati',
			'panel'       => self::PANEL
		) );

		$this->customizer->add_setting( 'facebook' );
		$this->customizer->add_setting( 'instagram' );

		$this->customizer->add_control( 'facebook', [
			'label'   => 'Facebook',
			'section' => $section,
			'type'    => 'text'
		] );

		$this->customizer->add_control( 'instagram', [
			'label'   => 'Instagram',
			'section' => $section,
			'type'    => 'text'
		] );




	}

    public function logo()
    {

        $section = 'logo';

        $this->customizer->add_section( $section, array(
            'title'       => 'Logo',
            'description' => "Impostazioni logo",
            'panel'       => self::PANEL
        ) );


        $this->customizer->add_setting( 'main_logo' );
        $this->customizer->add_control( new WP_Customize_Upload_Control( $this->customizer, 'main_logo', array(
            'label'    => __( 'Logo ' ),
            'section'  => $section,
            'settings' => 'main_logo',
        ) ) );

        $this->customizer->add_setting( 'negative_logo' );
        $this->customizer->add_control( new WP_Customize_Upload_Control( $this->customizer, 'negative_logo', array(
            'label'    => __( 'Logo Negativo ' ),
            'section'  => $section,
            'settings' => 'negative_logo',
        ) ) );

    }

	/**
	 * @param WP_Customize_Manager $customizer
	 *
	 * @return null
	 */
	public static function init( WP_Customize_Manager $customizer )
	{
		if ( is_null( static::$instance ) ) {
			static::$instance = new static ( $customizer );
		}

		return static::$instance;
	}
}

function sanitize_dropdown_pages($page_id, $setting)
{
    // Ensure $input is an absolute integer.
    $page_id = absint($page_id);

    // If $page_id is an ID of a published page, return it; otherwise, return the default.
    return ('publish' == get_post_status($page_id) ? $page_id : $setting->default);
}
