<?php
/**
 * Custom Fields and Taxonomies
 *
 * Auto create custom fields and taxonomies
 *
 * @package RoloPress
 */


//TODO - We should make the contact_fields array plugable.
//TODO - The meta key name should be added to the contact_fields array.
$contact_fields =
array
(
    // Novos campos
    "first_name" =>
    array
    (
    'name' => 'first_name',
    'class' => 'first_name',
    'filter' => "rolo_contact_first_name",
    'default_value' => '',
    'title' => __('First Name','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => true
    ),
    "last_name"=>
    array
    (
    'name' => 'last_name',
    'class' => 'last_name',
    'filter' => "rolo_contact_last_name",
    'default_value' => '',
    'title' => __('Last Name','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => true
    ),
    'workplace' =>
    array
    (
    'name' => 'workplace',
    'class' => 'workplace',
    'filter' => "rolo_workplace",
    'default_value' => '',
    'title' => __('Workplace','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    'city' =>
    array
    (
    'name' => 'city',
    'class' => 'city',
    'filter' => "rolo_city",
    'default_value' => '',
    'title' => __('City','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    'title' =>
    array
    (
    'name' => 'title',
    'class' => 'title',
    'filter' => "rolo_contact_title",
    'default_value' => '',
    'title' => __('Title','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    "company" =>
    array
    (
    'name' => 'company',
    'class' => 'company',
    'filter' => "rolo_contact_company",
    'default_value' => '',
    'title' => __('Company','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_contact_company',
    'save_function' => 'rolo_save_contact_company',
    'mandatory' => false
    ),
    "email" =>
    array
    (
    'name' => 'email',
    'class' => 'email',
    'filter' => "rolo_contact_email",
    'default_value' => '',
    'title' => __('Email','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    "phone" =>
    array
    (
    'multiple' => array (__('Home','rolopress'), __('Mobile','rolopress'), __('Work','rolopress'), __('Fax','rolopress'), __('Other','rolopress'),),
    'name' => 'phone',
    'class' => 'phone',
    'filter' => "rolo_contact_phone_",
    'default_value' => '',
    'title' => __('Phone','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_contact_multiple',
    'save_function' => 'rolo_save_contact_multiple',
    'mandatory' => false
    ),
    "website" =>
    array
    (
    'name' => 'website',
    'class' => 'website',
    'filter' => "rolo_contact_website",
    'default_value' => "",
    'title' => __('Website','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
	'prefix' => 'http://',
    'mandatory' => false
    ),
    'im' =>
    array
    (
    'multiple' => array (__('Yahoo','rolopress'), __('MSN','rolopress'), __('AOL','rolopress'), __('Gtalk','rolopress'), __('Skype','rolopress'),),
    'name' => 'im',
    'class' => 'im',
    'filter' => "rolo_contact_IM_",
    'default_value' => '',
    'title' => __('IM','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_contact_multiple',
    'save_function' => 'rolo_save_contact_multiple',
    'mandatory' => false
    ),
    'twitter' =>
    array
    (
    'name' => 'twitter',
    'class' => 'twitter',
    'filter' => "rolo_contact_twitter",
    'default_value' => "",
    'title' => __('Twitter','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
	'prefix' => 'http://twitter.com/',
    'mandatory' => false
    ),
    "address" =>
    array
    (
    'name' => 'address',
    'class' => 'address',
    'filter' => "rolo_contact_address",
    'default_value' => '',
    'title' => __('Address','rolopress'),
    'description' => '',
    "setup_function" => 'rolo_setup_contact_address',
    'save_function' => 'rolo_save_contact_address',
    'mandatory' => false
    ),
    "contact_method" =>
    array
    (
    'name' => 'contact_method',
    'class' => 'contact_method',
    'filter' => "rolo_contact_method",
    'default_value' => '',
    'title' => __('Contact Method','rolopress'),
    'description' => '',
    "setup_function" => 'rolo_setup_contact_method',
    'save_function' => 'rolo_save_contact_method',
    'mandatory' => false
    ),
    'modification_date' =>
    array
    (
    'name' => 'modification_date',
    'class' => 'modification_date',
    'filter' => "rolo_modification_date",
    'default_value' => '',
    'title' => __('Modification Date','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    'party' =>
    array
    (
    'name' => 'party',
    'class' => 'party',
    'filter' => "rolo_party",
    'default_value' => '',
    'title' => __('Party Afiliation','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    'info' =>
    array
    (
    'name' => 'info',
    'class' => 'info',
    'filter' => "rolo_contact_info",
    'default_value' => '',
    'title' => __('Background Info','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_contact_info',
    'save_function' => 'rolo_save_contact_info',
    'mandatory' => false
    ),
    "tags" =>
    array
    (
    'name' => 'post_tag',
    'class' => 'tags',
    'filter' => "rolo_contact_post_tag",
    'default_value' => '',
    'title' => __('Tags','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_contact_post_tags',
    'save_function' => '',
    'mandatory' => false
    )
);

$company_fields =
array
(
    'name' =>
    array
    (
    'name' => 'name',
    'class' => 'name',
    'filter' => "rolo_company_name",
    'default_value' => '',
    'title' => __('Company Name','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => true
    ),
    'year' =>
    array
    (
    'name' => 'year',
    'class' => 'year',
    'filter' => "rolo_company_year",
    'default_value' => '',
    'title' => __('Foundation Year','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => true
    ),
    'legal_status' =>
    array
    (
    'name' => 'legal_status',
    'class' => 'legal_status',
    'filter' => "rolo_company_legal_status",
    'default_value' => '',
    'title' => __('Legal Status','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => true
    ),
    "email" =>
    array
    (
    'name' => 'email',
    'class' => 'email',
    'filter' => "rolo_company_email",
    'default_value' => '',
    'title' => __('Email','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    "phone" =>
    array
    (
    'multiple' => array ( __('Work','rolopress'), __('Mobile','rolopress'), __('Fax','rolopress'), __('Other','rolopress'),),
    'name' => 'phone',
    'class' => 'phone',
    'filter' => "rolo_company_phone_",
    'default_value' => '',
    'title' => __('Phone','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'mandatory' => false
    ),
    "website" =>
    array
    (
    'name' => 'website',
    'class' => 'website',
    'filter' => "rolo_company_website",
    'default_value' => "",
    'title' => __('Website','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
	'prefix' => 'http://',
    'mandatory' => false
    ),
    'im' =>
    array
    (
    'multiple' => array (__('Yahoo','rolopress'), __('MSN','rolopress'), __('AOL','rolopress'), __('Gtalk','rolopress'), __('Skype','rolopress'),),
    'name' => 'im',
    'class' => 'im',
    'filter' => "rolo_company_IM_",
    'default_value' => '',
    'title' => "IM",
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'mandatory' => false
    ),
    'twitter' =>
    array
    (
    'name' => 'twitter',
    'class' => 'twitter',
    'filter' => "rolo_company_twitter",
    'default_value' => "",
    'title' => __('Twitter','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
	'prefix' => 'http://twitter.com/',
    'mandatory' => false
    ),
    "address" =>
    array
    (
    'name' => 'address',
    'class' => 'address',
    'filter' => "rolo_company_address",
    'default_value' => '',
    'title' => __('Address','rolopress'),
    'description' => '',
    "setup_function" => 'rolo_setup_company_address',
    'save_function' => 'rolo_save_company_address',
    'mandatory' => false
    ),
    "source" =>
    array
    (
    'name' => 'source',
    'class' => 'source',
    'filter' => "rolo_company_info_source",
    'default_value' => '',
    'title' => __('Information Source','rolopress'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    'info' =>
    array
    (
    'name' => 'info',
    'class' => 'info',
    'filter' => "rolo_company_info",
    'default_value' => '',
    'title' => __('Background Info','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_info',
    'save_function' => 'rolo_save_company_info',
    'mandatory' => false
    ),
    "tags" =>
    array
    (
    'name' => 'post_tag',
    'class' => 'tags',
    'filter' => "rolo_company_post_tag",
    'default_value' => '',
    'title' => __('Tags','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_post_tags',
    'save_function' => '',
    'mandatory' => false
    ),
    'popular_movements' =>
    array
    (
    'multiple' => array (__('Popular Movements','rolopress'), __('Indigenous People','rolopress'), __('Fishermen','rolopress'), __('Quilombolas','rolopress'), __('Cooperative of paper collectors','rolopress'), __('Others','rolopress'),),
    'name' => 'popular_movements',
    'class' => 'popular_movements',
    'filter' => "rolo_popular_movements",
    'default_value' => '',
    'title' => __('Popular Movements','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'workers_represented' =>
    array
    (
    'multiple' => array (__('Others','rolopress')),
    'name' => 'workers_represented',
    'class' => 'workers_represented',
    'filter' => "rolo_workers_represented",
    'default_value' => '',
    'title' => __('Workers Represented','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'public_sector' =>
    array
    (
    'multiple' => array (__('Legislative - City','rolopress'), __('Legislative - Federal','rolopress'), __('Executive - City','rolopress'), __('Executive - State','rolopress'), __('Executive - Federal','rolopress'), __('MP State','rolopress'), __('MP Federal','rolopress'), __('Defensoria','rolopress'), __('Autarquia','rolopress'), __('Public Foundations','rolopress'), __('Others','rolopress'),),
    'name' => 'public_sector',
    'class' => 'public_sector',
    'filter' => "rolo_public_sector",
    'default_value' => '',
    'title' => __('Public Sector','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'entities' =>
    array
    (
    'multiple' => array (__('Others','rolopress')),
    'name' => 'entities',
    'class' => 'entities',
    'filter' => "rolo_entities",
    'default_value' => '',
    'title' => __('Professional, Academic and Research Entities','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'ngos' =>
    array
    (
    'multiple' => array (__('Urban Development','rolopress'), __('Environment','rolopress'), __('Education','rolopress'), __('Others','rolopress')),
    'name' => 'ngos',
    'class' => 'ngos',
    'filter' => "rolo_ngos",
    'default_value' => '',
    'title' => __('Non-governmental organizations','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'businessmen' =>
    array
    (
    'multiple' => array (__('Private Company','rolopress'), __('Cooperative and Fair Trade','rolopress'), __('Public','rolopress'), __('Others','rolopress')),
    'name' => 'businessmen',
    'class' => 'businessmen',
    'filter' => "rolo_businessmen",
    'default_value' => '',
    'title' => __('Businessmen','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'checkbox',
    'mandatory' => false
    ),
    'others' =>
    array
    (
    'name' => 'others',
    'class' => 'others',
    'filter' => "rolo_others",
    'default_value' => '',
    'title' => __('Others'),
    'description' => '',
    'setup_function' => '',
    'save_function' => '',
    'mandatory' => false
    ),
    
    'participation' =>
    array
    (
    'multiple' => array (__('Forum','rolopress'), __('Comitee','rolopress'), __('Council','rolopress'), __('Network','rolopress'), __('Others','rolopress')),
    'name' => 'participation',
    'class' => 'participation',
    'filter' => "rolo_participation",
    'default_value' => '',
    'title' => __('Participation spaces','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'mixed',
    'mandatory' => false
    ),
    'impacts' =>
    array
    (
    'multiple' => array (__('Conflict','rolopress'), __('Comitee','rolopress'), __('Council','rolopress'), __('Network','rolopress'), __('Others','rolopress')),
    'name' => 'impacts',
    'class' => 'impacts',
    'filter' => "rolo_impacts",
    'default_value' => '',
    'title' => __('Environmental impacts','rolopress'),
    'description' => '',
    'setup_function' => 'rolo_setup_company_multiple',
    'save_function' => 'rolo_save_company_multiple',
    'type' => 'mixed',
    'mandatory' => false
    ),
    
);

/**
 * Create taxonomies
 * @since 0.1
 */
function rolo_create_taxonomy() {
    register_taxonomy( 'type', 'post', array( 'hierarchical' => false, 'label' => __('Rolopress Type', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'company', 'post', array( 'hierarchical' => false, 'label' => __('Company', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'city', 'post', array( 'hierarchical' => false, 'label' => __('City', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'state', 'post', array( 'hierarchical' => false, 'label' => __('State', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'zip', 'post', array( 'hierarchical' => false, 'label' => __('Zip', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'country', 'post', array( 'hierarchical' => false, 'label' => __('Country', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );

    // Contatos polis
    register_taxonomy( 'caracterizacao', 'post', array( 'hierarchical' => true, 'label' => __('Caracterização Institucional', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'abrangencia', 'post', array( 'hierarchical' => false, 'label' => __('Abrangência da Atuação', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'interesse', 'post', array( 'hierarchical' => false, 'label' => __('Áreas de Interesse', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'participacao', 'post', array( 'hierarchical' => true, 'label' => __('Espaços de Participação', 'rolopress'), 'query_var' => true, 'rewrite' => true ) );
}
add_action('init', 'rolo_create_taxonomy', 0);

?>