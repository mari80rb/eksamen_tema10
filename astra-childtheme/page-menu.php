<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

<style>

</style>




<div id="primary" class="content-area">

	<main id="main" class="site-main">
		<h1 id="overskrift">Drinks</h1>
		<p>Her kan du se vores udvalg af forskellige drinks.</p>
		<h2>Kategorier</h2>

		<section id="knapper">


		</section>
		<h2 class="kategorititel">Alle Drinks</h2>

		<section id="drink-oversigt"></section>

		<template>
			<article class="container_article">

				<h2></h2>
				<img src="" alt="">
				<p></p>

			</article>
		</template>

	</main>


<script>

	let drink;
				
	const liste = document.querySelector("#drink-oversigt");
	const skabelon = document.querySelector("template");
	let filterDrink = "alle";
	document.addEventListener("DOMContentLoaded", start);

	function start() {
		console.log("start");
		getJson();
	}

	const url = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/drink?per_page=100"
	let kategorier;
	let filter = "alle";

	async function getJson() {
	console.log("getJson");
	let response = await fetch(url); 
	const catdata = await fetch(caturl);

	drink = await response.json();
	kategorier = await catdata.json();
	console.log(kategorier);
	visDrinks(filter);
	opretknapper();
	addEventListenersToButtons();

	
} 


</script>


</div>








<?php get_footer(); ?>
