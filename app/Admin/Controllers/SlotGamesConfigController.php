<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SlotGamesConfig;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SlotGamesConfigController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SlotGamesConfig(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('gid');
            $grid->column('gname');
            $grid->column('sort');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new SlotGamesConfig(), function (Show $show) {
            $show->field('id');
            $show->field('gid');
            $show->field('gname');
            $show->field('sort');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SlotGamesConfig(), function (Form $form) {
            $form->display('id');
            $form->text('gid');
            $form->text('gname');
            $form->text('sort');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
