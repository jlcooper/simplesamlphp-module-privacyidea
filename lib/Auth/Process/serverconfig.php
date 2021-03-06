<?php
/**
 * This authproc filter reads the configuration for the privacyidea server.
 * @author Micha Preußer <micha.preusser@netknights.it>
 */

class sspmod_privacyidea_Auth_Process_serverconfig extends SimpleSAML_Auth_ProcessingFilter {

	/**
	 * This contains the server configuration
	 * @var array
	 */
	private $serverconfig;

	public function __construct( array $config, $reserved ) {

		parent::__construct( $config, $reserved );
		$cfg = SimpleSAML_Configuration::loadFromArray($config, 'privacyidea:serverconfig');
		$this->serverconfig['privacyideaserver'] = $cfg->getString('privacyideaserver', '');
		$this->serverconfig['sslverifyhost'] = $cfg->getBoolean('sslverifyhost', true);
		$this->serverconfig['sslverifypeer'] = $cfg->getBoolean('sslverifypeer', true);
		$this->serverconfig['realm'] = $cfg->getString('realm', '');
		$this->serverconfig['uidKey'] = $cfg->getString('uidKey', 'uid');
		$this->serverconfig['enabledPath'] = $cfg->getString('enabledPath', 'privacyIDEA');
		$this->serverconfig['enabledKey'] = $cfg->getString('enabledKey', 'enabled');
		$this->serverconfig['serviceAccount'] = $cfg->getString('serviceAccount', '');
		$this->serverconfig['servicePass'] = $cfg->getString('servicePass', '');
		$this->serverconfig['doTriggerChallenge'] = $cfg->getBoolean('doTriggerChallenge', false);

	}

	public function process( &$state ) {

		foreach ( $this->serverconfig as $key => $value) {
			$state['privacyidea:serverconfig'][$key] = $value;
		}
	}
}