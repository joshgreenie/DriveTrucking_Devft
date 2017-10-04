<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 *
 * Template Name: Account pages
 *
 */


if (!is_user_logged_in()) :
    /* Get user info. */
    global $current_user, $wp_roles;
    get_currentuserinfo();
//if ( $usub != "Canceled" ) :

    /* Load the registration file. */
    require_once(ABSPATH . WPINC . '/registration.php');
    $error = array();
    /* If profile was saved, update profile. */
    if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {

        /* Update user password. */
        if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            if ($_POST['pass1'] == $_POST['pass2'])
                wp_update_user(array('ID' => $current_user->ID, 'user_pass' => esc_attr($_POST['pass1'])));
            else
                $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
        }

        /* Update user information. */
        if (!empty($_POST['url']))
            wp_update_user(array('ID' => $current_user->ID, 'user_url' => esc_attr($_POST['url'])));
        if (!empty($_POST['email'])) {
            if (!is_email(esc_attr($_POST['email'])))
                $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
            elseif (email_exists(esc_attr($_POST['email'])) != $current_user->id)
                $error[] = __('This email is already used by another user.  try a different one.', 'profile');
            else {
                wp_update_user(array('ID' => $current_user->ID, 'user_email' => esc_attr($_POST['email'])));
            }
        }

        if (!empty($_POST['first-name']))
            update_user_meta($current_user->ID, 'first_name', esc_attr($_POST['first-name']));
        if (!empty($_POST['last-name']))
            update_user_meta($current_user->ID, 'last_name', esc_attr($_POST['last-name']));
        if (!empty($_POST['display_name']))
            wp_update_user(array('ID' => $current_user->ID, 'display_name' => esc_attr($_POST['display_name'])));
        update_user_meta($current_user->ID, 'display_name', esc_attr($_POST['display_name']));
        if (!empty($_POST['description']))
            update_user_meta($current_user->ID, 'description', esc_attr($_POST['description']));

        /* Redirect so the page will show updated info.*/
        /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
        if (count($error) == 0) {
            //action hook for plugins and extra fields saving
            do_action('edit_user_profile_update', $current_user->ID);
            wp_redirect(get_permalink() . '?updated=true');
            exit;
        }
    }
//endif;
endif;
get_header();
get_sidebar('account');

//
//$user = wp_get_current_user();
//$user_id = $user->chargify_custid;
//$subscription_id = $user->subscription_id;
//$customer_reference = $user->customer_reference;


$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$chargify_custid = $current_user->chargify_custid;

$usub = get_usermeta($user_id, 'chargify_level', true);
//echo var_dump($usub);

echo "<br>$chargify_custid";
if ($usub != NULL):
//    echo "<br>test";
//else :
//    echo '<br>other test';
endif;
?>


    <div id="primary" class="content-area">

        <?php if (!is_user_logged_in() && $usub == NULL) : ?>

            <p class="warning">
                <?php _e('You must be logged with an active profile in to edit your information.', 'profile');
                //                    wp_login_form();
                ?>
            </p><!-- .warning -->

        <?php elseif(is_user_logged_in() && $usub == NULL) : ?>
            <p class="warning">
                <?php _e('You must be a subscriber to edit this information.', 'profile'); ?>
            </p><!-- .warning -->
        <?php else : ?>
            <h1><?php echo $current_user->user_login ?></h1>

        <?php endif; ?>

        <main id="main" class="site-main" role="main">
            <?php
            while (have_posts()) : the_post();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>


        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();

