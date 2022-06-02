<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<style>

	img {
		vertical-align: middle;
		width:100%;
  		max-width: 600px;
		margin-top: 20px;
		margin-bottom: 20px;
	}

	.knap {
		font-size: 2rem;
	}

	section, .emg, .overskrift {
  		/* padding: 1rem; */
  		text-align: center;
  		height: 50%;
	}

    .overskrift {
        margin-top: 2rem;
		padding-top: 1rem;
    }

	article {
		background-color: rgba(196, 199, 212, 0.2);
		border-radius: 10px;
		margin: 20px;
	}
	


</style>

<div id="primary" class="content-area">
		<main id="main" class="site-main">

 <article class="single">
   <h2 class="overskrift"></h2>
        <div class="emg">
            <img class="image" src="" alt="bubble tea">
        </div>

        <section>
            
            <h3>Pris</h3>
            <p class="mellem"></p>
			<p class="large"></p>


            <div class="cont">
               <a class="knap" href="http://mariyahmahmood.dk/kea/10_eksamen/teatime/menu/"> ← </a>
            </div>
        </section>

    </article>

	
		</main><!-- #main -->
		 <script>
 
console.log("scriptStart");
        const dburl = "http://mariyahmahmood.dk/kea/10_eksamen/teatime/wp-json/wp/v2/drink/"+<?php echo get_the_ID() ?>;
        let drinks;
     

        document.addEventListener("DOMContentLoaded", loadJson);

        async function loadJson() {
            console.log("loadJson");
            const jsonData = await fetch(dburl);
            drinks = await jsonData.json();

			console.log(drinks);

           
            visDrink(drinks);
            
        }

		
        function visDrink() {
            console.log("visDrink");
            document.querySelector("h2").textContent = drinks.navn;
            
            document.querySelector(".image").src = drinks.billede.guid;
            document.querySelector(".mellem").textContent = "Medium: " + drinks.medium_pris + " kr.";
			document.querySelector(".large").textContent = "Large: " + drinks.large_pris + " kr.";
            
		}
        


    </script>
	</div><!-- #primary -->

<?php
get_footer();
