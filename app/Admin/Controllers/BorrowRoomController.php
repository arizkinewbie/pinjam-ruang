<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\BorrowRoom;
use Encore\Admin\Form\Field;
use App\Enums\ApprovalStatus;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;

class BorrowRoomController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Pinjam Ruang Diskusi')
            ->description(trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang Diskusi')
            ->description(trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Pinjam Ruang Diskusi')
            ->description(trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Pinjam Ruang Diskusi')
            ->description(trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BorrowRoom);
        $admin_user = \Admin::user();
        // Show query only related to roles
        if ($admin_user->isRole('mahasiswa'))
            $grid->model()->where('borrower_id', $admin_user->id)->where('deleted_at', null);
        else if ($admin_user->isRole('staff'))
            $grid->model()->where('deleted_at', null);
        $grid->id('ID');
        $grid->column('borrower.name', 'Peminjam');
        $grid->column('room.name', 'Ruangan');
        $grid->column('borrow_at', 'Mulai Pinjam')->display(function ($borrow_at) {
            return Carbon::parse($borrow_at)->format('d M Y H:i');
        });
        $grid->column('until_at', 'Lama Pinjam')->display(function ($title, $column) {
            $borrow_at = Carbon::parse($this->borrow_at);
            $until_at = Carbon::parse($title);
            $result = $until_at->diffForHumans($borrow_at);
            return $result;
        });
        $grid->column('admin.name', 'Staff Perpustakaan')->display(function ($staff) {
            $staff = $this->admin->name ?? '-';
            return $staff;
        });
        $grid->column('status', 'Status')->display(function ($title, $column) {
            $admin_approval_status =    $this->admin_approval_status;
            $returned_at =              $this->returned_at ?? null;
            $processed_at =             $this->processed_at ?? null;
            if ($admin_approval_status == 1) {
                if ($returned_at != null) {
                    $val = ['success', 'Peminjaman selesai'];
                } else if ($processed_at != null) {
                    $val = ['success', 'Ruangan sedang digunakan'];
                } else {
                    $val = ['success', 'Disetujui'];
                }
            } else if ($admin_approval_status == 0) {
                $val = ['info', 'Menunggu Persetujuan'];
            } else {
                $val = ['danger', 'Ditolak'];
            }
            return '<span class="label-' . $val[0] . '" style="width: 8px;height: 8px;padding: 0;border-radius: 50%;display: inline-block;"></span>&nbsp;&nbsp;'
                . $val[1];
        });

        // Role & Permission
        if (!\Admin::user()->can('create.borrow_rooms'))
            $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // The roles with this permission will not able to see the view button in actions column.
            if (!\Admin::user()->can('edit.borrow_rooms')) {
                $actions->disableEdit();
            }
            // The roles with this permission will not able to see the show button in actions column.
            if (!\Admin::user()->can('list.borrow_rooms')) {
                $actions->disableView();
            }
            // The roles with this permission will not able to see the delete button in actions column.
            if (!\Admin::user()->can('delete.borrow_rooms')) {
                $actions->disableDelete();
            }
        });
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
        $show = new Show(BorrowRoom::findOrFail($id));

        $show->id('ID');
        $show->field('borrower', 'Peminjam')->as(function ($model) {
            $adminUserDetail = \App\Models\AdminUserDetail::where('admin_user_id', $model->id)->first()->data;
            $data = json_decode($adminUserDetail);
            $result = "{$model->name} ({$model->username}) - " . ucwords(str_replace('-', ' ', $data->study_program));
            return $result;
        });
        $show->field('room.name', 'Ruangan');
        $show->field('borrow_at', 'Mulai Pinjam');
        $show->field('until_at', 'Selesai Pinjam');
        $show->field('admin.name', ' Staff Perpustakaan');
        $show->field('admin_approval_status', 'Status Persetujuan')->using(ApprovalStatus::asSelectArray());
        $show->field('processed_at', 'Kunci Diambil Pada');
        $show->field('returned_at', 'Diselesaikan Pada');
        $show->field('notes', 'Catatan');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        // Role & Permission
        $show->panel()
            ->tools(function ($tools) {
                // The roles with this permission will not able to see the view button in actions column.
                if (!\Admin::user()->can('edit.borrow_rooms'))
                    $tools->disableEdit();

                // The roles with this permission will not able to see the show button in actions column.
                if (!\Admin::user()->can('list.borrow_rooms'))
                    $tools->disableList();

                // The roles with this permission will not able to see the delete button in actions column.
                if (!\Admin::user()->can('delete.borrow_rooms'))
                    $tools->disableDelete();
            });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BorrowRoom);
        $admin_user = \Admin::user();
        $isTatausaha = $admin_user->isRole('staff');

        if ($form->isEditing())
            $form->display('id', 'ID');

        // Mahasiswa Form
        if ($isTatausaha) {
            $form->display('borrower', 'Peminjam')->with(function ($borrower) {
                $adminUserDetail = \App\Models\AdminUserDetail::where('admin_user_id', $borrower)->first()->data;
                $data = json_decode($adminUserDetail);
                $result = "{$borrower['name']} ({$borrower['username']}) - " . ucwords(str_replace('-', ' ', $data->study_program));
                return $result;
            });
            $form->display('room.name', 'Ruangan')->with(function () {
                return "{$this->room->room_type->name} - {$this->room->name}";
            });
            $form->display('borrow_at', 'Lama Pinjam')->with(function () {
                $borrow_at = Carbon::parse($this->borrow_at);
                $until_at = Carbon::parse($this->until_at);
                $count_days = $borrow_at->diffInDays($until_at) + 1;
                if ($count_days == 1)
                    return $borrow_at->format('d M Y H:i:s') . ' - ' . $until_at->format('H:i:s');
                else
                    return $count_days . ' hari (' . $borrow_at->format('d M Y H:i:s') . ' s/d ' . $until_at->format('d M Y H:i:s') . ')';
            });
            $form->display('need', 'Keperluan')->with(function ($need) {
                return ucwords(str_replace('-', ' ', $need));
            });
        } else {
            $form->select('borrower_id', 'Peminjam')->options(function ($id) {
                $college_students = Administrator::find($id);
                if ($college_students)
                    return [$college_students->id => $college_students->name];
            })->ajax(route('panel.getCollegeStudents'));
            $form->select('room_id', 'Ruangan')->options(function ($id) {
                $room = Room::find($id);
                if ($room)
                    return [$room->id => $room->name];
            })->ajax(route('panel.getRooms'));
            $form->datetime('borrow_at', 'Mulai Pinjam')->format('YYYY-MM-DD HH:mm');
            $form->datetime('until_at', 'Selesai Pinjam')->format('YYYY-MM-DD HH:mm');
        }

        // BATAS
        if ($isTatausaha) {
            $form->display('created_at', 'Diajukan pada')->with(function () {
                return Carbon::parse($this->created_at)->format('d M Y H:i:s');
            });
            $form->hidden('admin_id');
            $form->display('admin_id', 'Staff Perpustakaan')->with(function () use ($admin_user) {
                return $admin_user->name;
            })->readonly();
            $form->radio('admin_approval_status', 'Status Persetujuan')
                ->options(ApprovalStatus::asSelectArray());
            $form->datetime('processed_at', 'Kunci Diambil Pada')->format('YYYY-MM-DD HH:mm')->with(function ($value, Field $thisField) {
                $admin_approval_status = $this->admin_approval_status;
                if (
                    $admin_approval_status == null
                    || $admin_approval_status === ApprovalStatus::Pending
                    || $admin_approval_status === ApprovalStatus::Ditolak
                )
                    $thisField->attribute('readonly', 'readonly');
            });
            $form->datetime('returned_at', 'Diselesaikan Pada')->format('YYYY-MM-DD HH:mm')->with(function ($value, Field $thisField) {
                if ($this->processed_at == null)
                    $thisField->attribute('readonly', 'readonly');
            });
            $form->textarea('notes', 'Catatan');
            // }
        } else {

            // Approval administration and etc
            $form->select('admin_id', 'Staff Perpustakaan')->options(function ($id) {
                $administrators = Administrator::find($id);
                if ($administrators)
                    return [$administrators->id => $administrators->name];
            })->ajax(route('panel.getAdministrators'));
            $form->radio('admin_approval_status', 'Status Persetujuan')->options(ApprovalStatus::asSelectArray());
            $form->datetime('processed_at', 'Kunci Diambil Pada')->format('YYYY-MM-DD HH:mm');
            $form->datetime('returned_at', 'Diselesaikan Pada')->format('YYYY-MM-DD HH:mm');
            $form->textarea('notes', 'Catatan');

            if ($form->isEditing()) {
                $form->display('created_at', trans('admin.created_at'));
                $form->display('updated_at', trans('admin.updated_at'));
            }
        }

        $form->saving(function (Form $form) {
            $form->admin_id = Admin::user()->id;
            if ($form->isEditing() && $form->model()->admin_approval_status != $form->admin_approval_status) {
                $borrowRoom = $form->model();
                $newStatus = $form->admin_approval_status;

                // Data email
                $borrowerEmail = $borrowRoom->borrower->email; // Pastikan borrower memiliki field email
                $borrowerName = $borrowRoom->borrower->name;   // Nama peminjam
                $roomName = $borrowRoom->room->name;           // Nama ruangan
                $roomType = $borrowRoom->room->room_type->name; // Tipe ruangan
                $notes = $form->notes == null ? '-' : $form->notes;  // Catatan
                $statusMessage = $newStatus == ApprovalStatus::Disetujui
                    ? 'Peminjaman telah disetujui'
                    : 'Peminjaman ditolak';

                // send email
                Mail::send('emails.approval_status', [
                    'borrowerName' => $borrowerName,
                    'adminName' => Admin::user()->name,
                    'roomName' => $roomName,
                    'roomType' => $roomType,
                    'notes' => $notes,
                    'statusMessage' => $statusMessage,
                ], function ($message) use ($borrowerEmail, $borrowerName) {
                    $message->to($borrowerEmail, $borrowerName)
                        ->subject('Perubahan Status Peminjaman Ruang Diskusi');
                });
            }
        });

        return $form;
    }
}
