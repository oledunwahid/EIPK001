<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

$sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
$row7 = mysqli_fetch_assoc($sql7);


if (isset($row7['admin']) && ($row7['admin'] == '1')) {
	switch ($page) {
		case 'Dashboard':
			include "home-facility.php";
			break;
		case 'ITSupport':
			include "it.php";
			break;
		case 'AccessAdministrator':
			include 'akses_admin.php';
			break;
		case 'MenuAdministrator':
			include 'menu_admin.php';
			break;
		case 'AddSupport':
			include 'add_support.php';
			break;
		case 'EditTicketIT':
			include 'edit_detail_tiket.php';
			break;
		case 'ViewTicketIT':
			include 'detail_tiket.php';
			break;
		case 'ATK/Stationary':
			include 'stationary_facilities.php';
			break;
		case 'EditATK/Stationary':
			include 'edit_stationary_facilities.php';
			break;
		case 'ViewATK/Stationary':
			include 'view_stationary_facilities.php';
			break;
		case 'ATKList':
			include 'atk.php';
			break;
		case 'Building Facilities':
			include 'building_facilities.php';
			break;
		case 'Edit Building Facilities':
			include 'edit_building_facilities.php';
			break;
		case 'View Building Facilities':
			include 'view_building_facilities.php';
			break;
		case 'Other Facilities':
			include 'other_facilities.php';
			break;
		case 'Edit Other Facilities':
			include 'edit_other_facilities.php';
			break;
		case 'View Other Facilities':
			include 'view_other_facilities.php';
			break;
		case 'Delivery':
			include 'kurir.php';
			break;
		case 'Received':
			include 'received_kurir.php';
			break;
		case 'EditReceived':
			include 'edit_received_kurir.php';
			break;
		case 'ViewReceived':
			include 'view_received_kurir.php';
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
} else {
	switch ($page) {
		case 'Dashboard':
			include "home-facility.php";
			break;
		case 'ITSupport':
			include "it.php";
			break;
		case 'AddSupport':
			include 'add_support.php';
			break;
		case 'EditTicketIT':
			include 'edit_detail_tiket.php';
			break;
		case 'ViewTicketIT':
			include 'detail_tiket.php';
			break;
		case 'ATK/Stationary':
			include 'stationary_facilities.php';
			break;
		case 'EditATK/Stationary':
			include 'edit_stationary_facilities.php';
			break;
		case 'ViewATK/Stationary':
			include 'view_stationary_facilities.php';
			break;
		case 'Building Facilities':
			include 'building_facilities.php';
			break;
		case 'Edit Building Facilities':
			include 'edit_building_facilities.php';
			break;
		case 'View Building Facilities':
			include 'view_building_facilities.php';
			break;
		case 'Other Facilities':
			include 'other_facilities.php';
			break;
		case 'Edit Other Facilities':
			include 'edit_other_facilities.php';
			break;
		case 'View Other Facilities':
			include 'view_other_facilities.php';
			break;
		case 'Delivery':
			include 'kurir.php';
			break;
		case 'Received':
			include 'received_kurir.php';
			break;
		case 'EditReceived':
			include 'edit_received_kurir.php';
			break;
		case 'ViewReceived':
			include 'view_received_kurir.php';
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
}
