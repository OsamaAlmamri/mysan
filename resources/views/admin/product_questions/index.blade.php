@extends('admin.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.product_questions') }} <small>{{ trans('labels.ListingAllproduct_questions') }}
                    ...</small></h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i
                            class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.product_questions') }}</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if ($errors)
                                        @if($errors->any())
                                            <div
                                                @if ($errors->first()=='Default can not Deleted!!') class="alert alert-danger alert-dismissible"
                                                @else class="alert alert-success alert-dismissible" @endif role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>@sortablelink('product_question_id', trans('labels.ID') )</th>
                                            <th>@sortablelink('products_name', trans('labels.products_name') )</th>
                                            <th>@sortablelink('text', trans('labels.question_text') )</th>
                                            <th>@sortablelink('replyes', trans('labels.replyes') )</th>
                                            <th>@sortablelink('created_at', trans('labels.Date') )</th>
                                            <th>{{trans('labels.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($result['productQuestion'])
                                            @foreach ($result['productQuestion'] as $review)

                                                <tr>
                                                    <td>
                                                        {{ $review->product_question_id}}
                                                        @if($review->question_read == 0 and $review->question_status == 0)
                                                            <span
                                                                class="label label-success">{{ trans('labels.new') }}</span>
                                                        @elseif($review->question_read == 1 and $review->question_status == 0)
                                                            <span
                                                                class="label label-info">{{ trans('labels.pending') }}</span>
                                                        @elseif($review->question_read == 1 and $review->question_status == 1)
                                                            <span
                                                                class="label label-primary">{{ trans('labels.seen') }}</span>
                                                        @elseif($review->question_read == 1 and $review->question_status == -1)
                                                            <span
                                                                class="label label-danger">{{ trans('labels.Deactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $review->products_name }}</td>
                                                    <td width="25%">{{ $review->text }}</td>
                                                    <td >{{ $review->replyes }}</td>
                                                    <td>{{ $review->created_at }}</td>
                                                    <td>
                                                        @if($review->reviews_read == 0 and $review->question_status == 0)
                                                            <a class="btn btn-warning"
                                                               style="width: 100%;  margin-bottom: 5px;"
                                                               href="{{ URL::to('admin/product_questions/edit/'.$review->product_question_id.'/0')}}">{{ trans('labels.pending') }}</a>
                                                            </br>
                                                        @endif
                                                        <a class="btn btn-success"
                                                           style="width: 100%;  margin-bottom: 5px;"
                                                           href="{{ URL::to('admin/product_questions/edit/'.$review->product_question_id.'/1')}}">{{ trans('labels.Active') }}</a>
                                                        </br>
                                                        <a class="btn btn-info"
                                                           style="width: 100%;  margin-bottom: 5px;"
                                                           href="{{ URL::to('admin/product_questions/show/'.$review->product_question_id)}}">{{ trans('labels.Replay') }}</a>
                                                        </br>
                                                        <a class="btn btn-danger"
                                                           style="width: 100%;  margin-bottom: 5px;"
                                                           href="{{ URL::to('admin/product_questions/edit/'.$review->product_question_id.'/-1')}}">{{ trans('labels.Deactive') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">{{ trans('labels.Nolanguageexist') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($result['productQuestion'] != null)
                                        <div class="col-xs-12 text-right">
                                            {{$result['productQuestion']->links()}}
                                        </div>
                                    @endif
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
            <!-- deletelanguagesModal -->
            <div class="modal fade" id="replayModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="deleteLanguagesModalLabel">{{ trans('labels.replayToQuestion') }}</h4>
                        </div>
                        <input type="hidden" id="ques_ques_id" value="">
                        <div class="modal-body">
                            <div class="form-group">
                            <textarea id="question_reply"  class="form-control" rows="6">


                            </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="button" class="btn btn-primary" id="btnSendReply">{{ trans('labels.sendReplay') }}</button>

                        </div>
                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
