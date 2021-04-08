<?php

function newConnection(): PDO
{
    return new PDO(DSN, USER, PASS);
}


function checkContent(array $data) : array
{
    $name = $payment = "";
    $errors = [];

    $name = test_input($_POST["name"]);
    $payment = test_input($_POST["payment"]);

    $errors['errors']['nameErr'] = checkInput($name, 255);
    $errors['errors']['paymentErr'] = checkInput($payment);

    return $errors;
}

function test_input(string $data) : string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkInput($data, $maxlength = null) : string
{
    if (empty($data)) {
        $errors = "Cannot be empty";
    } elseif (is_string($data) && ($maxlength < 0) && (strlen($data) > $maxlength)) {
        $errors = "You shall enter less than 255 characters";
    } elseif (is_numeric($data) && ($data <= 0)) {
        $errors = "Don't enter a bribe if you have nothing to earn";
    }
    else {
        $errors = "";
    }
    return $errors;
}

function saveBribe(array $bribe): void
{
    $connection = newConnection();
    $query = 'INSERT INTO bribe (name, payment) VALUES (:name, :payment)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':name', $bribe['name'], PDO::PARAM_STR);
    $statement->bindValue(':payment', $bribe['payment'], \PDO::PARAM_INT);
    $statement->execute();
}

function getAllBribes() :array
{
    $connection = newConnection();

    $statement = $connection->query('SELECT id, name, payment FROM bribe');
    $bribes = $statement->fetchAll(PDO::FETCH_CLASS, 'Bribe');

    return $bribes;
}

function sumBribes() : array
{
    $connection = newConnection();
    $statement = $connection->query('SELECT SUM(payment) FROM bribe');
    $sumBribes = $statement->fetch(PDO::FETCH_NUM);
    return $sumBribes;
}

function showSelectedBribe($letter) : array {
    $connection = newConnection();
    $statement = $connection->query('SELECT id, name, payment FROM bribe WHERE name LIKE \'' . $letter . '%\'');
    $selectedBribes = $statement->fetchAll(PDO::FETCH_CLASS, 'Bribe');
    return $selectedBribes;
}

function selectedSumBribes($letter) : array
{
    $connection = newConnection();
    $statement = $connection->query('SELECT SUM(payment) FROM bribe WHERE name LIKE \'' . $letter . '%\'');
    $sumBribes = $statement->fetch(PDO::FETCH_NUM);
    return $sumBribes;
}
