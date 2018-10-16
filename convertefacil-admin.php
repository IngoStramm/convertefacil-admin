<?php  
/**
 * Plugin Name: ConverteFacil Admin
 * Plugin URI: http://laf.marketing
 * Description: Este plugin customiza a aparência do painel administrativo do WP.
 * Version: 1.0.0
 * Author: Ingo Stramm
 * Text Domain: cfa
 * License: GPLv2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'CFA_DIR', plugin_dir_path( __FILE__ ) );
define( 'CFA_URL', plugin_dir_url( __FILE__ ) );

require_once 'tgm/tgm.php';

/*
*
* Tela de login
* 
* Adicionar arquivo de imagem do logotipo e do BG na pasta imagens
* 
*/

function cfa_debug( $debug ) {
	echo '<pre>';
	var_dump( $debug );
	echo '</pre>';
}

$administrador;

add_action( 'login_enqueue_scripts', 'cfa_login_logo' );

function cfa_login_logo() { ?>
    <style type="text/css">
    	body.login {
            position: relative;
    		background-color: #333 !important;
            /*background-image: url( <?php echo plugins_url( 'images/bg.jpg' , __FILE__ ); ?> ) !important;*/
            background-image: none !important;
    		background-repeat: no-repeat !important;
    		background-position: center top !important;
			-webkit-background-size: cover !important;
			background-size: cover !important;
    		display: block;
    	}
        body.login #login h1 a {
            background-image: url( <?php echo plugins_url( 'images/logo.png' , __FILE__ ); ?> ) !important;
			width: 100% !important;
			-webkit-background-size: contain !important;
			background-size: contain !important;
        }
        body.login #backtoblog a, 
        body.login #nav a, 
        body.login h1 a	{
        	color: #fff;
        }
        .wp-core-ui .button-primary {
            text-transform: uppercase;
            text-shadow: none;
            border: none;
        	background: #fff;
            color: #fff;
        }
        .wp-core-ui .button-primary.active, 
        .wp-core-ui .button-primary.active:focus, 
        .wp-core-ui .button-primary.active:hover, 
        .wp-core-ui .button-primary:active,
        .wp-core-ui .button-primary.focus, 
        .wp-core-ui .button-primary.hover, 
        .wp-core-ui .button-primary:focus, 
        .wp-core-ui .button-primary:hover {
            border: none;
        	background: #fff;
            color: #fff;
        }
    </style>
<?php }

add_filter( 'login_headerurl', 'cfa_custom_loginlogo_url' );

function cfa_custom_loginlogo_url($url) {
	return 'https://convertefacil.com.br';
}

add_filter( 'login_headertitle', 'cfa_custom_loginlogo_title' );

function cfa_custom_loginlogo_title($title) {
	return 'Converte Fácil';
}

add_action( 'wp_head', 'cfa_admin_style' );
add_action( 'admin_head', 'cfa_admin_style' );

