<?php
/**
 * Account menu template
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$user_id      = get_current_user_id();
$current_user = wp_get_current_user();
$avatar = get_avatar( $user_id, 48 );
$howdy  = sprintf( __(' %1$s'), $current_user->display_name );
if ( current_user_can( 'read' ) ) {
    $profile_url = get_edit_profile_url( $user_id );
} elseif ( is_multisite() ) {
    $profile_url = get_dashboard_url( $user_id, 'profile.php' );
} else {
    $profile_url = false;
}
?>

<?php do_action( 'hg_login_before_account_menu' ); ?>

<div class="hg-login-account-menu">
    <div class="hg-login-account-info">
        <?php
        $notify = '';
        if( function_exists( 'buddypress' ) ){

            $notifications_count = bp_notifications_get_unread_notification_count();

            $notifications_text = sprintf( __('You have %s unread notifications','hg_login'), $notifications_count );

            $notify = '<span class="hg-login-user-notifications-info"><span title="'.$notifications_text.'" class="hg-login-user-notifications-info-count">'.$notifications_count.'</span></span>';
        }
        ?>
        
        <?php echo do_shortcode('[mks_button size="small" title="TULIS ARTIKEL" style="squared" url="https://www.trentech.id/submit/" target="_self" bg_color="#006699" txt_color="#FFFFFF" nofollow="0"]'); ?>
        
        
        
        
        <!--<?php echo do_shortcode('[dw_notif]'); ?>-->

        <div class="my-dropdown">
  <?php echo do_shortcode('[f_notification var="user" out="ntc_l_count" onclick="myFunction()" class="my-dropbtn"]').$notify; ?>
  <div id="myDropdown" class="my-dropdown-content">
    <?php echo do_shortcode('[notification_all]'); ?>
  </div>
</div>

        
        <div class="dropdown">
  <a span class="hg-login-account-main" href="https://www.trentech.id/profile/"></span><?php echo $avatar.$notify; ?><span class="hg-login-account-main-howdy" ><?php echo $howdy; ?></a>
  <div class="dropdown-content">
    <a href="https://www.trentech.id/posts/">Kelola Artikel</a>
    <a href="https://www.trentech.id/profile/">Profil Saya</a>
    <!--<a href="https://www.trentech.id/$current_user/settings/">Pengaturan</a>-->
    <a href="<?php echo wp_logout_url( home_url() ); ?>">Keluar</a>
</div>
        
        <!--<a span class="hg-login-account-main" href="https://www.trentech.id/profile/"></span><?php echo $avatar.$notify; ?><span class="hg-login-account-main-howdy" ><?php echo $howdy; ?></a>-->
        <!--<?php do_action('hg_login_after_account_maininfo',$user_id); ?>-->
        <!--<?php hg_login_current_user_dropdown_menu(); ?>-->
        
  
    </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.my-dropbtn')) {
    var dropdowns = document.getElementsByClassName("my-dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<?php do_action( 'hg_login_after_account_menu' ); ?>
