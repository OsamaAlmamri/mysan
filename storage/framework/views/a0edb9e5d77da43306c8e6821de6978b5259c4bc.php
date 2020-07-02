<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (menu header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Menus')); ?> <small><?php echo e(trans('labels.ListingAllMenus')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Menus')); ?> </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/addmenus')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                            </br>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="row">
                                <div class="col-xs-12">

                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('labels.Name')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('labels.Sub_Menus')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sort_order', trans('labels.sort_order')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('external_link', trans('labels.external_link')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('link', trans('labels.link')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('page', trans('labels.page')));?></th>

                                            <th><?php echo e(trans('labels.Status')); ?></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($result["menus"])>0): ?>
                                            <?php $__currentLoopData = $result["menus"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td><?php echo e($menu->id); ?></td>
                                                    <td>
                                                        <?php echo e($menu->name); ?>

                                                    </td>
                                                    <td>
                                                      <?php $__currentLoopData = $result["submenus"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <?php if($menu->id == $menuu->id): ?>

                                                                    <?php if(property_exists($menuu,"childs")): ?>

                                                                    <?php
                                                      $array = (array) $menuu->childs;
                                                      $key = "sub_sort_order";
                                                          $sorter=array();
                                                          $ret=array();
                                                          reset($array);
                                                          foreach ($array as $ii => $va) {
                                                            $va = (array) $va;

                                                              $sorter[$ii]=$va[$key];
                                                          }
                                                          asort($sorter);
                                                          foreach ($sorter as $ii => $va) {
                                                              $ret[$ii]=$array[$ii];
                                                          }
                                                          $array=$ret;
                                                       ?>
                                                      <ol>
                                                      <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $me): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <li><a href="editmenu/<?php echo e($me->id); ?>"><strong><?php echo e($me->name); ?></strong> (Order:<?php echo e($me->sub_sort_order); ?>)</a></li><br>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </ol>
                                                      <?php endif; ?>
                                                      <?php endif; ?>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($menu->sort_order); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($menu->external_link); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($menu->link); ?>

                                                    </td>
                                                    <td>
                                                      <?php $page = DB::table('pages_description')->where('page_id',$menu->page_id)->where('language_id',1)->first(); if($page){$page_name = $page->name;}else{$page_name = '';} ?>
                                                        <?php echo e($page_name); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($menu->status==0): ?>
                                                            <span class="label label-warning">
										<?php echo e(trans('labels.InActive')); ?>

									</span>
                                                        <?php else: ?>
                                                                <?php echo e(trans('labels.InActive')); ?>

                                                        <?php endif; ?>
                                                        &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                        <?php if($menu->status==1): ?>
                                                            <span class="label label-success">
										<?php echo e(trans('labels.Active')); ?>

									</span>
                                                        <?php else: ?>
                                                                <?php echo e(trans('labels.Active')); ?>

                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editmenu/<?php echo e($menu->id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" href="deletemenu/<?php echo e($menu->id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\mysan\resources\views\admin\menus\index.blade.php ENDPATH**/ ?>