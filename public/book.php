<?php
require __DIR__ . '/../src/connec.php';
require __DIR__ . '/../src/bribe_model.php';
require __DIR__ . '/../src/Bribe.php';
$bribes = getAllBribes();
$sumBribes = sumBribes();
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $errors = checkContent($_POST);

    if ((empty($errors['errors']['paymentErr'])) && (empty($errors['errors']['nameErr']))) {
        saveBribe($_POST);
        header('Location: /book.php');
    }
}

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if (isset($_GET['letter'])) {
        $bribes = showSelectedBribe($_GET['letter']);
        $sumBribes = selectedSumBribes($_GET['letter']);
        $sumBribes = selectedSumBribes($_GET['letter']);
        $sumBribes = selectedSumBribes($_GET['letter']);
    }
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Book</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

        <div class="alphabet">
            <ul>
                <?php foreach (range('A','Z') as $i) : ?>
                    <a href="book.php?letter=<?= $i; ?>"><li>
                        <?= $i; ?>
                </li></a>
                <?php endforeach ?>
            </ul>
        </div>

        <section class="desktop">



        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                <span class="bold">Add a bribe</span>
                <!-- TODO : Form -->

                <form  action=""  method="post">
                    <div>
                        <label  for="name">Name</label>
                        <input  type="text"  id="name"  name="name" maxlength="255"><br><span class="feedback"><?= isset($errors['errors']['nameErr']) ? $errors['errors']['nameErr'] : '' ?></span>
                    </div>
                    <div>
                        <label  for="payment">Amount</label>
                        <input  type="text"  id="payment"  name="payment">
                        <br><span class="feedback"><?= isset($errors['errors']['paymentErr']) ? $errors['errors']['paymentErr'] : '' ?></span>
                    </div>
                    <div  class="button">
                        <button  type="submit">Add the bribe</button>
                    </div>
                </form>


            </div>

            <div class="page rightpage">
                <div class="head-rightpage"><?= isset($_GET['letter']) ? $_GET['letter'] : '' ?></div>
                <table class="table-bribe">

                <?php foreach ($bribes as $bribe) : ?>
                    <tr>
                        <td><?= $bribe->getName() ?></td>
                        <td><?= $bribe->getPayment() . ' €' ?></td>
                    </tr>
                <?php endforeach ?>
                    <tfoot class="cell-total">
                        <tr><th scope="row">Totals</th>
                            <td><?= $sumBribes[0] ?></td></tr>
                    </tfoot>
                </table>
                <!-- TODO : Display bribes and total paiement -->
            </div>
        </div>
        <div class="pen-placeholder">
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>
    </section>
</main>
</body>
</html>
