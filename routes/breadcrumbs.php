<?php 
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

# ADMIN 
  Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

  Breadcrumbs::for('admin.suppliers', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
    $trail->push('Information Suppliers', route('admin.suppliers'));
});

// SUPPLIERS FOR ADMIN
Breadcrumbs::for('admin.supplier.show', function ($trail, $supplier) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Information Suppliers', route('admin.suppliers'));
  $trail->push('Detail Information Supplier', route('admin.supplier.show', $supplier));
});

  // CONSUMER FOR ADMIN
 Breadcrumbs::for('admin.consumers', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Information Consumers', route('admin.consumers'));
});

Breadcrumbs::for('admin.create.consumer', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Information Consumer', route('admin.consumers'));
  $trail->push('Sign Up Consumer', route('admin.create.consumer'));
});

Breadcrumbs::for('admin.show.consumer', function ($trail, $consumer) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Information Consumers', route('admin.consumers'));
  $trail->push('Detail Information Consumer', route('admin.show.consumer', $consumer));
});

Breadcrumbs::for('admin.products', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Informasi Barang Masuk', route('admin.products'));
});

Breadcrumbs::for('admin.products.show', function ($trail, $products) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Informasi Barang Masuk', route('admin.products'));
  $trail->push('Detail Informasi Barang Masuk', route('admin.products.show', $products));
});

# ROUTE CONSUMER
Breadcrumbs::for('consumer.dashboard', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
});

Breadcrumbs::for('consumer.profile', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Profile Saya', route('consumer.profile'));
});

Breadcrumbs::for('consumer.create.product', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Koleksi Item Product', route('consumer.products'));
  $trail->push('Daftarkan Barang', route('consumer.create.product'));
});

Breadcrumbs::for('consumer.supplier.create', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Daftarkan Barang', route('consumer.create.product'));
  $trail->push('Daftarkan Supplier', route('consumer.supplier.create'));
});

Breadcrumbs::for('consumer.products', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Koleksi Item Product', route('consumer.products'));
});

Breadcrumbs::for('consumer.product.show', function($trail, $product){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Koleksi Item Product', route('consumer.products'));
  $trail->push('Detail Item Product', route('consumer.product.show', $product));
});

Breadcrumbs::for('consumer.riwayatBarangMasuk', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Riwayat Barang Masuk', route('consumer.riwayatBarangMasuk'));
});

Breadcrumbs::for('consumer.add.inventory', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Koleksi Item Barang', route('consumer.products'));
  $trail->push('Inputan Barang Masuk', route('consumer.add.inventory'));
});

Breadcrumbs::for('consumer.inventoryOut', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Inputan Barang Keluar', route('consumer.inventoryOut'));
});

Breadcrumbs::for('consumer.riwayatInventoryOut', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Riwayat Barang Keluar', route('consumer.riwayatInventoryOut'));
});

Breadcrumbs::for('consumer.bufferStock', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Notifikasi Buffer Stock', route('consumer.bufferStock'));
});

Breadcrumbs::for('consumer.leadTime', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Notifikasi waktu tunggu', route('consumer.leadTime'));
});


Breadcrumbs::for('consumer.supplier.index', function($trail){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Informasi Supplier', route('consumer.supplier.index'));
});

Breadcrumbs::for('consumer.supplier.edit', function($trail, $supplier){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Informasi Supplier', route('consumer.supplier.index'));
  $trail->push('Ubah Informasi Supplier', route('consumer.supplier.edit', $supplier));
});


Breadcrumbs::for('consumer.category', function($trail, $supplier){
  $trail->push('Dashboard', route('consumer.dashboard'));
  $trail->push('Informasi Supplier', route('consumer.supplier.index'));
  $trail->push('Ubah Informasi Supplier', route('consumer.supplier.edit', $supplier));
  $trail->push('Detail kategori barang', route('consumer.category', $supplier));
});