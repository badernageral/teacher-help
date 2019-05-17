<?php
session_start();
function carregarClasses ($classe) {
    include(__DIR__."/classes/$classe.php");
}
spl_autoload_register("carregarClasses");