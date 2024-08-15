<div class="orders_portal">
	<form id="headers_order">
		<div class="orders_heading">
			<h2>Orders</h2>
			<input type="submit" value="Save">
		</div>
		<table class="wp-list-table widefat fixed striped table-view-list term_table">
			<thead>
				<tr>
					<th scope="col" class="term_th">Headers</th>
					<th scope="col" class="term_th">Start</th>
					<th scope="col" class="term_th">Buy</th>
					<th scope="col" class="term_th">Undecided</th>
					<th scope="col" class="term_th">Manage</th>
					<th scope="col" class="term_th">Franchise</th>
					<th scope="col" class="term_th">Sell</th>
					<th scope="col" class="term_th">Close</th>
				</tr>
			</thead>
			<tbody id="the-list" data-wp-lists="list:orders" class="term_body">
				<?php
				$terms_c = get_terms([
					'taxonomy' => 'headers',
					'hide_empty' => false,
				]);
				if(!empty($terms_c)){
					foreach($terms_c as $term_c){?>
						<tr id="term-<?php echo $term_c->term_id;?>">
							<td class="term_td"><?php echo $term_c->name;?></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_start" value="<?php $start = get_term_meta($term_c->term_id, 'start', true); if(!empty($start)){echo $start;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_buy" value="<?php $buy = get_term_meta($term_c->term_id, 'buy', true); if(!empty($buy)){echo $buy;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_undecided" value="<?php $undecided = get_term_meta($term_c->term_id, 'undecided', true); if(!empty($undecided)){echo $undecided;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_manage" value="<?php $manage = get_term_meta($term_c->term_id, 'manage', true); if(!empty($manage)){echo $manage;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_franchise" value="<?php $franchise = get_term_meta($term_c->term_id, 'franchise', true); if(!empty($franchise)){echo $franchise;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_sell" value="<?php $sell = get_term_meta($term_c->term_id, 'sell', true); if(!empty($sell)){echo $sell;}?>"></td>
							<td class="term_td"><input type="number" name="<?php echo $term_c->term_id;?>_close" value="<?php $close = get_term_meta($term_c->term_id, 'close', true); if(!empty($close)){echo $close;}?>"></td>
						</tr>
				<?php }
				}?>
			</tbody>
		</table>
	</form>
</div>