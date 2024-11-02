<?php

require __DIR__ . '/vendor/autoload.php';

use Julien\Budget\DepensesMensuelles;
use Julien\Budget\DepenseMensuelle;
use Julien\Budget\DBConnection;
// use Julien\Budget\Depense;
use Julien\Budget\Paiement;
use Julien\Budget\Repositories\DepenseRepository;

const FORMAT = "Y-m-d";
const EPOCH_PAYDAY = "2024-09-19";
const MONTHS = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

$db = new DBConnection('./database.sqlite');
$depenses = new DepenseRepository($db);

$depenses->createTable();

function due_date_month(DateTime $current_date, int $due_day): int
{
    $day = intval($current_date->format("j"));
    if ($day > $due_day) {
        return intval($current_date->format("n")); // next month
    }
    return intval($current_date->format("n")) - 1; // present month
}

$payday = new DateTime(EPOCH_PAYDAY);
$today = new DateTime("now");
$i = 0;

// $cal = new Calendar($today->format("m"), $today->format("y"));
const LOOP_UPPER_BOUND_LIMIT = 25;

do {
    $payday->add(new DateInterval("P14D"));

    $i += 1;
    if ($i > LOOP_UPPER_BOUND_LIMIT) {
        die("Securely break the loop.");
    }
} while ($payday < $today);

$next_pay_day = $payday;
$last_payday = (clone $payday)->sub(new DateInterval("P14D"));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget</title>
    <style>
        .money {
            font-family: monospace;
            font-size: large;
            text-align: right;
        }
        table {
            border-collapse: collapse;
        }
        tr:first-child {
            border-bottom: 2px solid #ddd;
        }
        tr:nth-of-type(even) {
            background: #ddd;
        }

        tr > th,
        tr > td {
            padding-left: 1rem;
        }
        tr > td:first-child {
            padding-left: 0;
        }
        tr:last-child {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>
        Dernière paie: <?= $last_payday->format(FORMAT) ?><br>
        Prochaine paie: <?= $next_pay_day->format(FORMAT) ?></h2>

    <?# $cal ?>

    <table>
        <thead>
            <tr>
                <th>Dépense</th>
                <th>Montant</th>
                <th>Reste à payer ce mois-ci</th>
                <th>D'ici le</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_depenses_du_mois = 0;
            $total_restant_mois = 0;
            ?>
            <?php foreach ($depenses as $nickname => $depense) { ?>
            <tr>
                <td><?= strtr($nickname, "_", " ") ?></td>
                <td class="money"><?= number_format(
                    $depense->montant,
                    2
                ) ?>&nbsp;$</td>
                <td class="money"><?= number_format(
                    $depense->restant,
                    2
                ) ?>&nbsp;$</td>
                <td><?= $depense->jour_du_mois ?> <?= MONTHS[
                    due_date_month($today, $depense->jour_du_mois)
                ] ?></td>
            </tr>
            <?php
            $total_depenses_du_mois += $depense->montant;
            $total_restant_mois += $depense->restant;
            ?>
            <?php } ?>
            <tr>
                <td></td>
                <td class="money"><?= number_format(
                    $total_depenses_du_mois,
                    2
                ) ?>&nbsp;$</td>
                <td class="money"><?= number_format(
                    $total_restant_mois,
                    2
                ) ?>&nbsp;$</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
