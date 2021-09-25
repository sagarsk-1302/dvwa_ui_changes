<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

if( !dvwaIsLoggedIn() ) {	// The user shouldn't even be on this page
	// dvwaMessagePush( "You were not logged in" );
	dvwaRedirect( 'login.php' );
}

dvwaLogout();
dvwaMessagePush( "<p style='text-align:center;'>You have logged out</p>" );
dvwaRedirect( 'login.php' );

?>
