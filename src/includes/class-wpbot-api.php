<?php

namespace WPBot\WordPress;

class WPBot_API {

	private $namespace = 'wpbot/v1';

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'rest_api_init' ) );
	}

	public function rest_api_init() {
		register_rest_route(
			$this->namespace,
			'/commands',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_commands' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	public function get_commands() {
		$response = array();

		$commands = get_posts( array(
			'numberposts' => -1,
			'post_type'   => 'wpbot_commands',
		) );

		foreach ( $commands as $command ) {
			$meta = get_post_meta( $command->ID, '_wpbot_command', true );

			if ( ! isset( $meta['trigger'] ) || empty( $meta['trigger'] ) ) {
				continue;
			}
			if ( ! isset( $meta['response'] ) || empty( $meta['response'] ) ) {
				continue;
			}

			$response[] = array(
				'id'       => $command->ID,
				'command'  => $meta['trigger'],
				'response' => $meta['response'],
			);
		}

		return $response;
	}
}

new WPBot_API();
