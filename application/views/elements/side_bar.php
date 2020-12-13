                       <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard/') ?>">Envintory</a>
                                    </li>
									
									<?php
									echo ($admin_id == 1 ? ' 
									<li class="active">
                                         <a href=" '.base_url('admin/users/').'">Admin Users</a>
                                    </li>
									
									': ''); ?>
									 <li>
                                        <a href="<?php echo base_url("/admin/rentors")?>" >Rentors</a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url("/checkout/cart")?>" >Cart</a>
                                    </li>
                                    <li class="sub-menu">
                                        <a href="#Electronics" class=" d-flex justify-content-between">
                                            Generate Report
                                            <div class="right ti-plus"></div>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#Electronics">Weekly</a>
                                            </li>
											<li>
                                                <a href="#Electronics">Monthly</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#Electronics">Rented Costumes</a>
                                    </li>
                                </ul>
                            </div>
                        </aside>