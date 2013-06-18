<?php print "\n\n"; ?>

<!--Footer Information--> 
		<footer class="group"> 
		
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar2') ) : ?>
			<?php endif; ?>
			
			<p>&copy; <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></p>
		</footer> 
		<!-- End Footer Information --> 
		
	</div> 
	<!--end container--> 
	
	
	<?php wp_footer(); ?>
		
</body>
</html>
