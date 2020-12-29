<?php

namespace Qihucms\SiteAd\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\SiteAd\Models\SiteAd;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Qihucms\SiteAd\Models\SiteAdPackage;

class AdController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '广告管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SiteAd);

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('site_ad_package_id', __('site-ad::ad.site_ad_package_id'))
                ->select(SiteAdPackage::all()->pluck('name', 'id'));
            $filter->like('user.username', __('site-ad::ad.user_id'));
            $filter->between('start_time', __('site-ad::ad.start_time'))->datetime();
            $filter->between('end_time', __('site-ad::ad.end_time'))->datetime();
            $filter->between('uv', __('site-ad::ad.uv'));
            $filter->between('pv', __('site-ad::ad.pv'));

        });
        $grid->column('id', __('site-ad::ad.id'));
        $grid->column('site_ad_package.name', __('site-ad::ad.site_ad_package_id'));
        $grid->column('user.username', __('site-ad::ad.user_id'));
        $grid->column('start_time', __('site-ad::ad.start_time'));
        $grid->column('end_time', __('site-ad::ad.end_time'));
        $grid->column('uv', __('site-ad::ad.uv'));
        $grid->column('pv', __('site-ad::ad.pv'));

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
        $show = new Show(SiteAd::findOrFail($id));

        $show->field('id', __('site-ad::ad.id'));
        $show->field('site_ad_package_id', __('site-ad::ad.site_ad_package_id'))->as(function () {
            return $this->site_ad_package ? $this->site_ad_package->name : '套餐不存在';
        });
        $show->field('user_id', __('site-ad::ad.user_id'))->as(function () {
            return $this->user ? $this->user->username : '会员不存在';
        });
        $show->field('start_time', __('site-ad::ad.start_time'));
        $show->field('end_time', __('site-ad::ad.end_time'));
        $show->field('uv', __('site-ad::ad.uv'));
        $show->field('pv', __('site-ad::ad.pv'));
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
        $form = new Form(new SiteAd);

        $form->select('user_id', __('site-ad::ad.user_id'))
            ->options(function ($use_id) {
                $model = User::find($use_id);
                if ($model) {
                    return [$model->id => $model->username];
                }
            })
            ->ajax(route('admin.api.users'))
            ->rules('required');
        $form->select('site_ad_package_id', __('site-ad::ad.site_ad_package_id'))
            ->options(SiteAdPackage::all()->pluck('name', 'id'));
        $form->text('moduleable_type', '广告模块命令空间地址')->required();
        $form->number('moduleable_id', '广告模块内容ID')->required();
        $form->datetime('start_time', __('site-ad::ad.start_time'))->default(now());
        $form->datetime('end_time', __('site-ad::ad.end_time'))->default(now()->addWeeks());
        $form->number('uv', __('site-ad::ad.uv'))->default(0);
        $form->number('pv', __('site-ad::ad.pv'))->default(0);

        return $form;
    }
}