function cfa_admin_style() {
	?>
	<style>
		#wpadminbar {
			background-color: #00a99d;
		}
		#adminmenu, 
		#adminmenu .wp-submenu, 
		#adminmenuback, 
		#adminmenuwrap {
			background-color: #027c73;
		}
		#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, 
		#adminmenu .wp-menu-arrow, 
		#adminmenu .wp-menu-arrow div, 
		#adminmenu li.current a.menu-top, 
		#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, 
		.folded #adminmenu li.current.menu-top, 
		.folded #adminmenu li.wp-has-current-submenu {
			background-color: #1c443f;
		}
		#adminmenu .wp-has-current-submenu .wp-submenu, 
		#adminmenu .wp-has-current-submenu .wp-submenu.sub-open, 
		#adminmenu .wp-has-current-submenu.opensub .wp-submenu, 
		#adminmenu a.wp-has-current-submenu:focus+.wp-submenu, 
		.no-js li.wp-has-current-submenu:hover .wp-submenu {
			background-color: #11312d;
		}
		#adminmenu li.menu-top:hover, 
		#adminmenu li.opensub>a.menu-top, 
		#adminmenu li>a.menu-top:focus,
		#adminmenu .opensub .wp-submenu li:hover,
		#adminmenu li.menu-top:hover, 
		#adminmenu li.opensub>a.menu-top, 
		#adminmenu li>a.menu-top:focus {
			background-color: #193a36;
			color: #00a99d;
		}
		#adminmenu li a:focus div.wp-menu-image:before, 
		#adminmenu li.opensub div.wp-menu-image:before, 
		#adminmenu li:hover div.wp-menu-image:before,
		#adminmenu .wp-submenu a:focus, 
		#adminmenu .wp-submenu a:hover, 
		#adminmenu a:hover, 
		#adminmenu li.menu-top>a:focus {
			color: #00a99d;
		}
		.wrap .add-new-h2:hover, 
		.wrap .page-title-action:hover,
		.wp-core-ui .button-primary {
			background-color: #027c73;
			border-color: #005a54;
		}
		.wp-core-ui .button-primary.focus, 
		.wp-core-ui .button-primary.hover, 
		.wp-core-ui .button-primary:focus, 
		.wp-core-ui .button-primary:hover {
			background: #1c443f;
		    border-color: #1c443f;
		}
		.cf-mini-logo {
			display: block;
			height: 32px !important;
			width: 100px !important;
			background: transparent url(<?php echo plugins_url( 'images/mini-logo-admin-bar.png' , __FILE__ ); ?>) center no-repeat;
			-webkit-background-size: contain;
			background-size: contain;
		}
		#wpadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions > li {
			margin-left: 16px;
		}
	<?php 
}


add_action('init','cfa_checka_administrador');

function cfa_checka_administrador () {
	$user_id = get_current_user_id();
	$user_info = get_userdata( $user_id );
	$administrador = current_user_can('manage_options');
	// Se não for um administrador
	if (!$administrador)
		cfa_customizacaoAdmin();
}

