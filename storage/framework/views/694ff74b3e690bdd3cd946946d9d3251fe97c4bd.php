<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.TaxRates')); ?> <small><?php echo e(trans('labels.ListingAllTaxRates')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.TaxRates')); ?></li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/tax/taxrates/filter')); ?>">
                                    <input type="hidden"  value="<?php echo e(csrf_token()); ?>">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >
                                            <option value="" selected disabled hidden><?php echo e(trans('labels.Filter By')); ?></option>
                                            <option value="Zone"  <?php if(isset($name)): ?> <?php if($name == "Zone"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Zone')); ?></option>
                                            <!-- <option value="TaxRates" <?php if(isset($name)): ?> <?php if($name == "TaxRates"): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.TaxRates')); ?></option> -->
                                            <option value="TaxClass" <?php if(isset($name)): ?> <?php if($name == "TaxClass"): ?> <?php echo e('selected'); ?><?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.TaxClass')); ?></option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/tax/taxrates/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/tax/taxrates/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddTaxRate')); ?></a>
                            </div>
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
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('tax_rates_id', trans('labels.ID')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('zone_name', trans('labels.Zone')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('tax_rate', trans('labels.TaxRates')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('tax_class_title', trans('labels.TaxClass')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.Date')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $result['tax_rates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$taxRate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($taxRate->tax_rates_id); ?></td>
                                                <td><?php echo e($taxRate->zone_name); ?></td>
                                                <td><?php echo e($taxRate->tax_rate); ?></td>
                                                <td><?php echo e($taxRate->tax_class_title); ?></td>
                                                <td>
                                                    <strong><?php echo e(trans('labels.AddedDate')); ?>: </strong><?php echo e($taxRate->created_at); ?><br>
                                                    <strong><?php echo e(trans('labels.LastModified')); ?>: </strong><?php echo e($taxRate->updated_at); ?>

                                                </td>
                                                <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(URL::to('admin/tax/taxrates/edit/'.$taxRate->tax_rates_id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteTaxRateId" tax_rates_id ="<?php echo e($taxRate->tax_rates_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <?php if($result['tax_rates'] != null): ?>
                                      <div class="col-xs-12 text-right">
                                          <?php echo e($result['tax_rates']->links()); ?>

                                      </div>
                                    <?php endif; ?>
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
            <!-- deletetaxRateModal -->
            <div class="modal fade" id="deleteTaxRateModal" tabindex="-1" role="dialog" aria-labelledby="deletetaxRateModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteTaxRateModalLabel"><?php echo e(trans('labels.DeleteTaxRate')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/tax/taxrates/delete', 'name'=>'deletetaxRate', 'id'=>'deletetaxRate', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'tax_rates_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteTaxRateText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deletetaxRate"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/admin/tax/taxrate/index.blade.php ENDPATH**/ ?>