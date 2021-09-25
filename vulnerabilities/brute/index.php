<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Brute Force' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'brute';
$page[ 'help_button' ]   = 'brute';
$page[ 'source_button' ] = 'brute';
dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		$method = 'POST';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/brute/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Brute Force</h1>
	<h2>Login</h2><br/>
<div class='row'>
	<div class=\"col-md-6\">
		<form action=\"#\"  method=\"{$method}\" style='width:50%;'>
			Username:<br />
			<input type=\"text\" name=\"username\" class='form-control'><br />
			Password:<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password\" class='form-control'><br />
			<br />
			<input type=\"submit\" value=\"Login\" name=\"Login\" class='btn btn-success'><br/>\n";

if( $vulnerabilityFile == 'high.php' || $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		</div>
		<div class='col-md-6'>
		{$html}
		</div>
	</div>
	<br/>
	<h2>More Information</h2>
	<ul>
		<li>" . dvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Brute_force_attack' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'http://www.symantec.com/connect/articles/password-crackers-ensuring-security-your-password' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'http://www.sillychicken.co.nz/Security/how-to-brute-force-http-forms-in-windows.html' ) . "</li>
	</ul>
</div>\n";

dvwaHtmlEcho( $page );

?>
