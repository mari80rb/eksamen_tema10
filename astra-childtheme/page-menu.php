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

		const url = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/drink?per_page=100";
		const caturl = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/categories?per_page=100";
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
		
		function addEventListenersToButtons() {

			document.querySelectorAll("#knapper img").forEach(elm => {
				elm.addEventListener("click", filtrerDrinks);
			})
		}

		function opretknapper(){
	
			kategorier.forEach( function (kg){
				/* Ved ik helt hvad der skal stå i vores ift unesco's, har prøvet at skrive det jeg tror */
				document.querySelector("#knapper").innerHTML += `<img class="filter" data-drink="${kg.id}" name="${kg.navn}" src="${kg.ikoner}"></img>`; 
	
			})

				addEventListenersToButtons();
			}
			
		function visDrinks(filter) {

			liste.innerHTML = "";
			projekt.forEach(elm => {
	
				console.log(elm.categories.includes(parseInt(filter)));
				if (elm.categories.includes(parseInt(filter)) || filter == "alle") {
				console.log("foreach kører på drinks");
				const klon = skabelon.cloneNode(true).content;
				klon.querySelector("h2").textContent = elm.title.rendered; /*Hvad er title i vores? Det må være i deres WP backend */
				klon.querySelector("img").src = elm.billede.guid; /*Hvad er billede/guid i vores? Det må være i deres WP backend*/

				klon.querySelector("article").addEventListener("click", () => {location.href = elm.link;
				})

				liste.appendChild(klon);
			}})
		}
		
		function filtrerDrinks() {
			filter = this.dataset.projekt;
			document.querySelector(".kategorititel").textContent = this.getAttribute("navn");
			projekt.forEach(elm => {
				console.log(elm.categories);
			})

			visDrinks(filter);
		}


			
			
	</script>


</div>








<?php get_footer(); ?>
