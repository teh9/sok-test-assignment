<?php

/**
 * Debug function.
 *
 * @param mixed $data
 * @return void
 */
function pre (mixed $data): void
{
	echo '<pre>';
	    print_r($data);
	echo '</pre>';
}

/**
 * Debug function with die.
 *
 * @param mixed $data
 * @return void
 */
function dd (mixed $data)
{
    pre($data);
    die();
}