/*
*
* As funções que estiverem dentro desta função ("cfa_customizacaoAdmin()")
* só serão executadas se o usuário não for um administrador
*
*/
function cfa_customizacaoAdmin() {

	// Resposta do fedback (envio de email)
	include 'feedback/feedback-response.php';

	// Remobe a Aba 'Ajuda'
	add_filter( 'contextual_help', 'cfa_remove_help_tabs', 999, 3 );

	function cfa_remove_help_tabs($old_help, $screen_id, $screen){
	    $screen->remove_help_tabs();
	    return $old_help;
	}

	// Remove a Aba 'Opões de Tela'
	add_filter('screen_options_show_screen', '__return_false');    
	/*
	 *
	 * Remove avisos e erros do WP
	 *
	 */
    add_action( 'admin_head', 'cfa_hide_update_msg_non_admins');

	function cfa_hide_update_msg_non_admins() { ?>
		<style>
			.updated,
			.error.notice,
			.error,
			#pageparentdiv {
				display: none !important;
			}
		</style>
    <?php }

	/*
	*
	* Dashboard: Customiza os Widgets
	*
	*/
	add_action('wp_dashboard_setup', 'cfa_dashboard_widgets');

	function cfa_dashboard_widgets() {
		global $wp_meta_boxes;
		
		// Remove os Widgets
		// Agora
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		// Postagem rápida
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		// Novidades WP
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		// Woocommerce Avaliações Recentes
		// remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
		// Atividades
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
		// Yoast SEO
		unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);

		// Adiciona novos Widgets
		// Coluna da esquerda
		wp_add_dashboard_widget( 'bem-vindo', __( 'Bem vindo!', 'cf' ),'cfa_add_welcome_widget','dashboard','normal','high');
		wp_add_dashboard_widget( 'modulos', __( 'Loja Converte Fácil', 'cf' ),'cfa_add_modules','dashboard','normal','high');
		wp_add_dashboard_widget( 'feedback', __( 'Feedback', 'cf' ),'cfa_feedback','dashboard','normal','high');
		// Coluna da direita
		add_meta_box( 'dashboard_activity', __( 'Activity' ), 'wp_dashboard_site_activity', 'dashboard', 'side', 'core' );
		// add_meta_box( 'cf_dashboard_recent_reviews', __( 'WooCommerce recent reviews', 'woocommerce' ), 'cfa_recent_reviews' ,'dashboard','side','core');
	}

	/*
	*
	* Remove mensagens de boas vindas
	*
	*/
	remove_action( 'welcome_panel', 'wp_welcome_panel' );

	function cfa_add_welcome_widget(){ ?>

		<a href="https://convertefacil.com.br" target="_blank"><img style="width: 100%; margin: auto;" src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/banner-dashboard.jpg" alt="<?php echo _( 'Saiba tudo sobre a plataforma. Clique aqui!', 'cf' ); ?>"></a>
	<?php }

	function cfa_add_modules() { ?>
		<ul>
			<li><a href="#"><?php _e( 'Adicionar Módulos (Em breve)', 'cf' ); ?></a></li>
			<li><a href="#"><?php _e( 'Contratar Design (Em breve)', 'cf' ); ?></a></li>
			<li><a href="#"><?php _e( 'Contratar Redação de Textos (Em breve)', 'cf' ); ?></a></li>
			<li><?php _e( 'Telefone:', 'cf' ); ?> <a href="tel:+551127597931">(11) 2759-7931</a></li>
			<li><?php _e( 'Email:', 'cf' ); ?> <a href="mailto:contato@convertefacil.com.br"><?php _e( 'contato@convertefacil.com.br', 'cf' ); ?></a></li>
		</ul>
	<?php }

	function cfa_feedback() {
		include 'feedback/feedback-form.php';
	}

	// Função copiada do Woocommerce
	// @link: woocommerce/includes/admin/class-wc-admin-dasboard.php
	// linha 247
	function cfa_recent_reviews() {
			global $wpdb;
			$comments = $wpdb->get_results( "
				SELECT posts.ID, posts.post_title, comments.comment_author, comments.comment_ID, SUBSTRING(comments.comment_content,1,100) AS comment_excerpt
				FROM $wpdb->comments comments
				LEFT JOIN $wpdb->posts posts ON (comments.comment_post_ID = posts.ID)
				WHERE comments.comment_approved = '1'
				AND comments.comment_type = ''
				AND posts.post_password = ''
				AND posts.post_type = 'product'
				ORDER BY comments.comment_date_gmt DESC
				LIMIT 5
			" );

			if ( $comments ) {
				echo '<ul>';
				foreach ( $comments as $comment ) {

					echo '<li>';

					echo get_avatar( $comment->comment_author, '32' );

					$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

					/* translators: %s: rating */
					echo '<div class="star-rating"><span style="width:' . ( $rating * 20 ) . '%">' . sprintf( __( '%s out of 5', 'woocommerce' ), $rating ) . '</span></div>';

					/* translators: %s: review author */
					echo '<h4 class="meta"><a href="' . get_permalink( $comment->ID ) . '#comment-' . absint( $comment->comment_ID ) . '">' . esc_html( apply_filters( 'woocommerce_admin_dashboard_recent_reviews', $comment->post_title, $comment ) ) . '</a> ' . sprintf( __( 'reviewed by %s', 'woocommerce' ), esc_html( $comment->comment_author ) ) . '</h4>';
					echo '<blockquote>' . wp_kses_data( $comment->comment_excerpt ) . ' [...]</blockquote></li>';

				}
				echo '</ul>';
			} else {
				echo '<p>' . __( 'There are no product reviews yet.', 'woocommerce' ) . '</p>';
			}
		}

	add_action( 'admin_head', 'cfa_bem_vindo_style' );

	function cfa_bem_vindo_style() {
		?>
		<style>
			#dashboard-widgets #bem-vindo.postbox .inside {
				margin: 0;
				padding: 0;
				line-height: 0;
			}
		</style>
		<?php
	}
	
	/*
	 *
	 * Remove Menus do sidebar
	 *
	 */
	add_action( 'admin_menu', 'cfa_remove_menus' );

	function cfa_remove_menus(){
        global $submenu;
        // cfa_debug( $submenu );
        $edit_menu = $submenu['themes.php'][10];
        add_menu_page( __( 'Editar Menus' ), __( ' Menus '), 'edit_theme_options', 'nav-menus.php', null, null, 60 );
        // remove_menu_page( 'index.php' );                  //Dashboard
        // remove_menu_page( 'edit.php' );                   //Posts
        // remove_menu_page( 'upload.php' );                 //Media
        // remove_menu_page( 'edit.php?post_type=page' );    //Pages
        // remove_menu_page( 'edit-comments.php' );          //Comments
        remove_menu_page( 'themes.php' );                 //Appearance
        remove_menu_page( 'plugins.php' );                //Plugins
        // remove_menu_page( 'users.php' );                  //Users
        remove_menu_page( 'tools.php' );                  //Tools
        remove_menu_page( 'admin.php?page=jetpack' );                 
        // remove_menu_page( 'options-general.php' );        //Settings
        remove_menu_page( 'duplicator' ); 
        remove_menu_page( 'wpcf7' ); 
        remove_menu_page( 'edit.php?post_type=featured_item' ); 
        // remove_menu_page( 'edit.php?post_type=blocks' ); 

        // Submenu items
        // remove_submenu_page( 'themes.php', 'customize.php' );   
        // remove_submenu_page( 'themes.php', 'themes.php' );
        // remove_submenu_page( 'themes.php', 'nav-menus.php' );  

        // remove_submenu_page( 'edit.php?post_type=shop_order', 'admin.php?page=wc-addons' );   
        // unset($submenu['edit.php?post_type=shop_order'][5]); // Themes        

        // Produtos
        // unset($submenu['edit.php?post_type=product'][17]); // Atributos     
        
        // Appearance Menu
        unset($submenu['themes.php'][5]); // Themes        
        unset($submenu['themes.php'][6]); // Customize link
        unset($submenu['themes.php'][7]); // Widgets
        // unset($submenu['themes.php'][10]); // Menus
        unset($submenu['themes.php'][15]); // Customize link
        unset($submenu['themes.php'][20]); // Background
        unset($submenu['edit.php?post_type=popup'][11]); // Background
        unset($submenu['edit.php?post_type=popup'][12]); // Background
        unset($submenu['edit.php?post_type=popup'][13]); // Background

        // Media Library Folders
        unset($submenu['media-library-folders'][2]);
        unset($submenu['media-library-folders'][5]);
        unset($submenu['media-library-folders'][6]);
	}

	/*
	 *
	 * Remove Menus da barra do topo
	 *
	 */
	add_action( 'admin_bar_menu', 'cfa_remove_bar_menu_items', 999 );

	add_filter( 'map_meta_cap', 'cfa_remove_jetpack_menu_page', 10, 4 );

	function cfa_remove_jetpack_menu_page( $caps, $cap, $user_id, $args ) {
	    if ( 'jetpack_admin_page' === $cap ) {
	        $caps[] = 'manage_options';
	    }
	    return $caps;
	}

	function cfa_remove_bar_menu_items( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'site-name' );
		$wp_admin_bar->remove_node( 'search' );
		$wp_admin_bar->remove_node( 'wpseo-menu' );
		$wp_admin_bar->remove_node( 'new-blocks' );
		$wp_admin_bar->remove_node( 'new-featured_item' );
		$wp_admin_bar->remove_node( 'notes' );
	}

	/*
	 *
	 * Adiciona Menus Customizado à barra no topo
	 *
	 */
	add_action( 'admin_bar_menu', 'cfa_admin_bar' , 35);

	function cfa_admin_bar() {

		global $wp_admin_bar;
		$home_url = get_home_url();
		$admin_url = get_admin_url();

		$wp_admin_bar->add_node( array(
			'id' => 'cf_panel',
			'title' => '<span class="cf-mini-logo"></span>'
		));

		$wp_admin_bar->add_node( array(
			'id' => 'go_to_site',
			'parent' => 'cf_panel',
			'title' => __( 'Ver Site', 'cf' ),
			'href' => $home_url
		));

		$wp_admin_bar->add_node( array(
			'id' => 'go_to_admin',
			'parent' => 'cf_panel',
			'title' => __( 'Gerenciar Site', 'cf' ),
			'href' => $admin_url
		));

	}

	/*
	 *
	 * Remove as referências ao Wordpress no footer
	 *
	 */
	add_filter( 'admin_footer_text', '__return_empty_string', 11 );
	add_filter( 'update_footer',     '__return_empty_string', 11 );

    /*
     *
     * Remove as opções "Customizar" e "Cometários" da barra no topo
     *
     */
    add_action( 'wp_before_admin_bar_render', 'cfa_before_admin_bar_render' ); 

    function cfa_before_admin_bar_render()
    {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu('customize');
        $wp_admin_bar->remove_menu('comments');
    }

    // Esconde o Metabox de Comentários do plugin do FB
    add_action('admin_head', 'cfa_FB_comments_metabox');

    function cfa_FB_comments_metabox() {
    	echo 
    	'<style>
	    	#myplugin_sectionid.postbox,
	    	.woocommerce-BlankState,
	    	#role option[value="subscriber"],
	    	#role option[value="translator"],
	    	#role option[value="shop_manager"],
	    	#popmake_popup_themes {
	    		display: none;
	    	} 
	    </style>';

	}

	add_action( 'wp_head', 'cfa_hide_avatar_style' );
	add_action( 'admin_head', 'cfa_hide_avatar_style' );

	function cfa_hide_avatar_style() {
		?>
		<style>
			#wpadminbar #wp-admin-bar-my-account.with-avatar > .ab-empty-item img, 
			#wpadminbar #wp-admin-bar-my-account.with-avatar > a img,
			#wp-admin-bar-user-info .avatar {
				display: none;
			}
		</style>
		<?php
	}

	add_action( 'admin_head', 'cfa_menus_edit_style' );

	function cfa_menus_edit_style() {
		$screen = get_current_screen();
		if( $screen->id == 'nav-menus' ) : ?>
			<style>
				a.page-title-action.hide-if-no-customize,
				h2.nav-tab-wrapper.wp-clearfix,
				.manage-menus,
				span.add-new-menu-action,
				.menu-settings,
				li#add-category,
				li#woocommerce_endpoints_nav_link,
				span.delete-action,
				.major-publishing-actions label.menu-name-label,
				.major-publishing-actions input#menu-name {
					display: none !important;
				}
				li#add-post-type-page,
				li#add-post-type-post,
				li#add-custom-links {
					display: block !important;
				}
			</style>
		<?php elseif( $screen->id == 'users' ) : ?>
			<style>
				#new_role,
				#changeit,
				#ure_grant_roles {
					display: none;
				}
			</style>
		<?php endif;
	}

} // Fim cfa_customizacaoAdmin()

add_filter( 'ure_show_additional_capabilities_section', 'cfa_desabilita_other_roles' );

function cfa_desabilita_other_roles() {
	$administrador = current_user_can('manage_options');
	return ( !$administrador ) ? false : true;
}

/*
*
* Previne de qualquer usuário que NÃO for um Administrador,
* de editar um usuário Administrador
* Por ex: um Editor não pode criar/editar/excluir um Administrador
*
*/
class Cfa_Previne_Edicao_Admin {

  // Add our filters
  function __construct(){
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }

  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

// Previne que usuários não administradores acessem o admin durante o modo de manutenção
add_action( 'init', 'block_wp_admin_init', 0 );

function block_wp_admin_init() {
	if( get_theme_mod( 'maintenance_mode', 0 ) > 0 ) {
		if (strpos( strtolower( $_SERVER['REQUEST_URI'] ),'/wp-admin/' ) !== false ) {
			if ( !current_user_can('manage_options') ) {
				wp_redirect( get_option('siteurl'), 302 );
			}
		}
	}
}

$jpb_user_caps = new Cfa_Previne_Edicao_Admin();
?>