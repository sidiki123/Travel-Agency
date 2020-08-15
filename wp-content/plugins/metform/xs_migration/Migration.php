<?php

namespace MetForm\XsMigration;


class Migration extends DataMigration {


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_4_to_1_1_5($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_5_to_1_1_6($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_6_to_1_1_7($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_7_to_1_1_8($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_8_to_1_1_9($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_1_9_to_1_2_0($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];

		return [
			'status' => 'success',
			'log' => $log,
		];
	}


	/**
	 *
	 * @param $wpOptionKey
	 * @param $executionPlanKey
	 * @param $existingOption
	 *
	 * @return array
	 */
	public function convert_from_1_2_0_to_1_2_1($wpOptionKey, $executionPlanKey, $existingOption) {

		$log = $existingOption['execution_plan'][$executionPlanKey]['log'];


		$checkList = $existingOption['execution_plan'][$executionPlanKey]['progress'][__FUNCTION__]['check_list'];
		$weightLifted = 0; #this value will be the programmers intuition, our goal is to not to give work more than 10 seconds

		if(empty($checkList)) {

			$checkList['option_updated'] = false;
			$checkList['form_data_processed'] = false;

			$existingOption['execution_plan'][$executionPlanKey]['progress'][__FUNCTION__]['check_list'] = $checkList;
		}


		if($checkList['option_updated'] === false) {

			$opt = $this->prepareOption_1_2_0_to_1_2_1();

			if(!empty($opt)) {

				foreach($opt as $opKey => $opVal) {

					//update_option($opKey, $opVal);
				}
			}

			$weightLifted += 30;    # AR: feeling it may take 3 seconds to return the result so putting 3*10 = 30;

			$checkList['option_updated'] = true;

			$existingOption['execution_plan'][$executionPlanKey]['progress'][__FUNCTION__]['check_list'] = $checkList;
		}


		global $wpdb;

		$postTypes = 'metform-form';
		
		
		return [
			'status' => 'success',
			'log' => $log,
		];
	}



	
	
	private function prepareOption_1_2_0_to_1_2_1() {

		global $wpdb;

		$postTypes = 'metform-form';

		#read all forms and acquire the settings
		$postIds = get_posts(
			array(
				'post_type'     => $postTypes,
				'numberposts'   => -1,      // get all posts.
				'fields'        => 'ids',   // Only get post IDs
			)
		);

		#Retrieving post meta...................
		$qry = 'SELECT * FROM `'.$wpdb->postmeta.'` WHERE `meta_key`="metform_form__form_setting" AND `post_id` IN ('.implode(',', $postIds).') ;';

		$rows = $wpdb->get_results($qry, ARRAY_A);

		$newStructureOptions = [
			'metform_option__settings' => [
				'mf_recaptcha_version' => '',
				'mf_recaptcha_site_key' => '',
				'mf_recaptcha_secret_key' => '',
				'mf_recaptcha_site_key_v3' => '',
				'mf_recaptcha_secret_key_v3' => '',
				'mf_mailchimp_api_key' => '',
			],
		];

		foreach($rows as $row) {

			if(!empty($row['mf_recaptcha_site_key'])) {

				$newStructureOptions['metform_option__settings']['mf_recaptcha_site_key'] = $row['mf_recaptcha_site_key'];
				$newStructureOptions['metform_option__settings']['mf_recaptcha_secret_key'] = $row['mf_recaptcha_secret_key'];
				$newStructureOptions['metform_option__settings']['mf_recaptcha_version'] = 'recaptcha-v2';
			}

			if(!empty($row['mf_mailchimp_api_key'])) {

				$newStructureOptions['metform_option__settings']['mf_mailchimp_api_key'] = $row['mf_mailchimp_api_key'];
			}
		}


		return [
			'option' => $newStructureOptions,
		];

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/**
	 *
	 * @return array
	 */
	public function convert_1_1_9_to_1_2_0() {

		global $wpdb;

		$postTypes = 'metform-form';

		#read all forms and acquire the settings
		$postIds = get_posts(
			array(
				'post_type'     => $postTypes,
				'numberposts'   => -1,      // get all posts.
				'fields'        => 'ids',   // Only get post IDs
			)
		);

		#Retrieving post meta...................
		$qry = 'SELECT * FROM `'.$wpdb->postmeta.'` WHERE `meta_key`="metform_form__form_setting" AND `post_id` IN ('.implode(',', $postIds).') ;';

		$rows = $wpdb->get_results($qry, ARRAY_A);

		$newStructureOptions = [
			'metform_option__settings' => [
				'mf_recaptcha_version' => '',
				'mf_recaptcha_site_key' => '',
				'mf_recaptcha_secret_key' => '',
				'mf_recaptcha_site_key_v3' => '',
				'mf_recaptcha_secret_key_v3' => '',
				'mf_mailchimp_api_key' => '',
			],
		];

		foreach($rows as $row) {

			if(!empty($row['mf_recaptcha_site_key'])) {

				$newStructureOptions['metform_option__settings']['mf_recaptcha_site_key'] = $row['mf_recaptcha_site_key'];
				$newStructureOptions['metform_option__settings']['mf_recaptcha_secret_key'] = $row['mf_recaptcha_secret_key'];
				$newStructureOptions['metform_option__settings']['mf_recaptcha_version'] = 'recaptcha-v2';
			}

			if(!empty($row['mf_mailchimp_api_key'])) {

				$newStructureOptions['metform_option__settings']['mf_mailchimp_api_key'] = $row['mf_mailchimp_api_key'];
			}
		}


		return [
			'option' => $newStructureOptions,
		];
	}
}