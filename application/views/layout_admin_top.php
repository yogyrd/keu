<?php 
$page_css = 'admin.css';
$is_admin = true;
include_once 'layout_top.php'; 
include_once 'layout_admin_navbar.php';
?>

<div id="admin-wrapper">
    
    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-12">
            <h3><?= $admin_page_title; ?></h3>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-bullseye"></i> <?= $admin_page_breadcrumb; ?>
                </li>
            </ol>
        </div>
    </div>
    

