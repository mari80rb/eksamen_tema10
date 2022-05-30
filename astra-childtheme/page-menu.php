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

	#drink-oversigt {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
		grid-gap: 30px;
		
	
		
	}

	#drink-oversigt img {
		padding: 10px;
		object-fit: cover;


	
	}

	#knapper{

		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
		grid-gap: 20px;
		max-width: 1200px;
		margin-inline: auto;
		padding-bottom: 50px;
	}

	#knapper img{
		object-fit: cover;
		max-width: 100px;
		align: center;
	}

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

		let drinks;
				
		const liste = document.querySelector("#drink-oversigt");
		const skabelon = document.querySelector("template");
		let filterDrink = "alle";
		document.addEventListener("DOMContentLoaded", start);

		function start() {
			console.log("start");
			getJson();
		}

		const url = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/drink?per_page=100"
		const caturl = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/ikoner?per_page=100"
		
		let kategorier;
		let filter = "alle";

		async function getJson() {
			console.log("getJson");
			let response = await fetch(url); 
			const catdata = await fetch(caturl);
			

			drinks = await response.json();
			console.log(drinks)
			kategorier = await catdata.json();
			console.log(kategorier);
			visDrinks(filter);
			opretKnapper();
			addEventListenersToButtons();
		}	
		
		function addEventListenersToButtons() {

			document.querySelectorAll("#knapper img").forEach(elm => {
				elm.addEventListener("click", filtrerDrinks);
			})
		}

		function opretKnapper(){
	
			kategorier.forEach( function (kg){
				
				document.querySelector("#knapper").innerHTML += `<img class="filter" data-drinks="${kg.id}" name="${kg.name}" src="${kg.ikon.guid}"></img>`; 
	
			})

				addEventListenersToButtons();
			}
			
		function visDrinks(filter) {

			liste.innerHTML = "";
			drinks.forEach(elm => {
	
				console.log(elm.ikoner.includes(parseInt(filter)));
				if (elm.ikoner.includes(parseInt(filter)) || filter == "alle") {
				console.log("foreach kører på drinks");
				const klon = skabelon.cloneNode(true).content;
				klon.querySelector("h2").textContent = elm.title.rendered; /*Hvad er title i vores? Det må være i deres WP backend */
				klon.querySelector("img").src = elm.billede.guid; 

				klon.querySelector("article").addEventListener("click", () => {location.href = elm.link;
				})

				liste.appendChild(klon);
			}})
		}
		
		function filtrerDrinks() {
			filter = this.dataset.kategorier;
			document.querySelector(".kategorititel").textContent = this.getAttribute("navn");
			kategorier.forEach(elm => {
				console.log(elm.ikoner);
			})

			visDrinks(filter);
		}


			
			
	</script>


</div>








<?php get_footer(); ?>
