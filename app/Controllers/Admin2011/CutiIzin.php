<?php

namespace App\Controllers\Admin2011;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\AdminModel;
use App\Models\ModelSetting;
use App\Models\LeavesModel;
use CodeIgniter\API\ResponseTrait;
use Pusher\Pusher;
use GuzzleHttp\Client;

class CutiIzin extends BaseController
{
    use ResponseTrait;
    var $model, $pusher;
    function __construct()
    {
        $this->model = new LeavesModel();
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true,
        );

        $httpClient = new Client([
            'verify' => false,
        ]);

        $this->pusher = new Pusher(
            'bd956035076f87400396',  // Key
            '95b71ece56d85c045500',  // Secret
            '1883397',               // App ID
            $options,
            $httpClient
        );
    }
    public function index()
    {
        return view('admin/cuti/index');
    }

    public function loaddata()
    {
        $request = service('request');

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length'); // Rows per page

        $columnIndex = $request->getVar('order')[0]['column']; // Column index
        $columnName = $request->getVar('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->getVar('order')[0]['dir']; // asc or desc
        $searchValue = $request->getVar('search')['value']; // Search value

        $userId = session()->get('user_id'); // Pastikan session ini sudah diset saat login

        $db = db_connect();

        if ($userId == 1) {
            $totalRecords = $db->table('leaves')->countAll();

            $builder = $db->table('leaves')
                ->join('tb_admin', 'tb_admin.id = leaves.user_id')
                ->groupStart()  // Start group for search condition
                ->like('tb_admin.name', $searchValue)
                ->orLike('leaves.type', $searchValue)
                ->orLike('leaves.reason', $searchValue)
                ->orLike('leaves.start_date', $searchValue)
                ->groupEnd();  // End group for search condition
        } else {
            $totalRecords = $db->table('leaves')
                ->where('user_id', $userId) // Batasi hanya untuk user yang sedang login
                ->countAllResults();

            $builder = $db->table('leaves')
                ->join('tb_admin', 'tb_admin.id = leaves.user_id')
                ->where('leaves.user_id', $userId) // Filter berdasarkan user_id
                ->groupStart()  // Start group for search condition
                ->like('tb_admin.name', $searchValue)
                ->orLike('leaves.type', $searchValue)
                ->orLike('leaves.reason', $searchValue)
                ->orLike('leaves.start_date', $searchValue)
                ->groupEnd();  // End group for search condition
        }

        $totalRecordsWithFilter = $builder->countAllResults(false); // False to prevent query execution

        $orderBy = ($columnName == '') ? 'leaves.id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $builder
            ->select('leaves.*, tb_admin.name') // Select kolom yang diperlukan
            ->orderBy($orderBy)
            ->limit($rowperpage, $row)
            ->get()
            ->getResult();
        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords, // Total records tanpa filtering
            'iTotalDisplayRecords' => $totalRecordsWithFilter, // Total records dengan filtering
            'aaData' => $data, // Data yang akan ditampilkan
        ];

        return $this->response->setJSON($response);
    }

    public function add()
    {
        $data['title'] = "Ajukan IZIN atau CUTI";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Ajukan";
        echo view('admin/cuti/form', $data);
    }
    public function edit($id)
    {
        $data['title'] = "Form";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['alert'] = "";
        $data['tombol'] = "+Insert";
        echo view('admin/cuti/form', $data);
    }


    public function submitdata()
    {
        $action = $this->request->getVar('action');
        $rules = [
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type harus diisi'
                ]
            ],
            'start_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai harus diisi',
                ]
            ],
            'end_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai harus diisi',
                ]
            ],
            'reason' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alasan Harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }

        switch ($action) {
            case "add":
                $user_id = session()->get('user_id');
                $requestData = [
                    'user_id'    => $user_id,
                    'type'       => $this->request->getVar('type'),
                    'start_date' => $this->request->getVar('start_date'),
                    'end_date'   => $this->request->getVar('end_date'),
                    'reason'     => $this->request->getVar('reason'),
                ];

                $this->model->insert($requestData);

                // Kirim notifikasi menggunakan Pusher
                $data['message'] = 'Izin baru telah diajukan oleh user ID ' . $user_id;
                $this->pusher->trigger('izin-channel', 'izin-added', $data);

                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);

            case "update":
                $user_id = session()->get('user_id');
                $requestData = [
                    'user_id'    => $user_id,
                    'type'       => $this->request->getVar('type'),
                    'start_date' => $this->request->getVar('start_date'),
                    'end_date'   => $this->request->getVar('end_date'),
                    'reason'     => $this->request->getVar('reason'),
                ];

                $detail = $this->model->find($this->request->getVar('id'));
                if ($detail) {
                    $this->model->update($detail['id'], $requestData);

                    // Kirim notifikasi menggunakan Pusher
                    $data['message'] = 'Izin telah diperbarui oleh user ID ' . $user_id;
                    $this->pusher->trigger('izin-channel', 'izin-updated', $data);

                    return $this->respond([
                        'status' => 'success',
                        'message' => 'Data updated successfully'
                    ], 200);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'message' => 'Data not found'
                    ], 404);
                }
        }
    }


    function delete($id)
    {

        $delete = $this->model->delete($id);
        if ($delete) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops, id tidak valid'
            ], 400);
        }
    }
}
