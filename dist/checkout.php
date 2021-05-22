<?php
session_start();

require_once "includes/head.php";

require_once "../class/database.php";
require_once "../class/abbonamento.php";
require_once "../class/categoria.php";

$database = new Database();
$db = $database->getConnection();
$abbonamento = new Abbonamento($db);
$categoria = new Categoria($db);

if(empty($_SESSION["idUtente"])) {
    header("Location: index.php");
}

$abbonamento->idUtente = $_SESSION["idUtente"];
if($abbonamento->isSubscribed()) {
    header("Location: logged.php");
}

if(empty($_POST["idCategoria"])) {
    header("Location: logged.php");
}

$categoria->id = $_POST["idCategoria"];

$rowCategoria = $categoria->findById();

?>

<main>
    <!-- Main page content-->
    <div class="container mt-4">
        <!-- Invoice-->
        <div class="card invoice">
            <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-left">
                        <!-- Invoice branding-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>
                        <div class="h2 text-white mb-0 mt-3">Checkout</div>
                        <?php echo date("d/m/Y"); ?>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <!-- Invoice table-->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="border-bottom">
                            <tr class="small text-uppercase text-muted">
                                <th scope="col">Description</th>
                                <th class="text-right" scope="col">Quantità</th>
                                <th class="text-right" scope="col">Costo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Invoice item 1-->
                            <tr class="border-bottom">
                                <td>
                                    <div class="font-weight-bold">Abbonamento <?php echo $rowCategoria["nome"]; ?></div>
                                    <div class="small text-muted d-none d-md-block">L'abbonamento <?php echo $rowCategoria["nome"]; ?> ti darà accesso all'intero catalogo dei film fino al <?php echo date('d/m/Y', strtotime(date('Y-m-d') . ' + 30 days')); ?></div>
                                </td>
                                <td class="text-right font-weight-bold">1</td>
                                <td class="text-right font-weight-bold">€<?php echo $rowCategoria["prezzo"]; ?></td>
                            </tr>
                            <!-- Invoice total-->
                            <tr>
                                <td class="text-right pb-0" colspan="2"><div class="text-uppercase small font-weight-700 text-muted">Totale</div></td>
                                <td class="text-right pb-0"><div class="h5 mb-0 font-weight-700 text-green">€<?php echo $rowCategoria["prezzo"]*1; ?></div></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="text-center" id="paypal-payment-button"></div>
                    <script src="https://www.paypal.com/sdk/js?client-id=AU4Ch6aleHdD0GW2goBAlWQsBG3z6E-QLPBAoxN4VqaH_NK3h9uUrBOWSg5FD4mY386NtzqnxjFOOAYO&disable-funding=credit,card,mybank,sofort&currency=EUR&locale=it_IT"></script>
                    <script>
                                    paypal.Buttons({
                            style: {
                                color: 'blue',
                                shape: 'pill'
                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: <?php echo $rowCategoria["prezzo"]; ?>
                                        }
                                    }]
                                })
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function (details) {
                                    console.log(details);
                                    <?php
                                        $abbonamento->idUtente = $_SESSION["idUtente"];
                                        $abbonamento->idCategoria = $_POST["idCategoria"];
                                        $abbonamento->newAbbonamento();
                                    ?>
                                    window.location.replace("logged.php");
                                })
                            }
                            }).render('#paypal-payment-button');
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>
