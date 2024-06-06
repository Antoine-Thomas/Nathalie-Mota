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
			'name' => 'Reference',
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
	),
	'location' => array(
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
				'value' => 'all',
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
				'value' => 'categorie',
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
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'date',
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
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'reference',
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
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'date',
			),
			'choices' => array(
			),
			'default_value' => '',
			'return_format' => 'value',
			'allow_null' => 0,
			'other_choice' => 0,
			'layout' => 'vertical',
			'save_other_choice' => 0,
		),
		array(
			'key' => 'field_6658c8862f8d4',
			'label' => 'format',
			'name' => 'format',
			'aria-label' => '',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'form',
			),
			'taxonomy' => 'category',
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
		array(
			'key' => 'field_6658c510a6043',
			'label' => 'type',
			'name' => 'type',
			'aria-label' => '',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => 'type',
			),
			'taxonomy' => 'category',
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
				'width' => '',
				'class' => '',
				'id' => '',
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
		array(
			'key' => 'field_665f24a17958a',
			'label' => 'categorie',
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
			'taxonomy' => 'category',
			'add_term' => 1,
			'save_terms' => 1,
			'load_terms' => 0,
			'return_format' => 'id',
			'field_type' => 'multi_select',
			'allow_null' => 0,
			'bidirectional' => 0,
			'multiple' => 0,
			'bidirectional_target' => array(
			),
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
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'format',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'categorie',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'date',
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
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'date',
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
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'format',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'date',
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
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'photo',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'categorie',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'date',
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
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'categorie',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => false,
	'description' => '',
	'show_in_rest' => 1,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'categorie', array(
	0 => 'photo',
), array(
	'labels' => array(
		'name' => 'Categories',
		'singular_name' => 'Categorie',
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
	'show_in_menu' => true,
	'show_in_rest' => true,
	'sort' => true,
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
		'search_items' => 'Rechercher dates',
		'popular_items' => 'dates populaire',
		'separate_items_with_commas' => 'Séparer les dates avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer dates',
		'choose_from_most_used' => 'Choisir parmi les dates les plus utilisés',
		'not_found' => 'Aucun dates trouvé',
		'no_terms' => 'Aucun dates',
		'items_list_navigation' => 'Navigation dans la liste dates',
		'items_list' => 'Liste dates',
		'back_to_items' => '← Aller à « dates »',
		'item_link' => 'Lien date',
		'item_link_description' => 'Un lien vers un date',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
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
	'show_in_rest' => true,
	'rewrite' => array(
		'hierarchical' => true,
	),
	'sort' => true,
) );

	register_taxonomy( 'reference', array(
	0 => 'photo',
), array(
	'labels' => array(
		'name' => 'references',
		'singular_name' => 'reference',
		'menu_name' => 'ref',
		'all_items' => 'Tous les ref',
		'edit_item' => 'Modifier ref',
		'view_item' => 'Voir ref',
		'update_item' => 'Mettre à jour ref',
		'add_new_item' => 'Ajouter ref',
		'new_item_name' => 'Nom du nouveau ref',
		'search_items' => 'Rechercher ref',
		'popular_items' => 'ref populaire',
		'separate_items_with_commas' => 'Séparer les ref avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer ref',
		'choose_from_most_used' => 'Choisir parmi les ref les plus utilisés',
		'not_found' => 'Aucun ref trouvé',
		'no_terms' => 'Aucun ref',
		'items_list_navigation' => 'Navigation dans la liste ref',
		'items_list' => 'Liste ref',
		'back_to_items' => '← Aller à « ref »',
		'item_link' => 'Lien ref',
		'item_link_description' => 'Un lien vers un ref',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
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
		0 => 'format',
		1 => 'categorie',
	),
	'rewrite' => array(
		'with_front' => false,
	),
	'delete_with_user' => false,
) );
} );






