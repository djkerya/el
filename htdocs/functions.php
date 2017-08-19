<?php

function get_parts_types() {
    global $db;
    $sql = "SELECT * FROM `part_types`";
    $result = mysqli_query($db, $sql);
    $parts_types = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $parts_types;
}

function get_parts() {
    global $db;
    $sql = "SELECT * FROM parts";
    $result = mysqli_query($db, $sql);
    $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $parts;
}

?>