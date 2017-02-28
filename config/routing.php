<?php
if (isset($_POST) and isset($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = $_POST['_method'];
}

$router = new AltoRouter();
$router->setBasePath('');

// // Clients
// $router->map('GET','/clients', 'ClientsController#index', 'clients_path');
// $router->map('GET','/clients/[i:id]', 'ClientsController#show', 'client_path');
// $router->map('GET','/clients/new', 'ClientsController#new', 'new_client_path');
// $router->map('GET','/clients/[i:id]/edit', 'ClientsController#edit', 'edit_client_path');
// $router->map('POST','/clients', 'ClientsController#create', 'create_client_path');
// $router->map('PUT','/clients/[i:id]', 'ClientsController#update', 'update_client_path');

$router->map('GET','/', 'StaticPagesController#start', 'root_path');
$router->map('POST','/get-code', 'StaticPagesController#getCode', 'get_code');
$router->map('GET','/warsztat/[i:workshop_id]', 'StaticPagesController#showWorkshop', 'show_workshop');
$router->map('GET','/koszyk', 'StaticPagesController#cart', 'cart');
$router->map('GET','/change-quantity/[i:quantity]', 'StaticPagesController#changeQuantity', 'change_quantity');
$router->map('GET','/nowe-zamowienie', 'StaticPagesController#newOrder', 'new_order');
$router->map('POST','/utworz-zamowienie', 'StaticPagesController#createOrder', 'create_order');



// Panel
$router->map('GET','/panel', 'PanelController#show', 'panel_show');
$router->map('POST','/panel/add-roll/[i:order_id]', 'PanelController#addRoll', 'panel_add_roll');
$router->map('POST','/panel/change-orders-status', 'PanelController#changeOrdersStatus', 'panel_change_orders_status');


Config::set('router', $router);

// Match the current request
$match = $router->match();
