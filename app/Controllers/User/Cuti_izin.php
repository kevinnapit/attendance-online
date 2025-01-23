<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PresensiModel;
use App\Models\UserModel;
use App\Models\ModelSetting;
use App\Models\LeavesModel;
use App\Models\NotifikasiModel;
use CodeIgniter\API\ResponseTrait;
use Pusher\Pusher;
use GuzzleHttp\Client;

class Cuti_izin extends BaseController
{
    use ResponseTrait;
    var $model, $user, $admin, $pusher;
    function __construct()
    {
        $this->model = new LeavesModel();
        $this->user = new UserModel();
        $this->admin = new AdminModel();
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
        return view('front/cuti/index');
    }
    public function add()
    {
        $data['title'] = "Ajukan Ix`ZIN atau CUTI";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Ajukan";
        return view('front/cuti/form', $data);
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
                ->join('tb_users', 'tb_users.id = leaves.user_id')
                ->groupStart()  // Start group for search condition
                ->like('tb_users.name', $searchValue)
                ->orLike('leaves.type', $searchValue)
                ->orLike('leaves.reason', $searchValue)
                ->orLike('leaves.start_date', $searchValue)
                ->groupEnd();  // End group for search condition
        } else {
            $totalRecords = $db->table('leaves')
                ->where('user_id', $userId) // Batasi hanya untuk user yang sedang login
                ->countAllResults();

            $builder = $db->table('leaves')
                ->join('tb_users', 'tb_users.id = leaves.user_id')
                ->where('leaves.user_id', $userId) // Filter berdasarkan user_id
                ->groupStart()  // Start group for search condition
                ->like('tb_users.name', $searchValue)
                ->orLike('leaves.type', $searchValue)
                ->orLike('leaves.reason', $searchValue)
                ->orLike('leaves.start_date', $searchValue)
                ->groupEnd();  // End group for search condition
        }

        $totalRecordsWithFilter = $builder->countAllResults(false); // False to prevent query execution

        $orderBy = ($columnName == '') ? 'leaves.id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $builder
            ->select('leaves.*, tb_users.name') // Select kolom yang diperlukan
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

    public function submitdata()
    {
        $action = $this->request->getVar('action');
        switch ($action) {
            case "add":
                // Validasi input
                $rules = [
                    'type' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Type harus diisi'
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

                // Data user dari session
                $user_id = session()->get('user_id');
                $username = session()->get('user_name');

                // Simpan data izin ke database
                $requestData = [
                    'user_id'    => $user_id,
                    'type'       => $this->request->getVar('type'),
                    'start_date' => $this->request->getVar('start_date'),
                    'end_date'   => $this->request->getVar('end_date'),
                    'reason'     => $this->request->getVar('reason'),
                ];

                $this->model->insert($requestData);

                // Kirim notifikasi ke semua admin
                $adminUsers = $this->admin->findAll(); // Ambil semua admin dari database
                foreach ($adminUsers as $admin) {
                    $data['message'] = 'Izin baru telah diajukan oleh ' . $username;
                    $this->pusher->trigger('admin-channel-' . $admin['id'], 'izin-added', $data); // Channel unik untuk admin
                }

                // Kirim notifikasi ke user sendiri (opsional)
                $message = 'Pengajuan Anda berhasil dikirim ke admin untuk disetujui.';
                $this->pusher->trigger('user-channel-' . $user_id, 'izin-requested', ['message' => $message]);

                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);

            case "update":
                // Ambil data dari request
                $user_id = session()->get('user_id');
                $username = session()->get('user_name');
                $status = $this->request->getVar('status');
                $requestData = [
                    'user_id'    => $user_id,
                    'type'       => $this->request->getVar('type'),
                    'start_date' => $this->request->getVar('start_date'),
                    'end_date'   => $this->request->getVar('end_date'),
                    'reason'     => $this->request->getVar('reason'),
                    'status'     => $status
                ];

                $detail = $this->model->find($this->request->getVar('id'));
                if ($detail) {
                    $this->model->update($detail['id'], $requestData);

                    // Kirim notifikasi ke semua admin
                    $adminUsers = $this->admin->findAll(); // Ambil semua admin
                    foreach ($adminUsers as $admin) {
                        $data['message'] = 'Izin telah ' . $status . ' oleh ' . $username;
                        $this->pusher->trigger('admin-channel-' . $admin['id'], 'izin-updated', $data);
                    }

                    // Kirim notifikasi ke user yang mengajukan izin
                    $dataUser['message'] = 'Status permohonan izin Anda telah di' . strtolower($status) . ' oleh admin.';
                    $this->pusher->trigger('user-channel-' . $detail['user_id'], 'izin-status-updated', $dataUser);

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

    public function sendNotification($message, $id_user)
    {
        $notificationModel = new NotifikasiModel();

        // Simpan notifikasi ke database
        $notificationModel->insert([
            'message' => $message,
            'user_id' => $id_user,
            'is_read' => 0
        ]);

        // Kirim event Pusher
        $data['message'] = $message;
        $data['user_id'] = $id_user;

        // Trigger Pusher event
        $this->pusher->trigger('notification-channel', 'new-notification', $data);
    }
}
