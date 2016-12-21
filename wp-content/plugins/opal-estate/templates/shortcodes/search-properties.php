<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<div class="opalestate-search-properties">
	<div class="inner" style="display:flex; margin-top:1vh;">
		<div id="opalestate-map-preview" style="height:500px; width:50%;" data-page="<?php echo $paged; ?>">
			 <div id="mapView">
		        <div class="mapPlaceholder"><!-- <span class="fa fa-spin fa-spinner"></span> <?php //esc_html_e( 'Loading map...', 'opalestate' ); ?> -->
		        	<div class="sk-folding-cube">
						<div class="sk-cube1 sk-cube"></div>
					  	<div class="sk-cube2 sk-cube"></div>
					  	<div class="sk-cube4 sk-cube"></div>
					  	<div class="sk-cube3 sk-cube"></div>
					</div>
		        </div>
		    </div>
		</div>
		<div style="width:49%; margin-left: 1%;">
			<div class="search-properies-form">
				<?php OpalEstate_Search::render_vertical_form(); ?> 
			</div>
		</div>
	</div>
</div>	