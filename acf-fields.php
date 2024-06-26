<?php
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_66609114d9e4b',
	'title' => 'Photo Details',
	'fields' => array(
		array(
			'key' => 'field_6660911528ee6',
			'label' => 'Type',
			'name' => 'type',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_666091fd28ee8',
			'label' => 'Référence',
			'name' => 'reference',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6660e791b1ea0',
			'label' => 'Date',
			'name' => 'date',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => '',
			'max' => '',
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6660e80ae5dde',
			'label' => 'Titre',
			'name' => 'titre',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6660e8727dd7c',
			'label' => 'Photo',
			'name' => 'photo',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'preview_size' => 'medium',
		),
		array(
			'key' => 'field_6660e9f51c8a9',
			'label' => 'Format',
			'name' => 'format',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_666b62bddce63',
			'label' => 'Categories',
			'name' => 'categorie',
			'aria-label' => '',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'categorie',
			'add_term' => 1,
			'save_terms' => 0,
			'load_terms' => 0,
			'return_format' => 'id',
			'field_type' => 'checkbox',
			'bidirectional' => 0,
			'multiple' => 0,
			'allow_null' => 0,
			'bidirectional_target' => array(
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'categorie',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'photo',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'format',
			),
		),
		array(
			array(
				'param' => 'post_format',
				'operator' => '==',
				'value' => 'image',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'categorie', array(
	0 => 'photo',
	1 => 'post',
	2 => 'page',
), array(
	'labels' => array(
		'name' => 'categories',
		'singular_name' => 'categorie',
		'menu_name' => 'categories',
		'all_items' => 'Tous les categories',
		'edit_item' => 'Modifier categorie',
		'view_item' => 'Voir categorie',
		'update_item' => 'Mettre à jour categorie',
		'add_new_item' => 'Ajouter categorie',
		'new_item_name' => 'Nom du nouveau categorie',
		'search_items' => 'Rechercher categories',
		'popular_items' => 'categories populaire',
		'separate_items_with_commas' => 'Séparer les categories avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer categories',
		'choose_from_most_used' => 'Choisir parmi les categories les plus utilisés',
		'not_found' => 'Aucun categories trouvé',
		'no_terms' => 'Aucun categories',
		'items_list_navigation' => 'Navigation dans la liste categories',
		'items_list' => 'Liste categories',
		'back_to_items' => '← Aller à « categories »',
		'item_link' => 'Lien categorie',
		'item_link_description' => 'Un lien vers un categorie',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
	'show_admin_column' => true,
	'sort' => true,
) );

	register_taxonomy( 'format', array(
	0 => 'photo',
	1 => 'post',
	2 => 'page',
), array(
	'labels' => array(
		'name' => 'formats',
		'singular_name' => 'format',
		'menu_name' => 'formats',
		'all_items' => 'Tous les formats',
		'edit_item' => 'Modifier format',
		'view_item' => 'Voir format',
		'update_item' => 'Mettre à jour format',
		'add_new_item' => 'Ajouter format',
		'new_item_name' => 'Nom du nouveau format',
		'search_items' => 'Rechercher formats',
		'popular_items' => 'formats populaire',
		'separate_items_with_commas' => 'Séparer les formats avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer formats',
		'choose_from_most_used' => 'Choisir parmi les formats les plus utilisés',
		'not_found' => 'Aucun formats trouvé',
		'no_terms' => 'Aucun formats',
		'items_list_navigation' => 'Navigation dans la liste formats',
		'items_list' => 'Liste formats',
		'back_to_items' => '← Aller à « formats »',
		'item_link' => 'Lien format',
		'item_link_description' => 'Un lien vers un format',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => false,
	'rewrite' => array(
		'hierarchical' => true,
	),
	'sort' => true,
) );
} );

add_action( 'init', function() {
	register_post_type( 'photo', array(
	'labels' => array(
		'name' => 'photos',
		'singular_name' => 'photo',
		'menu_name' => 'photos',
		'all_items' => 'Tous les photos',
		'edit_item' => 'Modifier photo',
		'view_item' => 'Voir photo',
		'view_items' => 'Voir photos',
		'add_new_item' => 'Ajouter photo',
		'add_new' => 'Ajouter photo',
		'new_item' => 'Nouveau photo',
		'parent_item_colon' => 'photo parent :',
		'search_items' => 'Rechercher photos',
		'not_found' => 'Aucun photos trouvé',
		'not_found_in_trash' => 'Aucun photos trouvé dans la corbeille',
		'archives' => 'Archives des photo',
		'attributes' => 'Attributs des photo',
		'insert_into_item' => 'Insérer dans photo',
		'uploaded_to_this_item' => 'Téléversé sur ce photo',
		'filter_items_list' => 'Filtrer la liste photos',
		'filter_by_date' => 'Filtrer photos par date',
		'items_list_navigation' => 'Navigation dans la liste photos',
		'items_list' => 'Liste photos',
		'item_published' => 'photo publié.',
		'item_published_privately' => 'photo publié en privé.',
		'item_reverted_to_draft' => 'photo repassé en brouillon.',
		'item_scheduled' => 'photo planifié.',
		'item_updated' => 'photo mis à jour.',
		'item_link' => 'Lien photo',
		'item_link_description' => 'Un lien vers un photo.',
	),
	'public' => true,
	'hierarchical' => true,
	'show_in_rest' => false,
	'menu_icon' => 'dashicons-admin-post',
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'page-attributes',
		3 => 'thumbnail',
		4 => 'custom-fields',
		5 => 'post-formats',
		6 => 'date',
	),
	'taxonomies' => array(
		0 => 'format',
		1 => 'categorie',
	),
	'delete_with_user' => false,
) );
} );


