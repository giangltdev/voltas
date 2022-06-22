<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$labels = unique_get_advanced_product_labels( array( 'post_status' => array( 'draft', 'publish','trash' ) ) );

?><tr valign='top'>
    <th scope='row' class='titledesc'><?php
        _e( 'Labels', 'it-woocommerce-advanced-product-labels-pro' ); ?><br />
    </th>
    <td class='forminp' id='it-woocommerce-advanced-product-labels-pro-overview'>

        <table class='wp-list-table wpc-conditions-post-table wpc-sortable-post-table widefat'>
            <thead>
            <tr class="head-labels-pro">
                <th style='width: 17px;'></th>
                <th style='padding-left: 10px;'><?php _e( 'Title', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <th style='padding-left: 10px;'><?php _e( 'Text', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <th style='padding-left: 10px;'><?php _e( 'Type', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <th style='padding-left: 10px;'><?php _e( 'Schedule', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <th style='width: 70px;text-align: center;'><?php _e( '# Groups', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <th style='padding-left: 10px;width: 115px;text-align: center;'><?php _e( 'Status', 'it-woocommerce-advanced-product-labels-pro' ); ?></th>
                <?php if ( function_exists('pll_get_post_language') ) {
                    echo '<th style="padding-left: 10px;text-align: center;">'. esc_html__( "Language", "it-woocommerce-advanced-product-labels-pro" ).'</th>';
                }?>
            </tr>
            </thead>
            <tbody><?php

            $i = 0;
            foreach ( $labels as $label ) :

                $settings = get_post_meta( $label->ID, '_unique_global_label', true );
                $alt      = ( $i++ ) % 2 == 0 ? 'alternate' : '';
                ?><tr class='<?php echo $alt; ?>'>

                <td class='sort'>
                    <input type='hidden' name='sort[]' value='<?php echo absint( $label->ID ); ?>' />
                </td>
                <td>
                    <strong>
                        <a href='<?php echo get_edit_post_link( $label->ID ); ?>' class='row-title' title='<?php _e( 'Edit Label', 'it-woocommerce-advanced-product-labels-pro' ); ?>'><?php
                            echo _draft_or_post_title( $label->ID );
                            /*echo $label->post_content;*/
                            ?></a><?php
                        _post_states( $label );
                        ?></strong>
                    <div class='row-actions'>
								<span class='edit'>
									<a href='<?php echo get_edit_post_link( $label->ID ); ?>' title='<?php _e( 'Edit Label', 'it-woocommerce-advanced-product-labels-pro' ); ?>'><?php
                                        _e( 'Edit', 'it-woocommerce-advanced-product-labels-pro' ); ?>
									</a>
									 |
								</span>
                        <span class='trash'>
                                    <!-- test --><?php
                            $post_id = $label->ID;
                            $restore_link = wp_nonce_url(
                                "post.php?action=untrash&amp;post=$post_id",
                                "untrash-post_$post_id"
                            );
                            if ( 'trash' == $label->post_status )
                                echo "<a title='" . esc_attr( __( 'Restore this item from the Trash' ) ) . "' href='" . $restore_link . "'>" . __( 'Enable' ) . "</a> | ";
                            elseif ( EMPTY_TRASH_DAYS )
                                echo "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash' ) ) . "' href='" . get_delete_post_link( $label->ID ) . "'>" . __( 'Disable' ) . "</a>";
                            if ( 'trash' == $label->post_status || !EMPTY_TRASH_DAYS )
                                echo "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently' ) ) . "' href='" . get_delete_post_link( $label->ID, '', true ) . "'>" . __( 'Delete' ) . "</a>";
                            ?>
                            <!-- end test -->

                            <!--<a href='<?php /*echo get_delete_post_link( $label->ID ); */?>' title='<?php /*_e( 'Delete Label', 'it-woocommerce-advanced-product-labels-pro' ); */?>'><?php
                            /*										_e( 'Delete', 'it-woocommerce-advanced-product-labels-pro' );
                                                                */?></a>-->

								</span>
                    </div>
                </td>

                <td><?php $label_type_tbody='';
                    $label_type_tbody=unique_get_label_types( $settings['type'] );
                    if($label_type_tbody=='Image'){
                        echo '<img class="custom_label_pic" style="width: auto;" src="'. wp_kses_post( $settings['image'] ) .'"/>';
                    }else{
                        echo wp_kses_post( $settings['text'] );
                    }?></td>
                <td><?php echo esc_html( unique_get_label_types( $settings['type'] ) ); ?></td>
                <td><?php echo esc_html( unique_get_label_time( $settings['time'] ) ); ?></td>
                <td style='text-align: center;'><?php echo absint( count( $settings['conditions'] ) ); ?></td>
                <td class="<?php echo ('trash' == $label->post_status)?  "label-status-disable" : "label-status-enable" ?>" style='text-align: right;'>
                    <?php echo '<span class="label-status"></span>'; ?>
                </td>
                <?php if ( function_exists('pll_get_post_language') ) {
                echo '<td class="it_pll_post_language" style="text-align: center;">';

                echo pll_get_post_language( $label->ID,'flag' );
                echo pll_get_post_language( $label->ID,'name' );

                echo '</td>';
            } ?>
                </tr><?php

            endforeach;

            if ( empty( $labels ) ) :

                ?><tr>
                <td colspan='2'><?php _e( 'There are no Labels. Yet...', 'it-woocommerce-advanced-product-labels-pro' ); ?></td>
                </tr><?php

            endif;

            ?></tbody>
            <tfoot>
            <tr>
                <th colspan='8' style='padding-left: 10px;'>
                    <a href='<?php echo admin_url( 'post-new.php?post_type=unique' ); ?>' class='add button'><?php
                        _e( 'Add Product Label', 'it-woocommerce-advanced-product-labels-pro' );
                        ?></a>
                </th>
            </tr>
            </tfoot>
        </table>
    </td>
</tr>
