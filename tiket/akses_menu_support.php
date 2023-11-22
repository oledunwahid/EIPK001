
<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : '';

if (isset($_SESSION['username'])) {
	if ($_SESSION['role'] == 'admin' || 'user') {

		switch ($page) {

			case 'Dashboard':
				include "home-aset.php";
				break;

			case 'ITSupport':
				include "it.php";
				break;

			case 'EditTicketIT':
				include 'edit_detail_tiket.php';
				break;

			case 'ViewTicketIT':
				include 'detail_tiket.php';
				break;

			case 'ATK/Stationary':
				include 'facilities/stationary-facilities.php';
				break;

			case 'EditATK/Stationary':
				include 'facilities/edit-stationary-facilities.php';
				break;

			case 'ViewATK/Stationary':
				include 'facilities/view-stationary-facilities.php';

			case 'Maintenance':
				include '';
				break;

			case 'OtherFacilities':
				include '';
				break;

			case 'Delivery':
				include 'kurir.php';
				break;

			case 'EditKurir':
				include 'edit_detail_kurir.php';
				break;

			case 'ViewKurir':
				include 'detail_kurir.php';
				break;

			default:
				include "pages-404.php";
				break;
		}
	}if ($_SESSION['role'] == 'admin') {
		switch ($page) {
			case 'AddSupport':
				include 'add_support.php';
				break;
		}
	}
} else
	include "login.php";

?>
