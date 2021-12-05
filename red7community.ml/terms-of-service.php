<?php
/*
  File Name: terms-of-service.php
  Original Location: /terms-of-service.php
  Description: The terms of service stuff.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

// Initialize the session
if(!isset($_SESSION)){
	session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Terms of Service</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
	</head>

	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
		<div class="page-content-wrapper">
				<?php
				if (isset($your_isBanned))
				{
					if ($your_isBanned == 1)
					{
						echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
					}
				}
				
				if (isset($maintenanceMode))
				{
					if ($maintenanceMode == "on")
					{
						echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
					}
				}
				?>
				<main class="col-md-9">
					<h1>Website Terms and Conditions of Use</h1>

					<h2>1. Terms</h2>

					<p>By accessing this Website, accessible from red7community.ml, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.</p>

					<h2>2. Use License</h2>

					<p>Permission is granted to temporarily download one copy of the materials on RED7 STUDIOS's Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>

					<ul>
					    <li>modify or copy the materials;</li>
					    <li>use the materials for any commercial purpose or for any public display;</li>
					    <li>attempt to reverse engineer any software contained on RED7 STUDIOS's Website;</li>
					    <li>remove any copyright or other proprietary notations from the materials; or</li>
					    <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
					</ul>

					<p>This will let RED7 STUDIOS to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.</p>

					<h2>3. Disclaimer</h2>

					<p>All the materials on RED7 STUDIOS’s Website are provided "as is". RED7 STUDIOS makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, RED7 STUDIOS does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.</p>

					<h2>4. Limitations</h2>

					<p>RED7 STUDIOS or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on RED7 STUDIOS’s Website, even if RED7 STUDIOS or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.</p>

					<h2>5. Revisions and Errata</h2>

					<p>The materials appearing on RED7 STUDIOS’s Website may include technical, typographical, or photographic errors. RED7 STUDIOS will not promise that any of the materials in this Website are accurate, complete, or current. RED7 STUDIOS may change the materials contained on its Website at any time without notice. RED7 STUDIOS does not make any commitment to update the materials.</p>

					<h2>6. Links</h2>

					<p>RED7 STUDIOS has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by RED7 STUDIOS of the site. The use of any linked website is at the user’s own risk.</p>

					<h2>7. Site Terms of Use Modifications</h2>

					<p>RED7 STUDIOS may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.</p>

					<h2>8. Your Privacy</h2>

					<p>Please read our <a href="/privacy.php">Privacy Policy</a>.</p>

					<h2>9. Governing Law</h2>

					<p>Any claim related to RED7 STUDIOS's Website shall be governed by the laws of au without regards to its conflict of law provisions.</p>

					<h2>10. Rules</h2>

					<p>- Swearing, bigotry or any other forms of insults are strictly prohibited.</p>
					<p>- No glitching and cheating forms of currency or items under any circumstances.</p>
					<p>- Sharing accounts is not permitted, you will need seperate accounts if you wish to play.</p>
					<p>- No logging in to other people's accounts even with permission from the owner.</p>
					<p>- Don't attempt to find or abuse bugs for non-<a href="/bug-hunting.php">bug/bounty hunting</a> purposes.</p>
					<p>- We remain the right to ban/IP-ban anyone at any time with any reason.</p>
					<p>- Access to the admin panel in anyway is strictly prohibited and will result in ban.</p>
					<p>- Purchasing currency in illegal ways such as stealing credit cards, etc is prohibited.</p>
					<p>- Participating in events and cheating or gaining an advantage over others can result in a ban.</p>
					<p>- Off-site buying of accounts, items, currency and memberships are strictly prohibited.</p>
					<p>- Claiming that you have credentials that you don't have such as Administrator is bannable.</p>
				</main>
			</div>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>