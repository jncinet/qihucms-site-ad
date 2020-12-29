<?php

namespace Qihucms\SiteAd\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\Currency\Models\CurrencyType;
use Qihucms\SiteAd\Models\SiteAdPackage;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PackageController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '广告套餐';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteAdPackage);

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('name', __('site-ad::package.name'))
                ->select(__('site-ad::package.unit_value'));
            $filter->equal('count', __('site-ad::package.count'));
            $filter->equal('unit', __('site-ad::package.unit'))
                ->select(__('site-ad::package.unit_value'));
            $filter->equal('amount', __('site-ad::package.amount'))->currency();
            $filter->equal('currency_type_id', __('site-ad::package.currency_type_id'))
                ->select(CurrencyType::all()->pluck('name', 'id'));
            $filter->equal('status', __('site-ad::package.status.label'))
                ->select(__('site-ad::package.status.value'));

        });
        $grid->column('id', __('site-ad::package.id'));
        $grid->column('name', __('site-ad::package.name'));
        $grid->column('count', __('site-ad::package.count'));
        $grid->column('unit', __('site-ad::package.unit'))
            ->using(__('site-ad::package.unit_value'));
        $grid->column('amount', __('site-ad::package.amount'));
        $grid->column('currency_type.name', __('site-ad::package.currency_type_id'));
        $grid->column('status', __('site-ad::package.status.label'))
            ->using(__('site-ad::package.status.value'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SiteAdPackage::findOrFail($id));

        $show->field('id', __('site-ad::package.id'));
        $show->field('name', __('site-ad::package.name'));
        $show->field('count', __('site-ad::package.count'));
        $show->field('desc', __('site-ad::package.desc'))->unescape();
        $show->field('unit', __('site-ad::package.unit'))
            ->using(__('site-ad::package.unit_value'));
        $show->field('currency_type_id', __('site-ad::package.currency_type_id'))
            ->as(function () {
                return $this->currency_type ? $this->currency_type->name : '货币不存在';
            });
        $show->field('status', __('site-ad::package.status.label'))
            ->using(__('site-ad::package.status.value'));
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SiteAdPackage);
        $form->text('name', __('site-ad::package.name'));
        $form->UEditor('desc', __('site-ad::package.desc'));
        $form->number('count', __('site-ad::package.count'))->default(0);
        $form->select('unit', __('site-ad::package.unit'))
            ->options(__('site-ad::package.unit_value'));
        $form->currency('amount', __('site-ad::package.amount'))->symbol('-');
        $form->select('currency_type_id', __('site-ad::package.currency_type_id'))
            ->options(CurrencyType::all()->pluck('name', 'id'));
        $form->select('status', __('site-ad::package.status.label'))
            ->options(__('site-ad::package.status.value'));

        return $form;
    }
}