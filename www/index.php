<?php
/**
 * The entry point to the application.
 * Initialize and run.
 */

// Including the class App
require __DIR__ . '/class/Zero/App.php';

Zero_App::Init('web', 'application');

Zero_App::Execute();
