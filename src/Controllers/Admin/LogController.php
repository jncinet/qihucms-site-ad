<?php

namespace Qihucms\SiteAd\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\SiteAd\Models\SiteAdLog;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LogController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '广告日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteAdLog);

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('site_ad_id', __('site-ad::log.site_ad_id'));
            $filter->equal('user_id', __('site-ad::log.user_id'));
            $filter->like('device', __('site-ad::log.device'));
            $filter->like('browse', __('site-ad::log.browse'));
            $filter->like('system', __('site-ad::log.system'));
            $filter->like('net_type', __('site-ad::log.net_type'));

        });

        $grid->column('id', __('site-ad::log.id'));
        $grid->column('user.username', __('user.username'));
        $grid->column('site_ad_id', __('site-ad::log.site_ad_id'));
        $grid->column('ip', __('site-ad::log.ip'));
        $grid->column('device', __('site-ad::log.device'));
        $grid->column('browse', __('site-ad::log.browse'));
        $grid->column('system', __('site-ad::log.system'));
        $grid->column('net_type', __('site-ad::log.net_type'));

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
        $show = new Show(SiteAdLog::findOrFail($id));

        $show->field('id', __('site-ad::log.id'));
        $show->field('site_ad_id', __('site-ad::log.site_ad_id'));
        $show->field('user_id', __('site-ad::log.user_id'));
        $show->field('ip', __('site-ad::log.ip'));
        $show->field('province', __('site-ad::log.province'));
        $show->field('city', __('site-ad::log.city'));
        $show->field('district', __('site-ad::log.district'));
        $show->field('device', __('site-ad::log.device'));
        $show->field('browse', __('site-ad::log.browse'));
        $show->field('system', __('site-ad::log.system'));
        $show->field('net_type', __('site-ad::log.net_type'));
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
        $form = new Form(new SiteAdLog);

        $form->select('user_id', __('site-ad::log.user_id'))
            ->options(function ($use_id) {
                $model = User::find($use_id);
                if ($model) {
                    return [$model->id => $model->username];
                }
            })
            ->ajax(route('admin.api.users'))
            ->rules('required');
        $form->number('site_ad_id', __('site-ad::log.site_ad_id'))->required();
        $form->ip('ip', __('site-ad::log.ip'));
        $form->text('province', __('site-ad::log.province'));
        $form->text('city', __('site-ad::log.city'));
        $form->text('district', __('site-ad::log.district'));
        $form->text('device', __('site-ad::log.device'));
        $form->text('browse', __('site-ad::log.browse'));
        $form->text('system', __('site-ad::log.system'));
        $form->text('net_type', __('site-ad::log.net_type'));

        return $form;
    }
}