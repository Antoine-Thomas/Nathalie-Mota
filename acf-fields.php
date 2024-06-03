

<?php



add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_6658c51025231',
	'title' => 'photos',
	'fields' => array(
		array(
			'key' => 'field_6658c567e0c05',
			'label' => 'référence',
			'name' => 'reference',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'ref',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6658c8d01376e',
			'label' => 'Année',
			'name' => 'annee',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'date',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6658c8862f8d4',
			'label' => 'format',
			'name' => 'format',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'form',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6658c510a6043',
			'label' => 'type',
			'name' => 'type',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'type',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6658c7f92cf0c',
			'label' => 'image',
			'name' => 'image',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '564',
				'class' => '495',
				'id' => 'img',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_width' => 564,
			'min_height' => 495,
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'preview_size' => 'custom-thumb',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'photo',
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
	'show_in_rest' => 1,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'categorie', array(
	0 => 'photo',
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
		'not_found' => 'Aucun categories trouvé',
		'no_terms' => 'Aucun categories',
		'items_list_navigation' => 'Navigation dans la liste categories',
		'items_list' => 'Liste categories',
		'back_to_items' => '← Aller à « categories »',
		'item_link' => 'Lien categorie',
		'item_link_description' => 'Un lien vers un categorie',
	),
	'public' => true,
	'hierarchical' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );

	register_taxonomy( 'date', array(
	0 => 'photo',
), array(
	'labels' => array(
		'name' => 'dates',
		'singular_name' => 'date',
		'menu_name' => 'dates',
		'all_items' => 'Tous les dates',
		'edit_item' => 'Modifier date',
		'view_item' => 'Voir date',
		'update_item' => 'Mettre à jour date',
		'add_new_item' => 'Ajouter date',
		'new_item_name' => 'Nom du nouveau date',
		'parent_item' => 'date parent',
		'parent_item_colon' => 'date parent :',
		'search_items' => 'Rechercher dates',
		'not_found' => 'Aucun dates trouvé',
		'no_terms' => 'Aucun dates',
		'filter_by_item' => 'Filtrer par date',
		'items_list_navigation' => 'Navigation dans la liste dates',
		'items_list' => 'Liste dates',
		'back_to_items' => '← Aller à « dates »',
		'item_link' => 'Lien date',
		'item_link_description' => 'Un lien vers un date',
	),
	'public' => true,
	'hierarchical' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
	'sort' => true,
) );

	register_taxonomy( 'format', array(
	0 => 'photo',
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
		'not_found' => 'Aucun formats trouvé',
		'no_terms' => 'Aucun formats',
		'items_list_navigation' => 'Navigation dans la liste formats',
		'items_list' => 'Liste formats',
		'back_to_items' => '← Aller à « formats »',
		'item_link' => 'Lien format',
		'item_link_description' => 'Un lien vers un format',
	),
	'public' => true,
	'hierarchical' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
	'sort' => true,
) );
} );

add_action( 'init', function() {
	register_post_type( 'photo', array(
	'labels' => array(
		'name' => 'photos',
		'singular_name' => 'photo',
		'menu_name' => 'photo',
		'all_items' => 'Toutes les photos',
		'edit_item' => 'Modifier photo',
		'view_item' => 'Voir photo',
		'view_items' => 'Voir photo',
		'add_new_item' => 'Ajouter photo',
		'add_new' => 'Ajouter photo',
		'new_item' => 'Nouveau photo',
		'parent_item_colon' => 'photo parent :',
		'search_items' => 'Rechercher photo',
		'not_found' => 'Aucun photo trouvé',
		'not_found_in_trash' => 'Aucun photo trouvé dans la corbeille',
		'archives' => 'Archives des photo',
		'attributes' => 'Attributs des photo',
		'insert_into_item' => 'Insérer dans photo',
		'uploaded_to_this_item' => 'Téléversé sur ce photo',
		'filter_items_list' => 'Filtrer la liste photo',
		'filter_by_date' => 'Filtrer photo par date',
		'items_list_navigation' => 'Navigation dans la liste photo',
		'items_list' => 'Liste photo',
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
	'show_in_rest' => true,
	'rest_base' => 'http://localhost:10101/',
	'menu_icon' => 'dashicons-admin-post',
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'page-attributes',
		3 => 'thumbnail',
		4 => 'custom-fields',
		5 => 'post-formats',
	),
	'taxonomies' => array(
		0 => 'category',
		1 => 'post_format',
	),
	'delete_with_user' => false,
) );
} );

